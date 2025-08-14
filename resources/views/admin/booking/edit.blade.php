@extends('website.layoutAdmin')

@section('content')
<div class="container mx-auto px-4 max-w-2xl">
    <h2 class="text-xl font-bold mb-4">Edit Booking</h2>

    <form action="{{ route('admin.booking.update', $booking->id) }}" method="POST" class="space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="block">Facility</label>
            <input type="text" name="facility_name" value="{{ old('facility_name', $booking->facility_name) }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block">Event Name</label>
            <input type="text" name="event_name" value="{{ old('event_name', $booking->event_name) }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block">Requestor Name</label>
            <input type="text" name="requestor_name" value="{{ old('requestor_name', $booking->requestor_name) }}" class="w-full border p-2 rounded">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block">Start Date & Time</label>
                <input type="datetime-local" name="start_datetime" value="{{ \Carbon\Carbon::parse($booking->start_datetime)->format('Y-m-d\TH:i') }}" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block">End Date & Time</label>
                <input type="datetime-local" name="end_datetime" value="{{ \Carbon\Carbon::parse($booking->end_datetime)->format('Y-m-d\TH:i') }}" class="w-full border p-2 rounded">
            </div>
        </div>

        <div>
            <label class="block">Status</label>
            <select name="status" class="w-full border p-2 rounded">
                <option {{ $booking->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option {{ $booking->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                <option {{ $booking->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <div>
            <label class="block">Remarks</label>
            <textarea name="remarks" class="w-full border p-2 rounded">{{ old('remarks', $booking->remarks) }}</textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Booking</button>
    </form>
</div>
@endsection
