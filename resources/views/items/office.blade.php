@extends('layouts.app') {{-- or your actual layout --}}

@section('content')
<div class="p-4">
    <h1 class="text-4xl font-bold mb-4">List of Procured Office Equipments and Total Costs</h1><br><br>
    <table class="min-w-full bg-gray-900">
        <thead class="text-xs text-gray-900 border-x-1 border-y-0 bg-gray-500">
            <tr>
                <th class="text-center">Entry No.</th>
                <th class="text-center">Stock No.</th>
                <th class="text-center">Description</th>
                <th class="text-center">Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th class="text-center">Cost</th>
                <th class="text-center">Location</th>
                <th class="text-center">Person</th>
                <th class="text-center">Quantity</th>
                <th class="text-center">Remarks</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr class="text-xs justify-center text-gray-500">
                    <td class="text-center border-e-cyan-400">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $item->new }}</td>
                    <td class="text-center">{{ $item->description }}</td>
                    <td class="text-center">{{ $item->date }}</td>
                    <td class="text-center">₱ {{ number_format($item->cost, 2) }}</td>
                    <td class="text-center">{{ $item->location }}</td>
                    <td class="text-center">{{ $item->person }}</td>
                    <td class="text-center">{{ $item->stock_quantity }}</td>
                    <td class="text-center">{{ $item->remarks }}</td>
                </tr>
            @empty
                <tr><td colspan="8" class="p-4 text-center text-gray-500">No missing items found.</td></tr>
            @endforelse
        </tbody>
        <tfoot>
    <tr class="bg-gray-900 font-bold">
        <td colspan="4" class="p-2 border text-right"><p class="text-yellow-400">Total Cost:</p></td>
        <td class="p-2 border text-right text-red-600">₱{{ number_format($totalCost, 2) }}</td>
        <td colspan="4" class="p-2 border"></td>
    </tr>
</tfoot>
    </table>
</div>
@endsection
