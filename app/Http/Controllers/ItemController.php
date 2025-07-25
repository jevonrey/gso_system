<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
     public function index(Request $request)
    {
        // Search Functions
    $search = $request->input('search');
    $search = strtolower($search); // convert input to lowercase
    $items = Item::when($search, function ($query, $search) {
        $query->whereAny([
            'old', 
            'new',
            'type',
            'description',
            'location',
            'person',
            'remarks'
        ], 'like', '%' . $search . '%')
        ->get();
        // $query->where('old', 'like', '%' . $search . '%')
        //       ->orWhere('new', 'like', '%' . $search . '%')
        //       ->orWhere('type', 'like', '%' . $search . '%')
        //       ->orWhere('description', 'like', '%' . $search . '%')
        //       ->orWhere('location', 'like', '%' . $search . '%')
        //       ->orWhere('person', 'like', '%' . $search . '%')
        //       ->orWhere('remarks', 'like', '%' . $search . '%');
              
    })
    ->paginate(10)
    ->appends(['search' => $search]); // 👈 this preserves the search in pagination links

    return view('items.index', compact('items'));
    
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'old' => 'nullable',
        'new' => 'nullable',
        'description' => 'required|string',
        'date' => 'required|date',
        'cost' => 'required|numeric',
        'location' => 'required|string',
        'person' => 'required|string',
        'stock_quantity' => 'required|integer',
        'type' => 'required|string',
        'remarks' => 'nullable|string',
        ]);

        Item::create($request->all());

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
        'old' => 'nullable',
        'new' => 'nullable',
        'description' => 'required|string',
        'date' => 'required|date',
        'cost' => 'required|numeric',
        'location' => 'required|string',
        'person' => 'required|string',
        'stock_quantity' => 'required|integer',
        'type' => 'required|string',
        'remarks' => 'nullable|string',
        ]);

        $item->update($request->all());

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted.');
    }

    public function missing()
{
    $items = Item::where('remarks', 'missing')->get();
    $totalCost = $items->sum('cost');
    return view('items.missing', compact('items', 'totalCost'));
}

public function unserviceable()
{
     $items = Item::where('remarks', 'unserviceable')->get();
    $totalCost = $items->sum('cost');
    return view('items.unserviceable', compact('items', 'totalCost'));
}

public function disposal()
{
    $items = Item::where('remarks', 'disposal')->get();
    $totalCost = $items->sum('cost');
    return view('items.disposal', compact('items', 'totalCost'));
}
public function it()
{
    $items = Item::where('type', 'IT')->get();
    $totalCost = $items->sum('cost');
    return view('items.it', compact('items', 'totalCost'));
}
public function furniture()
{
    $items = Item::where('type', 'Furniture')->get();
    $totalCost = $items->sum('cost');
    return view('items.furniture', compact('items', 'totalCost'));
}
public function vehicle()
{
    $items = Item::where('type', 'vehicle')->get();
    $totalCost = $items->sum('cost');
    return view('items.vehicle', compact('items', 'totalCost'));
}

}
