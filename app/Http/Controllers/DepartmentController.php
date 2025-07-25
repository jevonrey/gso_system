<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class DepartmentController extends Controller
{
    public function index(Request $request)
{
    // Distinct list of departments (locations)
    $locations = Item::select('location')
        ->whereNotNull('location')
        ->distinct()
        ->pluck('location');

    // Selected location from dropdown
    $selectedLocation = $request->input('location');

    // Items filtered by location (or all if none selected)
    $items = Item::when($selectedLocation, function ($query) use ($selectedLocation) {
        return $query->where('location', $selectedLocation);
    })->get();

    return view('departments.index', compact('locations', 'items', 'selectedLocation'));
}

}
