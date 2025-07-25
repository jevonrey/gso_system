@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">Edit Profile</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif
<div class="grid grid-cols-2 gap-4">
    <div class="">
        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4" enctype="multipart/form-data">
            @csrf
            <div>
                <label class="block mb-1 font-semibold">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-10/12 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <div>
                <label class="block mb-1 font-semibold">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-10/12 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <div  class="text-right justify-end">
            <label for="photo">Upload Profile Picture</label>
            <input type="file" name="photo" id="photo" accept="image/*">
        </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Update Profile
            </button>
        </form>
    </div>
    <div class="text-gray-900 text-sm rounded-lg  block w-1/2 p-2.5">
        {{-- Image Holder --}}
        @php
    $user = Auth::user();
    $avatar = $user->photo && file_exists(public_path('profile_pictures/' . $user->photo))
        ? asset('profile_pictures/' . $user->photo)
        : 'https://ui-avatars.com/api/?name=' . urlencode($user->name);
@endphp
<img src="{{ $avatar }}" alt="Profile" class="w-auto h-auto rounded-full mx-auto mb-2">
    </div>
</div>
@endsection
