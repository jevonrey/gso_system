<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TotalController extends Controller
{
    public function index()
{
    
    $user = auth()->user();

    $totalStocks = Item::sum('stock_quantity');
    $totalCost = Item::sum('cost');
    
    $missingCount = Item::where('remarks', 'Missing')->count();
    $unserviceableCount = Item::where('remarks', 'Unserviceable')->count();
    $disposalCount = Item::where('remarks', 'For Disposal')->count();


    return view('dashboard', compact(
        'user',
        'totalStocks',
        'totalCost',
        'latestItem',
        'missingCount',
        'unserviceableCount',
        'disposalCount'
    ));
}
}
