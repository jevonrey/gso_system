@extends('layouts.publiclayout')

@section('title', 'Departments')
@section('content')
<div class="p-4">
    <h1 class="text-3xl font-bold mb-4">List of Items per Department</h1>

{{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        {{-- Total Items --}}
        <div class="bg-gray-700 shadow rounded-lg p-4 text-center">
            <h3 class="text-lg font-medium text-blue-300">Total Procurements</h3>
            <p class="text-3xl font-bold text-blue-500">{{ $totalItems }}</p>
        </div>

        {{-- Total Cost --}}
        <div class="bg-gray-700 shadow rounded-lg p-4 text-center">
            <h3 class="text-lg font-medium text-gray-300">Total Cost of Procurements</h3>
            <p class="text-3xl font-bold text-red-500">₱ {{ number_format($totalCost, 2) }}</p>
        </div>

        {{-- Selected Department --}}
        <div class="bg-gray-700 shadow rounded-lg p-4 text-center">
            <h3 class="text-lg font-medium text-gray-300">Department</h3>
            <p class="text-3xl font-bold text-yellow-500">
                {{ $selectedLocation ?? 'All Departments' }}
            </p>
        </div>

        {{-- Dropdown Form --}}
            <form method="GET" action="{{ route('public.departments') }}" class="flex flex-row w-full mt-0 gap-2">
            <label for="location" class="text-gray-400 flex">Select Department:</label>
            <select name="location" id="location" class="border rounded text-gray-900 text-xs">
                <option class="text-gray-900" value="">-- All Departments --</option>
                @foreach ($locations as $loc)
                    <option class="text-gray-900" value="{{ $loc }}" {{ $selectedLocation === $loc ? 'selected' : '' }}>
                        {{ $loc }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded text-xs">Filter</button>
        </form>

</div>
{{-- Items Display --}}
@if($items->isNotEmpty())
    <table class="min-w-full table-auto">
        <thead class="text-xs text-gray-900 border-x-1 border-y-0 bg-gray-500">
            <tr>
                <th class="p-2">Entry No.</th>
                <th class="p-2">Description</th>
                <th class="p-2">Date</th>
                <th class="p-2">Cost</th>
                <th class="p-2">Location</th>
                <th class="p-2">Person</th>
                <th class="p-2">Quantity</th>
                <th class="p-2">Remarks</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr class="text-xs justify-center text-gray-300">
                    <td class="p-2">{{ $loop->iteration }}</td>
                    <td class="p-2">{{ $item->description }}</td>
                    <td class="p-2 text-center">{{ $item->date }}</td>
                    <td class="p-2 text-center">₱{{ number_format($item->cost, 2) }}</td>
                    <td class="p-2 text-center">{{ $item->location }}</td>
                    <td class="p-2 text-center">{{ $item->person }}</td>
                    <td class="p-2 text-center">{{ $item->stock_quantity }}</td>
                    <td class="p-2 text-center">{{ $item->remarks }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="p-4 text-center text-gray-500">No items found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@else
    <p class="text-gray-400 mt-4">No items found for the selected department.</p>
@endif
@endsection
