@extends('layouts.app')

@section('title', 'Item List')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h2 class="text-2xl text-gray-400">List of Procured Items and Status</h2><br>
        <a href="{{ route('items.create') }}" class="text-gray-300 bg-blue-700 text-lg px-3 py-1 rounded text-center">Add New Item</a><br>
    </div>
    <!-- Search Form -->
<form method="GET" action="{{ route('items.index') }}" class="float-right">
    <input type="text" class="rounded-md p-2 border border-gray-300 text-gray-900" name="search" value="{{ request('search') }}"
        placeholder="Search items..." class="px-3 py-2 border rounded-md" />
    <button type="submit" class="ml-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
        Search
    </button>
</form><br><br><br>

    <table class="min-w-full table-auto">
        <thead class="text-xs text-gray-900 border-x-1 border-y-0 bg-gray-500">
            <tr> 
                <th class="text-center">Entry No.</th>
                <th class="text-center">Old Property/Stock No.</th>
                <th class="text-center">New Property/Stock No.</th>
                <th class="text-center">Article/Description</th>
                <th class="text-center">Date Acquired</th>
                <th class="text-center">Acquisition Cost</th>
                <th class="text-center">Office/Dept.</th>
                <th class="text-center">Person Accountable</th>
                <th class="text-center">Stock Quantity</th>
                <th class="text-center">Item Category</th>
                <th class="text-center">Remarks</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($items as $item)
            <tr class="text-xs justify-center text-gray-300">
                <td class="text-center">{{ $loop->iteration + ($items->currentPage() - 1) * $items->perPage() }}</td>
                <td class="text-center">{{ $item->old }}</td>
                <td class="text-center">{{ $item->new }}</td>
                <td class="text-center">{{ $item->description }}</td>
                <td class="text-center">{{ $item->date }}</td>
                <td class="text-center">₱ {{ number_format($item->cost, 2) }}</td>
                <td class="text-center">{{ $item->location }}</td>
                <td class="text-center">{{ $item->person }}</td>
                <td class="text-center">{{ $item->stock_quantity }}</td>
                <td class="text-center">{{ $item->type }}</td>
                <td class="text-center">{{ $item->remarks }}</td>
                <td>
                    <div>                        
                        <a href="{{ route('items.edit', $item->id) }}" class="bg-green-600 hover:bg-green-900 text-white text-xs rounded px-2">Edit</a><br>
                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline-block">
                                    @csrf @method('DELETE')
                                <button onclick="return confirm('Delete this item?')"
                                    class="bg-red-600 hover:bg-red-900 text-white text-xs rounded">
                                    Delete
                                </button>
                            </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
     <div class="mt-4">
        {{ $items->links() }}
    </div>
@endsection