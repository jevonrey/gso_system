@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-4">List of Items per Department</h1>

    {{-- Dropdown Form --}}
    <form method="GET" action="{{ route('departments.index') }}">
    <label for="location" class="text-gray-400">Select Department:</label>
    <select name="location" id="location" class="border rounded p-2 text-gray-900">
        <option class="text-gray-900" value="">-- All Departments --</option>
        @foreach ($locations as $loc)
            <option class="text-gray-900" value="{{ $loc }}" {{ $selectedLocation === $loc ? 'selected' : '' }}>
                {{ $loc }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
</form><br>


    {{-- Items Display --}}
@if($items->isNotEmpty())
    <table class="min-w-full bg-gray-900 border border-gray-300 text-white">
        <thead>
            <tr class="bg-gray-800 text-left">
                <th class="p-2 border">Item Description</th>
                <th class="p-2 border">Number of Stocks</th>
                <th class="p-2 border">Purchase Cost</th>
                <th class="p-2 border">Person Accountable</th>
                <th class="p-2 border">Remarks/Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td class="p-2 border">{{ $item->description }}</td>
                    <td class="p-2 border">{{ $item->stock_quantity }}</td>
                    <td class="p-2 border text-right">₱{{ number_format($item->cost, 2) }}</td>
                    <td class="p-2 border">{{ $item->person }}</td>
                    <td class="p-2 border">{{ $item->remarks }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="text-gray-400 mt-4">No items found for the selected department.</p>
@endif

</div>
@endsection
