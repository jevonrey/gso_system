<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityBooking extends Model
{
    protected $fillable = [
        'facility_name', 'event_name', 'requestor_name',
        'start_datetime', 'end_datetime', 'status', 'remarks'
    ];
}
