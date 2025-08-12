@extends('layouts.app')

@section('content')
    <div class="bg-gray-900 p-4 rounded shadow">

        {{-- Header and Add Button --}}
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-white">Fuel Records</h1>
            <a href="{{ route('fuel_controls.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                + Add Fuel Record
            </a>
            <a href="{{ route('fuel_controls.allocations.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                + Add Fuel Allocations
            </a>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-700 text-sm text-white">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="border border-gray-700 px-3 py-2">Date</th>
                        <th class="border border-gray-700 px-3 py-2">Ticket No.</th>
                        <th class="border border-gray-700 px-3 py-2">Plate No.</th>
                        <th class="border border-gray-700 px-3 py-2">Distance (km)</th>
                        <th class="border border-gray-700 px-3 py-2">Gas Consumed (L)</th>
                        <th class="border border-gray-700 px-3 py-2">Gas Type</th>
                        <th class="border border-gray-700 px-3 py-2">Office</th>
                        <th class="border border-gray-700 px-3 py-2">Driver</th>
                        <th class="border border-gray-700 px-3 py-2">Remarks</th>
                        <th class="border border-gray-700 px-3 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fuel_records as $record)
                        <tr class="hover:bg-gray-700">
                            <td class="border border-gray-700 px-3 py-2 text-center">{{ $record->date }}</td>
                            <td class="border border-gray-700 px-3 py-2 text-center">{{ $record->ticket_number }}</td>
                            <td class="border border-gray-700 px-3 py-2 text-center">{{ $record->plate_no }}</td>
                            <td class="border border-gray-700 px-3 py-2 text-center">{{ number_format($record->distance, 0) }}</td>
                            <td class="border border-gray-700 px-3 py-2 text-center">{{ number_format($record->gas_consumed, 0) }}</td>
                            <td class="border border-gray-700 px-3 py-2 text-center">{{ $record->gas_type }}</td>
                            <td class="border border-gray-700 px-3 py-2 text-center">{{ $record->office }}</td>
                            <td class="border border-gray-700 px-3 py-2 text-center">{{ $record->driver }}</td>
                            <td class="border border-gray-700 px-3 py-2 text-center">{{ $record->remarks }}</td>
                            <td class="border border-gray-700 px-3 py-2 flex gap-2">
                                <a href="{{ route('fuel_controls.edit', $record->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-xs">Edit</a>
                                <form action="{{ route('fuel_controls.destroy', $record->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-gray-400 py-4">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $fuel_records->links() }}
        </div>

    </div>
@endsection
