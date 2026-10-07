<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OperatingHour extends Model
{
    protected $fillable = [
        'facility_id',
        'day_of_week',
        'start_time',
        'end_time',
        'is_closed',
    ];

    protected $casts = [
        'is_closed' => 'boolean',
    ];

    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }
}

//Facility operating hours model. It represents the operating hours of a facility for each day of the week. The model has a relationship with the Facility model, indicating that each operating hour belongs to a specific facility.   

// Facility -> operatingHours