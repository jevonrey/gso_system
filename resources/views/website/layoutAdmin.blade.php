<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GSO | General Services Office</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
    [x-cloak] { display: none !important; }
</style>
</head>
<body class="bg-gray-50 text-gray-900 font-sans">

    <!-- Navbar -->
    <header class="bg-gray-400 shadow sticky top-0 z-50">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        
        <!-- Logo and Title -->
        <div class="flex items-center space-x-3">
            <img src="{{ asset('image/agsur.png') }}" class="w-10 h-10" alt="GSO Logo">
            <div class="text-left leading-tight">
                <div class="text-sm text-gray-600">Republic of the Philippines</div>
                <div class="text-xl font-bold text-blue-900">STA JOSEFA, AGUSAN DEL SUR</div>
            </div>
        </div>

        <!-- Nav Links + User Menu -->
        <div class="flex items-center space-x-6">
            <nav class="space-x-6 text-sm font-medium text-gray-700 flex items-center">
                <a href="{{ route('home') }}" class="hover:text-blue-700">Home</a>
                <a href="{{ route('about') }}" class="hover:text-blue-700">About</a>
                <a href="{{ route('staff') }}" class="hover:text-blue-700">Our People</a>
                <a href="{{ route('admin.booking.index') }}" class="hover:text-blue-700">Booking Schedule</a>
                <a href="{{ route('contact') }}" class="hover:text-blue-700">Contact</a>
                <a href="{{ route('dashboard') }}" class="bg-blue-800 text-white px-3 py-1 rounded hover:bg-blue-900">GSO Portal</a>
            </nav>

            <!-- User Dropdown -->
            <div x-data="{ open: false }" class="relative inline-block text-left">
                <!-- Trigger -->
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <span class="text-gray-700 text-xs">{{ Auth::user()->name }}</span>
                    @php
                        $user = Auth::user();
                        $avatar = $user->photo && file_exists(public_path('profile_pictures/' . $user->photo))
                            ? asset('profile_pictures/' . $user->photo)
                            : 'https://ui-avatars.com/api/?name=' . urlencode($user->name);
                    @endphp
                    <img src="{{ $avatar }}" alt="Profile" class="w-10 h-10 rounded-full">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                    </svg>
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
        </div>
    </div>  
</header>


    <!-- Page Content -->
    <main class="pt-6 bg-gray-300 h-auto">
        @yield('content')
        <section class="bg-gray-100 py-12">

    <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-2 gap-8 mt-2">
        <!-- Vision Card -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-4xl font-semibold text-blue-700 mb-2">Vision</h2>
            <p class="text-gray-700 text-xl">
                To become a model government office in the efficient, transparent, and accountable management of general services, contributing to a well-functioning and service-oriented local government of Sta. Josefa.
            </p>
        </div>

        <!-- Mission Card -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-4xl font-semibold text-green-700 mb-2">Mission</h2>
            <p class="text-gray-700 text-xl">
                To ensure the effective and timely procurement, inventory, and distribution of government resources in support of various municipal departments, through standardized processes and commitment to public service excellence.
            </p>
        </div>
    </div>
</section>

    </main>

    <!-- Footer -->
    <footer class="bg-gray-400 py-6 text-center text-sm text-gray-500">
        <img src="{{ asset ('image/footer-gov-logo.png') }}" alt="" class="h-40 w-40">
        &copy; {{ date('Y') }} General Services Office. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.js"></script>
    @stack('scripts')
</body>
</html>
