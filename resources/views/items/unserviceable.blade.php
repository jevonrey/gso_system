@extends('layouts.app') {{-- or your actual layout --}}

@section('content')
<div class="p-4">
    <h1 class="text-4xl font-bold mb-4">Unserviceable Items</h1>
    <table class="min-w-full bg-gray-900 border border-gray-300">
        <thead class="text-xs text-gray-300">
            <tr class="bg-gray-900 text-center">
                <th class="p-2 border">Entry No</th>
                <th class="p-2 border">Stock No</th>
                <th class="p-2 border">Description</th>
                <th class="p-2 border">Date</th>
                <th class="p-2 border">Cost</th>
                <th class="p-2 border">Location</th>
                <th class="p-2 border">Person</th>
                <th class="p-2 border">Quantity</th>
                <th class="p-2 border">Remarks</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr class="text-xs text-gray-400">
                    <td class="p-2 border">{{ $loop->iteration }}</td>
                    <td class="p-2 border">{{ $item->new }}</td>
                    <td class="p-2 border">{{ $item->description }}</td>
                    <td class="p-2 border">{{ $item->date }}</td>
                    <td class="p-2 border text-right">₱ {{ number_format($item->cost, 2) }}</td>
                    <td class="p-2 border">{{ $item->location }}</td>
                    <td class="p-2 border">{{ $item->person }}</td>
                    <td class="p-2 border">{{ $item->stock_quantity }}</td>
                    <td class="p-2 border">{{ $item->remarks }}</td>
                </tr>
            @empty
                <tr><td colspan="8" class="p-4 text-center text-gray-500">No unserviceable items found.</td></tr>
            @endforelse
        </tbody>
        <tr class="bg-gray-900 font-bold">
        <td colspan="4" class="p-2 border text-right"><p class="text-yellow-400">Total Cost:</p></td>
        <td class="p-2 border text-center text-red-600">₱ {{ number_format($totalCost, 2) }}</td>
        <td colspan="4" class="p-2 border"></td>
    </tr>
    </table>
</div>
@endsection
