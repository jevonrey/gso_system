@extends('website.layout')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Admin: Manage Facility Bookings</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full table-auto border text-sm">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-2 border">Facility</th>
                <th class="p-2 border">Event</th>
                <th class="p-2 border">Date</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
            <tr class="border-t">
                <td class="p-2">{{ $booking->facility_name }}</td>
                <td class="p-2">{{ $booking->event_name }}</td>
                <td class="p-2">{{ \Carbon\Carbon::parse($booking->start_datetime)->format('M d Y, h:i A') }}</td>
                <td class="p-2 font-bold {{ $booking->status === 'Approved' ? 'text-green-700' : ($booking->status === 'Rejected' ? 'text-red-700' : 'text-yellow-600') }}">{{ $booking->status }}</td>
                <td class="p-2 flex gap-2">
                    <a href="{{ route('admin.booking.edit', $booking->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('admin.booking.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center p-4">No bookings found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
