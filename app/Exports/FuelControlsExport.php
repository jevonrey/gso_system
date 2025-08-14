<?php

namespace App\Exports;

use App\Models\FuelControl;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FuelControlsExport implements FromView
{
    protected $office;
    protected $year;
    protected $month;

    public function __construct($office, $year, $month)
    {
        $this->office = $office;
        $this->year = $year;
        $this->month = $month;
    }

    public function view(): View
    {
        $query = FuelControl::query()
        ->when($this->office, fn($q) => $q->where('office', $this->office))
        ->whereYear('date', $this->year)
        ->whereMonth('date', $this->month);

    $fuel_records = $query->get();

    return view('fuel_controls.export', compact('fuel_records'));
    }
}
