<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class FacilityClosure extends Model
{
    protected $fillable = [
        'facility_id',
        'closure_date',
        'start_time',
        'end_time',
        'reason',
        'status',
    ];

    protected $casts = [
        'closure_date' => 'date',
        'status' => 'boolean',
    ];

    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    } 
}
