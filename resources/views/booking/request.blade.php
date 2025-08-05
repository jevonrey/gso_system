@extends('website.layout')

@section('content')
<div class="container mx-auto px-4 max-w-2xl">
    <h2 class="text-2xl font-bold mb-4">Booking Request Form</h2>

    <form action="{{ route('booking.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block font-medium">Facility</label>
            <select name="facility_name" class="w-full border p-2 rounded">
                <option>Gymnasium</option>
                <option>CSO</option>
                <option>COVID Hostel</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">Event Name</label>
            <input type="text" name="event_name" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block font-medium">Requested By</label>
            <input type="text" name="requestor_name" class="w-full border p-2 rounded" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">Start Date & Time</label>
                <input type="datetime-local" name="start_datetime" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label class="block font-medium">End Date & Time</label>
                <input type="datetime-local" name="end_datetime" class="w-full border p-2 rounded" required>
            </div>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Submit Request</button>
    </form>
</div>
@endsection
