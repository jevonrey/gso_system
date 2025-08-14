<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelAllocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'po_number',
        'date',
        'terms',
        'fuel_type',
        'office',
        'allocated_liters',
        'remarks'
    ];
}
