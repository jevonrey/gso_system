<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelAllocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'fuel_type',
        'office',
        'allocated_liters'
    ];
}
