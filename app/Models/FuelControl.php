<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelControl extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'ticket_number',
        'plate_no',
        'distance',
        'gas_consumed',
        'office',
        'driver',
        'remarks'
    ];
}

