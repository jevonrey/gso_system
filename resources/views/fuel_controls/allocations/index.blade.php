@extends('layouts.app')

@section('content')
<div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Fuel Allocations</h1>

    <a href="{{ route('fuel_controls.allocations.create') }}"
       class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">
        + Add Allocation
    </a>

    <table class="w-full table-auto border border-gray-700 text-sm">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="px-3 py-2 border border-gray-700">Date</th>
                <th class="px-3 py-2 border border-gray-700">Fuel Type</th>
                <th class="px-3 py-2 border border-gray-700">Office</th>
                <th class="px-3 py-2 border border-gray-700">Allocated Liters</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allocations as $allocation)
            <tr class="hover:bg-gray-700 text-white">
                <td class="px-3 py-2 border border-gray-700">{{ $allocation->date }}</td>
                <td class="px-3 py-2 border border-gray-700">{{ $allocation->fuel_type }}</td>
                <td class="px-3 py-2 border border-gray-700">{{ $allocation->office }}</td>
                <td class="px-3 py-2 border border-gray-700">{{ $allocation->allocated_liters }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
