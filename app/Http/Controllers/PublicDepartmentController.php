<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class PublicDepartmentController extends Controller
{
    public function index(Request $request)
    {
        // 1) Build the list of distinct locations for the dropdown
        $locations = Item::select('location')
            ->whereNotNull('location')
            ->distinct()
            ->orderBy('location')
            ->pluck('location');

        // 2) Read the chosen location from the query string
        $selectedLocation = $request->query('location');

        // 3) Build the query so we can reuse it (for paginate/sum, etc.)
        $itemsQuery = Item::query();

        if ($selectedLocation) {
            $itemsQuery->where('location', $selectedLocation);
        }

        // 4) Get/paginate items
        $items = $itemsQuery->orderBy('description')->get();

        // 5) Totals (clone to avoid affecting the main query)
        $totalCost = (clone $itemsQuery)->sum('cost');
        $totalItems = (clone $itemsQuery)->sum('stock_quantity');

        return view('public.departments', compact(
            'locations',
            'selectedLocation',
            'items',
            'totalCost',
            'totalItems'
        ));
    }
}
