<nav class="bg-white shadow px-4 py-3 flex justify-between items-center">
    <div class="text-lg font-semibold">
        {{ config('app.name', 'Inventory System') }}
    </div>
    <div>
        <a href="{{ route('logout') }}" 
           class="text-red-500 hover:underline">
           Logout
        </a>
    </div>
</nav>
