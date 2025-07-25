<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Department;

class PublicDashboardController extends Controller
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

    return view('public.dashboard', compact(
        'totalStocks',
        'totalItemCost',
        'missingCount',
        'missingTotalCost',
        'unserviceableCount',
        'unserviceableTotalCost',
        'disposalCount',
        'disposalTotalCost'
    ));
        // $totalStocks = Item::sum('stock_quantity');
        // $latestItem = Item::latest()->first();
        // $missingCount = Item::where('remarks', 'Missing')->count();
        // $unserviceableCount = Item::where('remarks', 'Unserviceable')->count();
        // $disposalCount = Item::where('remarks', 'Disposal')->count();
        // $totalMissingCost = Item::where('remarks', 'Missing')->sum('cost');
        // $totalUnserviceableCost = Item::where('remarks', 'Unserviceable')->sum('cost');
        // $totalDisposalCost = Item::where('remarks', 'Disposal')->sum('cost');

        // return view('public.dashboard', compact(
        //     'totalStocks',
        //     'latestItem',
        //     'missingCount',
        //     'unserviceableCount',
        //     'disposalCount',
        //     'totalMissingCost',
        //     'totalUnserviceableCost',
        //     'totalDisposalCost'
        // ));
    }
}

