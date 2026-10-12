<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\OperatingHour;
use App\Models\FacilityClosure;
use App\Models\BookingItem;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AvailabilityController extends Controller
{
    public function check(Request $request, Facility $facility)
    {
        $data = $request->validate([
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'duration_minutes' => ['required', 'integer', 'min:15', 'max:1440'],
            'quantity' => ['required', 'integer', 'min:1', 'max:50'],
        ]);

        if (!$facility->status) {
            return back()->with('availability_error', 'এই Facility বর্তমানে চালু নেই।');
        }

        $date = Carbon::parse($data['booking_date']);
        $start = Carbon::parse(
            $data['booking_date'] . ' ' . $data['start_time']
        );
        $end = $start->copy()->addMinutes((int) $data['duration_minutes']);

        if ($start->isPast()) {
            return back()->with('availability_error', 'অতীতের সময় বুক করা যাবে না।');
        }

        // Operating hours check
        $operatingHour = OperatingHour::where('facility_id', $facility->id)
            ->where('day_of_week', $date->dayOfWeek)
            ->where('is_closed', false)
            ->first();

        if (!$operatingHour) {
            return back()->with('availability_error', 'এই দিনে Facility বন্ধ।');
        }

        $opening = Carbon::parse($data['booking_date'] . ' ' . $operatingHour->start_time);
        $closing = Carbon::parse($data['booking_date'] . ' ' . $operatingHour->end_time);

        if ($start->lt($opening) || $end->gt($closing)) {
            return back()->with('availability_error', 'নির্বাচিত সময় Operating Hours-এর বাইরে।');
        }

        // Facility closure check
        $isClosed = FacilityClosure::where('facility_id', $facility->id)
            ->where('closure_date', $date->toDateString())
            ->where('status', true)
            ->where(function ($query) use ($data, $end) {
                $query->whereNull('start_time')
                    ->orWhere(function ($q) use ($data, $end) {
                        $q->where('start_time', '<', $end->format('H:i:s'))
                          ->where('end_time', '>', $data['start_time']);
                    });
            })
            ->exists();

        if ($isClosed) {
            return back()->with('availability_error', 'এই সময় Facility বন্ধ থাকবে।');
        }

        // Only pending and confirmed bookings occupy slots
        $occupiedItems = BookingItem::where('facility_id', $facility->id)
            ->whereDate('booking_date', $date->toDateString())
            ->where('start_time', '<', $end->format('H:i:s'))
            ->where('end_time', '>', $start->format('H:i:s'))
            ->whereHas('booking', function ($query) {
                $query->whereIn('status', ['pending', 'confirmed']);
            });

        if ($facility->capacity_type === 'person') {
            $occupied = (clone $occupiedItems)->sum('quantity');

            if ($occupied + (int) $data['quantity'] > $facility->capacity) {
                return back()->with(
                    'availability_error',
                    'এই সময় পর্যাপ্ত Capacity নেই। বর্তমানে বুক করা ব্যক্তি: ' . $occupied
                );
            }
        } else {
            if ($occupiedItems->exists()) {
                return back()->with('availability_error', 'এই সময় Facility ইতিমধ্যে বুক করা আছে।');
            }

            if ((int) $data['quantity'] !== 1) {
                return back()->with('availability_error', 'এই Facility একবারে একটি Unit হিসেবে বুক করতে হবে।');
            }
        }

        return back()->with(
            'availability_success',
            'Facility উপলভ্য! এখন মূল্য যাচাই করে Booking এগিয়ে নেওয়া যাবে।'
        );
    }   
}
