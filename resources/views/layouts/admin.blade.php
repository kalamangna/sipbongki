<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Administrator') | SIP Bongki</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <meta property="og:image" content="{{ asset('images/meta.png') }}">
    <meta name="twitter:image" content="{{ asset('images/meta.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Alpine CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- ApexCharts CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Flowbite CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased flex h-[100dvh] overflow-hidden">

    {{-- Sidebar --}}
    @include('components.admin.sidebar')

    {{-- Main Wrapper --}}
    <div class="flex-1 flex flex-col min-h-0 h-full overflow-hidden">
        {{-- Navbar --}}
        @include('components.admin.navbar')

        {{-- Main Scrollable Content --}}
        <main class="flex-1 overflow-y-auto bg-slate-50 flex flex-col justify-between min-h-0">
            <div class="p-4 sm:p-6 md:p-8 pb-6 flex-1">
                <div class="max-w-7xl mx-auto">
                    {{-- Breadcrumb --}}
                    @hasSection('breadcrumb')
                        @yield('breadcrumb')
                    @else
                        @include('components.admin.breadcrumb')
                    @endif

                    {{-- Flash Message --}}
                    @include('components.admin.alert')
                   
                    {{-- Page Content --}}
                    @yield('content')
                </div>
            </div>

            {{-- Footer --}}
            @include('components.admin.footer')
        </main>
    </div>

    <!-- Flowbite JS -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    @stack('scripts')
</body>
</html>