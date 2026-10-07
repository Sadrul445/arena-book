<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Facility extends Model
{
    protected $fillable = [
        'service_category_id',
        'name',
        'slug',
        'description',
        'location',
        'capacity_type',
        'capacity',
        'pricing_type',
        'status',
        'sort_order',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }
    public function operatingHours(): HasMany
    {
        return $this->hasMany(OperatingHour::class);
    }
    public function pricingPeriods(): HasMany
    {
        return $this->hasMany(PricingPeriod::class);
    }
    public function closures(): HasMany
    {
        return $this->hasMany(FacilityClosure::class);
    }
    public function bookingItems(): HasMany
    {
        return $this->hasMany(BookingItem::class);
    }
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
