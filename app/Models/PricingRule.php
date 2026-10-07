<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class PricingRule extends Model
{
    protected $fillable = [
        'pricing_period_id',
        'duration_minutes',
        'price',
        'currency',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'status' => 'boolean',
    ];

    public function pricingPeriod(): BelongsTo
    {
        return $this->belongsTo(PricingPeriod::class);
    }
}
