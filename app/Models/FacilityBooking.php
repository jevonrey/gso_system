<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityBooking extends Model
{
    protected $fillable = [
        'facility_name',
        'event_name',
        'requestor_name',
        'start_datetime',
        'end_datetime',
        'status',
        'remarks',
    ];

    // Let Eloquent cast to Carbon instances
    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime'   => 'datetime',
    ];
}