<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FuelControl;
use App\Exports\FuelControlsExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class FuelControlController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $selectedOffice = $request->query('office');
        $userOffice = $user->office;

        // Prepare base query for table records
        $query = FuelControl::query();

        if ($user->role !== 'admin') {
            // Non-admin → only their own office
            $query->where('office', $userOffice);
            $selectedOffice = $userOffice;
            $offices = null;
        } else {
            // Admin → optional filter
            if (!empty($selectedOffice)) {
                $query->where('office', $selectedOffice);
            }
            $offices = FuelControl::select('office')
                ->distinct()
                ->orderBy('office')
                ->pluck('office');
        }

        // Fixed fuel types
        $fuelTypes = ['Diesel', 'Premium', 'Unleaded'];

        // Determine which office to calculate for
        $targetOffice = $selectedOffice ?: $userOffice;

        // Get monthly consumption for each fuel type
        $monthlyConsumption = collect($fuelTypes)->map(function ($type) use ($targetOffice) {
            $consumed = \DB::table('fuel_controls')
                ->where('office', $targetOffice)
                ->where('gas_type', $type)
                ->whereMonth('date', now()->month)
                ->whereYear('date', now()->year)
                ->sum('gas_consumed');

            $allocated = \DB::table('fuel_allocations')
                ->where('office', $targetOffice)
                ->where('fuel_type', $type)
                ->whereMonth('date', now()->month)
                ->whereYear('date', now()->year)
                ->sum('allocated_liters');

            return (object) [
                'gas_type' => $type,
                'total_consumed' => $consumed,
                'remaining_liters' => max($allocated - $consumed, 0),
            ];
        });

        $fuel_records = $query->latest()->paginate(15);

        return view('fuel_controls.index', [
            'monthlyConsumption' => $monthlyConsumption,
            'fuel_records' => $fuel_records,
            'offices' => $offices,
            'selectedOffice' => $selectedOffice,
        ]);
    }




    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        $offices = [''];
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
            ->with('success', 'Fuel record added successfully.');
    }


    public function edit($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        $record = FuelControl::findOrFail($id);
        $offices = [''];

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

    public function export(Request $request)
    {
        $user = auth()->user();
        $office = $user->role === 'admin'
            ? ($request->office ?: null)
            : $user->office;

        $year = $request->year ?: now()->year;
        $month = $request->month ?: now()->month;

        // Series number based on number of exports in the month
        $series = str_pad(
            \DB::table('fuel_controls')
                ->when($office, fn($q) => $q->where('office', $office))
                ->whereYear('date', $year)
                ->whereMonth('date', $month)
                ->count() + 1,
            3,
            '0',
            STR_PAD_LEFT
        );

        // If no office (admin + "All Departments"), use 'ALL' in filename
        $officeForFilename = $office ?: 'ALL';

        $filename = "{$officeForFilename}_{$year}_" . str_pad($month, 2, '0', STR_PAD_LEFT) . "_{$series}.xlsx";

        return Excel::download(new FuelControlsExport($office, $year, $month), $filename);
    }

    public function destroy($id)
    {
        $fuelRecord = FuelControl::findOrFail($id);
        $fuelRecord->delete();

        return redirect()->route('fuel_controls.index')
            ->with('success', 'Fuel record deleted successfully.');
    }
}
