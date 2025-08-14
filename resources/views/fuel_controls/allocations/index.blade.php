@extends('layouts.app')

@section('content')
    <div class="p-4">
        <h1 class="text-2xl font-bold mb-4">Purchase Order Records</h1>

        @if (auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('fuel_controls.allocations.create') }}"
                class="bg-green-700 text-white px-4 py-2 rounded mb-4 inline-block">
                + Add Allocation
            </a>
        @endif

        <table class="w-full table-auto border border-gray-700 text-sm">
    <thead class="bg-gray-800 text-white">
        <tr>
            <th class="px-3 py-2 border border-gray-700">P.O Number</th>
            <th class="px-3 py-2 border border-gray-700">P.O Date</th>
            <th class="px-3 py-2 border border-gray-700">Terms (days)</th>
            <th class="px-3 py-2 border border-gray-700">Fuel Type</th>
            <th class="px-3 py-2 border border-gray-700">Office</th>
            <th class="px-3 py-2 border border-gray-700">Allocated Liters</th>
            <th class="px-3 py-2 border border-gray-700">Remaining Liters</th>
            <th class="px-3 py-2 border border-gray-700">Remarks</th>
            <th class="px-3 py-2 border border-gray-700">Action</th> {{-- New column --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($allocations as $allocation)
            <tr class="hover:bg-gray-700 text-white">
                <td class="px-3 py-2 border border-gray-700">{{ $allocation->po_number }}</td>
                <td class="px-3 py-2 border border-gray-700">{{ $allocation->date }}</td>
                <td class="px-3 py-2 border border-gray-700">{{ $allocation->terms }}</td>
                <td class="px-3 py-2 border border-gray-700">{{ $allocation->fuel_type }}</td>
                <td class="px-3 py-2 border border-gray-700">{{ $allocation->office }}</td>
                <td class="px-3 py-2 border border-gray-700">{{ number_format($allocation->allocated_liters, 0) }}</td>
                <td class="px-3 py-2 border border-gray-700">{{ number_format(max($allocation->remaining_liters, 0), 0) }}</td>
                <td class="px-3 py-2 border border-gray-700">{{ $allocation->remarks }}</td>
                <td class="px-3 py-2 border border-gray-700 flex gap-2">
                    @if(auth()->user()->role === 'admin') {{-- Only show for admin --}}
                        <a href="{{ route('fuel_controls.allocations.edit', $allocation->id) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-xs">
                            Edit
                        </a>
                        <form action="{{ route('fuel_controls.allocations.destroy', $allocation->id) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this allocation?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs">
                                Delete
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

    </div>
@endsection
