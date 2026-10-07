<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PricingPeriod extends Model
{
    protected $fillable = [
        'facility_id',
        'name',
        'start_time',
        'end_time',
        'priority', // The priority of the pricing period, used for determining which period takes precedence when multiple periods overlap.
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }
    public function pricingRules(): HasMany
    {
        return $this->hasMany(PricingRule::class);
    }
}
