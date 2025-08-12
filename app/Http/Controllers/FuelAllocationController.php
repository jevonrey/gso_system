<?php

namespace App\Http\Controllers;

use App\Models\FuelAllocation;
use Illuminate\Http\Request;

class FuelAllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allocations = FuelAllocation::latest()->paginate(10);
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
            'date' => 'required|date',
            'fuel_type' => 'required|string',
            'office' => 'required|string',
            'allocated_liters' => 'required|numeric|min:0',
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
