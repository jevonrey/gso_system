@extends('layouts.app')

@section('content')
<div class="bg-gray-900 p-4 rounded shadow">
    <h1 class="text-2xl font-bold text-white mb-4">Add Fuel Record</h1>

    @if ($errors->any())
        <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('fuel_controls.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-gray-300">Date</label>
                <input type="date" name="date" class="w-full p-2 rounded text-gray-800 bg-gray-400" required>
            </div>
            <div>
                <label class="block text-sm text-gray-300">Ticket #</label>
                <input type="text" name="ticket_number" class="w-full p-2 rounded text-gray-800 bg-gray-400">
            </div>
            <div>
                <label class="block text-sm text-gray-300">Plate No</label>
                <input type="text" name="plate_no" class="w-full p-2 rounded text-gray-800 bg-gray-400" required>
            </div>
            <div>
                <label class="block text-sm text-gray-300">Distance (km)</label>
                <input type="number" step="0.01" name="distance" class="w-full p-2 rounded text-gray-800 bg-gray-400">
            </div>
            <div>
                <label class="block text-sm text-gray-300">Gas Consumed (L)</label>
                <input type="number" step="0.01" name="gas_consumed" class="w-full p-2 rounded text-gray-800 bg-gray-400">
            </div>
            <div>
                <label class="block text-sm text-gray-300">Gas Type</label>
                <select name="gas_type" class="w-full p-2 rounded text-gray-800 bg-gray-400" required>
                    <option value="">Select Gas Type</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Unleaded">Unleaded</option>
                    <option value="Premium">Premium</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-gray-300">Office</label>
                <input type="text" name="office" class="w-full p-2 rounded text-gray-800 bg-gray-400">
            </div>
            <div>
                <label class="block text-sm text-gray-300">Driver</label>
                <input type="text" name="driver" class="w-full p-2 rounded text-gray-800 bg-gray-400">
            </div>
        </div>
        <div class="mt-4">
            <label class="block text-sm text-gray-300">Remarks</label>
            <textarea name="remarks" class="w-full p-2 rounded text-gray-800 bg-gray-400"></textarea>
        </div>

        <div class="mt-4 flex gap-2">
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Save</button>
            <a href="{{ route('fuel_controls.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection
