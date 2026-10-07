<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class BookingItem extends Model
{
   protected $fillable = [
        'booking_id',
        'facility_id',
        'booking_date',
        'start_time',
        'end_time',
        'duration_minutes',
        'quantity',
        'unit_price',
        'subtotal',
        'customer_note',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }
}
