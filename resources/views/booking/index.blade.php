@extends('website.layout')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Facility Booking Schedule</h1>

    <a href="{{ route('booking.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800 mb-4 inline-block">Submit Booking Request</a>

    <table class="w-full table-auto border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">Facility</th>
                <th class="p-2 border">Event</th>
                <th class="p-2 border">Date & Time</th>
                <th class="p-2 border">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
            <tr>
                <td class="border p-2">{{ $booking->facility_name }}</td>
                <td class="border p-2">{{ $booking->event_name }}</td>
                <td class="border p-2">{{ \Carbon\Carbon::parse($booking->start_datetime)->format('M d, Y h:i A') }} - {{ \Carbon\Carbon::parse($booking->end_datetime)->format('h:i A') }}</td>
                <td class="border p-2">{{ $booking->status }}</td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center p-4">No bookings yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
