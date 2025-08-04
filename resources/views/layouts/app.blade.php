<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Inventory System') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
    [x-cloak] { display: none !important; }
</style>
</head>
<body class="bg-gray-950 text-white">
    <div class="flex h-screen">        
        {{-- Sidebar --}}
        <aside class="w-54 bg-gray-950 shadow-md p-4 flex flex-col">

{{-- Photo and menu section --}}
            <div class="mb-6 text-center">
                
                <div x-data="{ open: false }" class="relative inline-block text-left">
    <!-- Trigger -->
    <button @click="open = !open"
        class="flex items-center space-x-2 focus:outline-none">
        <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 9l-7 7-7-7"/>
        </svg>
        @php
            $user = Auth::user();
            $avatar = $user->photo && file_exists(public_path('profile_pictures/' . $user->photo))
            ? asset('profile_pictures/' . $user->photo)
            : 'https://ui-avatars.com/api/?name=' . urlencode($user->name);
        @endphp

        <img src="{{ $avatar }}" alt="Profile" class="w-10 h-10 rounded-full mx-auto mb-2">
    </button>

    <!-- Dropdown Menu -->
    <div x-show="open" @click.away="open = false"
         x-cloak class="absolute right-0 mt-2 w-36 bg-gray-400 rounded-sm shadow-lg z-50">
        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block text-left w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                Logout
            </button>
        </form>
     </div>
    </div>
</div><br><br>

{{-- Side Navigation --}}
<nav class=" space-y-4 text-sm font-bold text-gray-500" x-data="{ open: false }">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-1 py-1 rounded hover:bg-gray-200">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
    </svg>
    <span>Dashboard</span>
</a>

        <a href="{{ route('items.index') }}" class="flex items-center gap-2 px-1 py-1 rounded hover:bg-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
        </svg>
        <span>Items</span>
    </a>


        <a href="{{ route('departments.index') }}" class="flex items-center gap-2 px-1 py-1 rounded hover:bg-gray-200">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
        </svg><span>
            Departments
        </span>
        </a>

        <a href="{{ route('issuances.index') }}" class="flex items-center gap-2 px-1 py-1 rounded hover:bg-gray-200">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9.75h4.875a2.625 2.625 0 0 1 0 5.25H12M8.25 9.75 10.5 7.5M8.25 9.75 10.5 12m9-7.243V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0c1.1.128 1.907 1.077 1.907 2.185Z" />
        </svg>Issuances</a><br>


    
        <!-- Dropdown Menu for Item Status -->
        <h1 class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
    </svg><span>
            Status
        </span></h1>
    <div x-data="{ open: false }">
        <button @click="open = !open" class="w-full text-left px-1 py-1 rounded hover:bg-gray-200 flex justify-between items-center">
            Item Status
            <svg class="w-4 h-4 ml-1 transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" class="mt-1 space-y-1 pl-4 transition duration-300 ease-in-out">
            <a href="{{ route('items.missing') }}" class="block text-xs px-1 py-1 rounded hover:bg-gray-200">Missing</a>
            <a href="{{ route('items.unserviceable') }}" class="block text-xs px-1 py-1 rounded hover:bg-gray-200">Unserviceable</a>
            <a href="{{ route('items.disposal') }}" class="block text-xs px-1 py-1 rounded hover:bg-gray-200">Disposal</a>
        </div>
    </div><br>

    {{-- Categories --}}
    <h1 class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
</svg>
Categories</h1>
    <div x-data="{ open: false }">
    <button @click="open = !open" class="w-full text-left px-1 py-1 rounded hover:bg-gray-200 flex justify-between items-center">
        Item Categories
        <svg class="w-4 h-4 ml-1 transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>
        <div x-show="open" class="mt-1 space-y-1 pl-4 transition duration-300 ease-in-out">
        <a href="{{ route('items.it') }}" class="block text-xs px-1 py-1 rounded hover:bg-gray-200">IT Equipments</a>
        <a href="{{ route('items.office') }}" class="block text-xs px-1 py-1 rounded hover:bg-gray-200">Office</a>
        <a href="{{ route('items.furniture') }}" class="block text-xs px-1 py-1 rounded hover:bg-gray-200">Furnitures/Fixtures</a>
        <a href="{{ route('items.vehicle') }}" class="block text-xs px-1 py-1 rounded hover:bg-gray-200">Vehicle</a>
        </div>        
    </div><br>
    <p class="text-xs text-red-800">Powered by: <p class="text-xs text-blue-800">xyberjevon</p></p>
</nav>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 flex flex-col bg-gray-900 h-full">
                         
            {{-- Top Navbar --}}
            <div class="bg-gray-950 p-4 w-full flex justify-between items-center">
                
                    <div class="1/4 w-auto">
                        <img src="{{asset ('image\logo_2.png') }}" alt="stajosefa_logo" class="w-28 h-28 text-center ml-10">
                    </div>
                    <div class="1/4">
                        <h1 class="text-gray-300 text-4xl text-center">
                            General Services Office <br> Inventory Management System    
                        </h1>    
                    </div>              
                    <div class="1/4 w-auto float-end">
                        <img src="{{asset ('image\agsur.png') }}" alt="stajosefa_logo" class="w-28 h-28 text-center mr-10">
                    </div>
                                              
                </div>

            {{-- Page Content --}}
            <div class="p-6 overflow-y-auto h-full">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
