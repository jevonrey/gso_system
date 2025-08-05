{{-- Public Views --}}
@extends('layouts.publiclayout') {{-- or wherever your public layout file is --}}

@section('title', 'Dashboard')
@section('content')

<h1 class="text-2xl">GSO Public Dashboard</h1>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 py-4">
    
    {{-- User Interface --}}
    <div class=" bg-gray-700 shadow rounded-lg p-6">        
                <h3 class="text-lg font-medium mb-2">
                    Hello,
                </h3>            
                <p class="text-gray-300 font-sans font-thin text-sm text-justify">
                This is the public view of GSO records for procurements made by the Municipality of Sta. Josefa, Province of Agusan del Sur. 
                Please log in to continue editing stock records. Otherwise, you may stay on this page to browse.
                </p>
    </div>
    <!-- Total Stock Box -->
    <div class="bg-gray-700 shadow rounded-lg p-6">
        <h3 class="text-m font-medium mb-2">Total Procurements</h3>
        <p class="text-3xl font-bold text-green-600">{{ number_format($totalStocks) }}</p><br>
        <p class="text-gray-300 font-sans font-thin text-sm">
            Total counts of stocks procured by the municipality.
        </p>
    </div>

    <!-- Total Procurement Cost -->
    <div class="bg-gray-700 shadow rounded-lg p-6">
        <h3 class="text-m font-medium mb-2">Total Procured Items (Ammount)</h3>
        <p class="text-3xl font-bold text-green-600">&#8369;{{ number_format ($totalItemCost, 2) ?? 'No items yet' }}</p><br>
        <p class="text-right underline text-xs"><a href="{{ route('items.index') }}">Details>></a></p>
        <p class="text-gray-300 font-sans font-thin text-sm">Total Ammount of all procured items as listed in the system.</p>
    </div>

    <!-- Missing Items -->
    <div class="bg-gray-700 shadow rounded-lg p-6">
        <h3 class="text-m font-medium mb-2">Missing Items</h3>
        <p class="text-lg font-bold text-yellow-600">{{ $missingCount == 0 ? 'No items yet' : $missingCount . ' items found' }}</p><br>
        <p class="text-gray-300 font-sans font-thin text-sm">
            Number of missing items are listed here.
        </p>
    </div>

    <!-- Unserviceable Items -->
    <div class="bg-gray-700 shadow rounded-lg p-6">
        <h3 class="text-m font-medium mb-2">Unserviceable Items</h3>
        <p class="text-lg font-bold text-red-600">{{ $unserviceableCount == 0 ? 'No items yet' : $unserviceableCount . ' items found' }}</p><br>
        <p class="text-gray-300 font-sans font-thin text-sm">
            Number of Unserviceable items are listed here.
        </p>
    </div>

    {{-- Disposable Items --}}
    <div class="bg-gray-700 shadow rounded-lg p-6">
        <h3 class="text-m font-medium mb-2">Disposable Items</h3>
        <p class="text-lg font-bold text-blue-600">{{ $disposalCount == 0 ? 'No items yet' : $disposalCount . ' items found' }}</p><br>
        <p class="text-gray-300 font-sans font-thin text-sm">
            Number of Disposable items are listed here.
        </p>
    </div>

    {{-- Total Missing items in amount --}}
<div class="bg-gray-700 shadow rounded-lg p-6">
    <h3 class="text-m font-medium mb-2">Total Missing Items (Amount)</h3>
    <p class="text-lg font-bold text-yellow-600">&#8369;{{ number_format($missingTotalCost ?? 0, 2) }}</p><br>
    <p class="text-gray-300 font-sans font-thin text-sm">
            Total ammount of all missing items as per this update.
        </p>
</div>

{{-- Total Unserviceable items in amount --}}
<div class="bg-gray-700 shadow rounded-lg p-6">
    <h3 class="text-m font-medium mb-2">Total Unserviceable Items (Amount)</h3>
    <p class="text-lg font-bold text-red-600">&#8369;{{ number_format($unserviceableTotalCost ?? 0, 2) }}</p><br>
    <p class="text-gray-300 font-sans font-thin text-sm">
            Total ammount of all unserviceable items as per this update.
        </p>
</div>

{{-- Total Disposable items in amount --}}
<div class="bg-gray-700 shadow rounded-lg p-6">
    <h3 class="text-m font-medium mb-2">Total Disposable Items (Amount)</h3>
    <p class="text-lg font-bold text-blue-600">&#8369;{{ number_format($disposalTotalCost ?? 0, 2) }}</p><br>
    <p class="text-gray-300 font-sans font-thin text-sm">
            Total ammount of all disposable items as per this update.
        </p>
</div>
</div>

@endsection
