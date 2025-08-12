<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FuelControl;

class FuelControlController extends Controller
{
    public function index()
    {
    if (auth()->user()->role !== 'admin') {
        // Normal user: only see own office records
        $fuel_records = FuelControl::where('office', auth()->user()->office)->latest()->paginate(10);
    } else {
        // Admin: see all
        $fuel_records = FuelControl::latest()->paginate(10);
    }

    return view('fuel_controls.index', compact('fuel_records'));
}

    public function create()
    {
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Unauthorized access.');
    }

    $offices = ['BFP', 'PNP', 'MDRRMO', 'LGU'];
    return view('fuel_controls.create', compact('offices'));
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
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Unauthorized access.');
    }

    $record = FuelControl::findOrFail($id);
    $offices = ['BFP', 'PNP', 'MDRRMO', 'LGU'];

    return view('fuel_controls.edit', compact('record', 'offices'));
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
