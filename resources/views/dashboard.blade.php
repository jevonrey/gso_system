{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app') {{-- or wherever your layout file is --}}

@section('title', 'Dashboard')
@section('content')

<h1 class="text-2xl">GSO Development Dashboard</h1>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 py-4">
    {{-- User Interface --}}
    <div class=" bg-gray-700 shadow rounded-lg p-6">        
                <h3>Hello</h3>
                <h3 class="text-lg font-medium mb-2">{{ Auth::user()->name }}</h3>
            
                <p class="text-gray-300 font-sans font-thin text-sm">Welcome to GSO portal, please use the side bar to navigate within the syste and carefully inspect the data you input to avoid errors in the future.
    </div>
    
    <!-- Total Stock Box -->
    <div class="bg-gray-700 shadow rounded-lg p-6">
        <h3 class="text-m font-bold mb-2">Total Procurements</h3>
        <p class="text-3xl font-bold text-green-600">{{ number_format($totalStocks) }}</p><br>
        <p class="text-gray-300 font-sans font-thin text-sm">
            Total number of items procured by the municipality.
        </p>
    </div>

    <!-- Total Procurement Cost -->
    <div class="bg-gray-700 shadow rounded-lg p-6">
        <h3 class="text-m font-bold mb-2">Total Procurements Ammount</h3>
        <p class="text-3xl font-bold text-green-600">&#8369;{{ number_format ($totalItemCost, 2) ?? 'No items yet' }}</p><br>
        <p class="text-right underline text-xs"><a href="{{ route('items.index') }}">Details>></a></p>
        <p class="text-gray-300 font-sans font-thin text-sm">Total Ammount of all procured items as listed in database.</p>
    </div>

    <!-- Missing Items -->
    <div class="bg-gray-700 shadow rounded-lg p-6">
        <h3 class="text-m font-bold mb-2">Missing Items</h3>
        <p class="text-lg font-bold text-yellow-600">{{ $missingCount == 0 ? 'No items yet' : $missingCount . ' items found' }}</p><br>
        <p class="text-right underline text-xs"><a href="{{ route('items.missing') }}">Details>></a></p>
        <p class="text-gray-300 font-sans font-thin text-sm">
            Number of missing items are listed here.
        </p>
    </div>

    <!-- Unserviceable Items -->
    <div class="bg-gray-700 shadow rounded-lg p-6">
        <h3 class="text-m font-bold mb-2">Unserviceable Items</h3>
        <p class="text-lg font-bold text-red-600">{{ $unserviceableCount == 0 ? 'No items yet' : $unserviceableCount . ' items found' }}</p><br>
         <p class="text-right underline text-xs"><a href="{{ route('items.unserviceable') }}">Details>></a></p>
        <p class="text-gray-300 font-sans font-thin text-sm">
            Number of Unserviceable items are listed here.
        </p>
    </div>

    {{-- Disposable Items --}}
    <div class="bg-gray-700 shadow rounded-lg p-6">
        <h3 class="text-m font-bold mb-2">Disposable Items</h3>
        <p class="text-lg font-bold text-blue-600">{{ $disposalCount == 0 ? 'No items yet' : $disposalCount . ' items found' }}</p><br>
         <p class="text-right underline text-xs"><a href="{{ route('items.disposal') }}">Details>></a></p>
        <p class="text-gray-300 font-sans font-thin text-sm">
            Number of Disposable items are listed here.
        </p>
    </div>

    {{-- Total Missing items in amount --}}
<div class="bg-gray-700 shadow rounded-lg p-6">
    <h3 class="text-m font-bold mb-2">Total Missing Items (Amount)</h3>
    <p class="text-lg font-bold text-yellow-600">&#8369;{{ number_format($missingTotalCost, 2) }}</p><br>
    <p class="text-gray-300 font-sans font-thin text-sm">
            Total ammount of all missing items as per this update.
        </p>
</div>

{{-- Total Unserviceable items in amount --}}
<div class="bg-gray-700 shadow rounded-lg p-6">
    <h3 class="text-m font-bold mb-2">Total Unserviceable Items (Amount)</h3>
    <p class="text-lg font-bold text-red-600">&#8369;{{ number_format($unserviceableTotalCost, 2) }}</p><br>
    <p class="text-gray-300 font-sans font-thin text-sm">
            Total ammount of all unserviceable items as per this update.
        </p>
</div>

{{-- Total Disposable items in amount --}}
<div class="bg-gray-700 shadow rounded-lg p-6">
    <h3 class="text-m font-bold mb-2">Total Disposable Items (Amount)</h3>
    <p class="text-lg font-bold text-blue-600">&#8369;{{ number_format($disposalTotalCost, 2) }}</p><br>
    <p class="text-gray-300 font-sans font-thin text-sm">
            Total ammount of all disposable items as per this update.
        </p>
</div>
</div>

@endsection
