<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Booking extends Model
{
    protected $fillable = [
        'booking_number',
        'user_id',
        'coupon_id',
        'booking_date',
        'subtotal',
        'discount_amount',
        'tax_amount',
        'total_amount',
        'currency',
        'status',
        'customer_name',
        'customer_phone',
        'customer_email',
        'coupon_code',
        'notes',
    ];
    protected $casts = [
        'booking_date' => 'date',
        'subtotal' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(BookingItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
