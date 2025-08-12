@extends('layouts.app')

@section('content')
<div class="p-4 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">Add Fuel Allocation</h1>

    @if($errors->any())
        <div class="bg-red-200 p-2 mb-4 rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li class="text-red-800">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('fuel_controls.allocations.store') }}">
        @csrf
        <div class="mb-3">
            <label class="block mb-1">Date</label>
            <input type="date" name="date" class="w-full border rounded p-2 text-gray-900 bg-gray-500" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Fuel Type</label>
            <select name="fuel_type" class="w-full border rounded p-2 text-gray-900 bg-gray-500" required>
                <option value="">-- Select --</option>
                <option value="Diesel">Diesel</option>
                <option value="Premium">Premium</option>
                <option value="Unleaded">Unleaded</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Office</label>
            <input type="text" name="office" class="w-full border rounded p-2 text-gray-900 bg-gray-500" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Allocated Liters</label>
            <input type="number" step="0.01" name="allocated_liters" class="w-full border rounded p-2 text-gray-900 bg-gray-500" required>
        </div>

        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
            Save Allocation
        </button>
    </form>
</div>
@endsection
