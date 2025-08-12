@extends('layouts.app')

@section('content')
<div class="p-4">
    <h1 class="text-2xl font-bold mb-4">User Management</h1>

    <a href="{{ route('users.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">+ Add User</a>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mt-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full mt-4 border-collapse border border-gray-700 text-sm text-white">
        <thead class="bg-gray-800">
            <tr>
                <th class="border border-gray-700 px-3 py-2">Name</th>
                <th class="border border-gray-700 px-3 py-2">Email</th>
                <th class="border border-gray-700 px-3 py-2">Role</th>
                <th class="border border-gray-700 px-3 py-2">Office</th>
                <th class="border border-gray-700 px-3 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="border border-gray-700 px-3 py-2">{{ $user->name }}</td>
                    <td class="border border-gray-700 px-3 py-2">{{ $user->email }}</td>
                    <td class="border border-gray-700 px-3 py-2">{{ ucfirst($user->role) }}</td>
                    <td class="border border-gray-700 px-3 py-2">{{ $user->office }}</td>
                    <td class="border border-gray-700 px-3 py-2">
                        <a href="{{ route('users.edit', $user) }}" class="bg-yellow-500 px-2 py-1 text-xs text-white rounded">Edit</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-500 px-2 py-1 text-xs text-white rounded"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
</div>
@endsection
