<?php

namespace App\Http\Controllers;

use App\Models\FuelAllocation;
use App\Models\FuelControl;
use Illuminate\Http\Request;

class FuelAllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = \DB::table('fuel_allocations')
            ->select('fuel_allocations.*')
            ->selectRaw('
            (fuel_allocations.allocated_liters - COALESCE((
                SELECT SUM(fc.gas_consumed)
                FROM fuel_controls fc
                WHERE fc.office = fuel_allocations.office
                  AND fc.gas_type = fuel_allocations.fuel_type
                  AND MONTH(fc.date) = MONTH(fuel_allocations.date)
                  AND YEAR(fc.date)  = YEAR(fuel_allocations.date)
            ), 0)) AS remaining_liters
        ');

        // Restrict normal users to their own office
        if (auth()->user()->role !== 'admin') {
            $query->where('fuel_allocations.office', auth()->user()->office);
        }

        $allocations = $query->get();

        return view('fuel_controls.allocations.index', compact('allocations'));
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fuel_controls.allocations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'po_number' => 'required|string',
            'date' => 'required|date',
            'terms' => 'required|string',
            'fuel_type' => 'required|string',
            'office' => 'required|string',
            'allocated_liters' => 'required|numeric|min:0',
            'remarks' => 'required|string',
        ]);

        FuelAllocation::create($request->all());

        return redirect()->route('fuel_controls.allocations.index')->with('success', 'Fuel allocation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
