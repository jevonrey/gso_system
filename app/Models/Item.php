<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'old',
        'new',
        'description',
        'date',
        'cost',
        'location',
        'person',
        'stock_quantity',
        'type',
        'remarks',
    ];
}
