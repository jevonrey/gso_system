@extends('website.layoutPublic')

@section('content')
    <div class="container mx-auto px-4">
        <div class="text-center py-12">
            <h1 class="text-4xl font-bold text-blue-900">Welcome to General Services Office</h1>
            <p class="mt-4 text-lg text-gray-600">Delivering quality services and managing resources efficiently for our
                community.</p>
            <img src="{{ asset('image/stajosefa.jpeg') }}" alt="GSO Building"
                class="mt-8 mx-auto rounded-lg shadow-lg w-full max-w-full">
        </div>
    </div>
@endsection
