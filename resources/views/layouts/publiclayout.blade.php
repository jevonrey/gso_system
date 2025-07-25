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

{{-- Side Navigation --}}
<nav class="space-y-2 text-sm font-bold text-gray-500 my-36" x-data="{ open: false }">
        <a href="{{ route('public.dashboard') }}" class="block px-1 py-1 rounded hover:bg-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
        </svg>Dashboard</a><br>
        <a href="{{ route('login') }}"><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Login
        </button>
        </a>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <div class="mt-[400px] border-r-0">
            <p class="text-xs text-red-800">Powered by: 
                <p class="text-xs text-blue-800">xyberjevon</p>
            </p>
        </div>
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
                        <h1 class="text-4xl text-center text-gray-600">
                            General Services Office<br>Sta Josefa, Agusan del Sur
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
