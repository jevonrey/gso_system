@extends('layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('fuel_controls.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Fuel Record</a>
</div>

<table class="min-w-full bg-white border border-gray-300 text-sm">
    <thead>
        <tr class="bg-gray-200 text-gray-700">
            <th class="border px-4 py-2">Date</th>
            <th class="border px-4 py-2">Ticket Number</th>
            <th class="border px-4 py-2">Plate No.</th>
            <th class="border px-4 py-2">Distance (km)</th>
            <th class="border px-4 py-2">Gas Consumed (L)</th>
            <th class="border px-4 py-2">Office</th>
            <th class="border px-4 py-2">Driver</th>
            <th class="border px-4 py-2">Remarks</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($fuel_records as $record)
        <tr>
            <td class="border px-4 py-2">{{ $record->date }}</td>
            <td class="border px-4 py-2">{{ $record->ticket_number }}</td>
            <td class="border px-4 py-2">{{ $record->plate_no }}</td>
            <td class="border px-4 py-2">{{ $record->distance }}</td>
            <td class="border px-4 py-2">{{ $record->gas_consumed }}</td>
            <td class="border px-4 py-2">{{ $record->office }}</td>
            <td class="border px-4 py-2">{{ $record->driver }}</td>
            <td class="border px-4 py-2">{{ $record->remarks }}</td>
            <td class="border px-4 py-2 flex gap-2">
                <a href="{{ route('fuel_controls.edit', $record->id) }}" class="bg-yellow-500 px-2 py-1 rounded text-white">Edit</a>
                <form action="{{ route('fuel_controls.destroy', $record->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Delete this record?')" class="bg-red-500 px-2 py-1 rounded text-white">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $fuel_records->links() }}
</div>
@endsection
