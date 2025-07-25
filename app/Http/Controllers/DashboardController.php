<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Department;

class DashboardController extends Controller
{
  public function index()
{
    $totalStocks = Item::sum('stock_quantity');
    $totalItemCost = Item::sum('cost');

    $missingItems = Item::where('remarks', 'missing')->get();
    $missingCount = $missingItems->count();
    $missingTotalCost = $missingItems->sum('cost');

    $unserviceableItems = Item::where('remarks', 'unserviceable')->get();
    $unserviceableCount = $unserviceableItems->count();
    $unserviceableTotalCost = $unserviceableItems->sum('cost');

    $disposableItems = Item::where('remarks', 'disposal')->get();
    $disposalCount = $disposableItems->count();
    $disposalTotalCost = $disposableItems->sum('cost');

    return view('dashboard', compact(
        'totalStocks',
        'totalItemCost',
        'missingCount',
        'missingTotalCost',
        'unserviceableCount',
        'unserviceableTotalCost',
        'disposalCount',
        'disposalTotalCost'
    ));
}


}
