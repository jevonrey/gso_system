<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>GSO | General Services Office</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.19/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/web-component@6.1.19/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.19/index.global.min.js'></script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 font-sans">

    <!-- Navbar -->
    <header class="bg-gray-400 shadow sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('image/agsur.png') }}" class="w-10 h-10" alt="GSO Logo">
                <div class="text-left leading-tight">
                    <div class="text-sm text-gray-600">Republic of the Philippines</div>
                    <div class="text-xs font-bold text-blue-900">STA JOSEFA, AGUSAN DEL SUR</div>
                </div>
            </div>
            <nav class="space-x-6 text-sm font-medium text-gray-700">
                <a href="{{ route('home') }}" class="hover:text-blue-700">Home</a>
                <a href="{{ route('about') }}" class="hover:text-blue-700">About</a>
                <a href="{{ route('staff') }}" class="hover:text-blue-700">Our People</a>
                <a href="{{ route('booking.index') }}" class="hover:text-blue-700">Booking</a>
                <a href="{{ route('contact') }}" class="hover:text-blue-700">Contact</a>
                <a href="{{ route('login') }}" class="bg-blue-800 text-white px-3 py-1 rounded hover:bg-blue-900">GSO
                    Portal</a>
            </nav>
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
                        To become a model government office in the efficient, transparent, and accountable management of
                        general services, contributing to a well-functioning and service-oriented local government of
                        Sta. Josefa.
                    </p>
                </div>

                <!-- Mission Card -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-4xl font-semibold text-green-700 mb-2">Mission</h2>
                    <p class="text-gray-700 text-xl">
                        To ensure the effective and timely procurement, inventory, and distribution of government
                        resources in support of various municipal departments, through standardized processes and
                        commitment to public service excellence.
                    </p>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-gray-400 py-6 text-center text-sm text-gray-500">
        <img src="{{ asset('image/footer-gov-logo.png') }}" alt="" class="h-40 w-40">
        &copy; {{ date('Y') }} General Services Office. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.js"></script>
    @stack('scripts')
</body>

</html>
