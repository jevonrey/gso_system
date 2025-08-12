<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuelControl;

class FuelControlController extends Controller
{
    public function index()
    {
        $fuel_records = FuelControl::latest()->paginate(10);
        return view('fuel_controls.index', compact('fuel_records'));
    }

    public function create()
    {
        return view('fuel_controls.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'ticket_number' => 'nullable|string',
            'plate_no' => 'required|string',
            'distance' => 'nullable|numeric',
            'gas_consumed' => 'nullable|numeric',
            'gas_type' => 'required|string',
            'office' => 'nullable|string',
            'driver' => 'nullable|string',
            'remarks' => 'nullable|string',
        ]);

        FuelControl::create($request->all());

        return redirect()->route('fuel_controls.index')
                         ->with('success', 'Fuel record created successfully.');
    }

    public function edit($id)
    {
        $record = FuelControl::findOrFail($id);
        return view('fuel_controls.edit', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'ticket_number' => 'nullable|string',
            'plate_no' => 'required|string',
            'distance' => 'nullable|numeric',
            'gas_consumed' => 'nullable|numeric',
            'gas_type' => 'required|string',
            'office' => 'nullable|string',
            'driver' => 'nullable|string',
            'remarks' => 'nullable|string',
        ]);

        $record = FuelControl::findOrFail($id);
        $record->update($request->all());

        return redirect()->route('fuel_controls.index')
                         ->with('success', 'Fuel record updated successfully.');
    }

    public function destroy($id)
    {
        $record = FuelControl::findOrFail($id);
        $record->delete();

        return redirect()->route('fuel_controls.index')
                         ->with('success', 'Fuel record deleted successfully.');
    }
}
