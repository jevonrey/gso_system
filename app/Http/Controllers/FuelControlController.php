<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuelControlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $fuel_records = FuelControl::latest()->paginate(10);
    return view('fuels.index', compact('fuel_records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'date' => 'required|date',
        'plate_no' => 'required',
    ]);

    FuelControl::create($request->all());

    return redirect()->route('fuels.index')->with('success', 'Fuel record created successfully.');

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
