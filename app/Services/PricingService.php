<?php

namespace App\Services;

use App\Models\Facility;
use App\Models\PricingPeriod;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class PricingService
{
    public function quote(
        Facility $facility,
        string $bookingDate,
        string $startTime,
        int $durationMinutes,
        int $quantity
    ): array {
        if ($durationMinutes < 1 || $quantity < 1) {
            throw ValidationException::withMessages([
                'pricing' => 'Duration এবং Quantity সঠিক হতে হবে।',
            ]);
        }

        $start = Carbon::parse(
            $bookingDate . ' ' . $startTime  // Assuming bookingDate is in 'Y-m-d' format and startTime is in 'H:i' format
        );

        $end = $start->copy()->addMinutes($durationMinutes); // Calculate the end time based on the duration

        // Find the pricing period active at the selected start time.
        // Periods use [start_time, end_time) boundaries.

        $periods = PricingPeriod::where('facility_id', $facility->id)
            ->where('status', true) // Only consider active pricing periods
            ->where('start_time', '<=', $start->format('H:i:s')) // Check if the start time is within the period
            ->where('end_time', '>', $start->format('H:i:s')) // Check if the end time is within the period
            ->orderByDesc('priority') // Order by priority to get the most relevant period first
            ->with([
                'pricingRules' => function ($query) {
                    $query->where('status', true);
                }, // Eager load the pricing rules for the period, only considering active rules
            ])
            ->get();

        foreach ($periods as $period) {
            // For now, a booking must finish within the same pricing period.
            if ($end->format('Y-m-d') !== $start->format('Y-m-d')) {
                continue;
            } // Ensure the booking does not cross into the next day

            if ($end->format('H:i:s') > $period->end_time) {
                continue;
            } // Ensure the booking does not exceed the end time of the pricing period

            $rule = $period->pricingRules->firstWhere(
                'duration_minutes',
                $durationMinutes
            );  // Find the pricing rule that matches the requested duration

            if (!$rule) {
                continue;
            } // If no matching pricing rule is found, continue to the next period

            $unitPrice = (float) $rule->price; // Get the unit price from the pricing rule

            $totalPrice = $facility->pricing_type === 'per_person'
                ? $unitPrice * $quantity
                : $unitPrice;  // Calculate the total price based on the pricing type (per person or per booking)

            return [
                'facility_id' => $facility->id,
                'facility_name' => $facility->name,
                'pricing_period' => $period->name,
                'booking_date' => $bookingDate,
                'start_time' => $start->format('H:i'),
                'end_time' => $end->format('H:i'),
                'duration_minutes' => $durationMinutes,
                'quantity' => $quantity,
                'pricing_type' => $facility->pricing_type,
                'unit_price' => $unitPrice,
                'total_price' => $totalPrice,
                'currency' => $rule->currency,
            ];
        }

        throw ValidationException::withMessages([ // If no valid pricing rule is found for the given time and duration, throw a validation exception
            'pricing' =>
                'এই সময় ও Duration-এর জন্য কোনো বৈধ Pricing Rule পাওয়া যায়নি।',
        ]);
    }
}
