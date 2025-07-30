<?php


namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ItemsExport implements FromView
{
    protected $location;

    public function __construct($location = null)
    {
        $this->location = $location;
    }

    public function view(): View
    {
        $query = Item::query();

        if ($this->location) {
            $query->where('location', $this->location);
        }

        $items = $query->get();

        return view('departments.export', [
            'items' => $items
        ]);
    }
}
