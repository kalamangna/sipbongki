<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', $website?->meta_title ?? $website?->nama_website ?? 'SIP Bongki')</title>

    <meta name="description" content="{{ $website?->meta_description ?? 'Sistem Informasi dan Pelayanan Kelurahan Bongki' }}">
    <meta name="keywords" content="{{ $website?->meta_keyword ?? 'SIPBongki, Kelurahan Bongki, Sinjai Utara, Pelayanan Publik' }}">

    <link rel="icon" href="{{ $website?->favicon ? asset('storage/'.$website->favicon) : asset('images/sinjai.png') }}">

    {{-- OPEN GRAPH / SOCIAL MEDIA META TAGS --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $website?->meta_title ?? $website?->nama_website ?? 'SIP Bongki' }}">
    <meta property="og:description" content="{{ $website?->meta_description ?? 'Sistem Informasi dan Pelayanan Kelurahan Bongki' }}">
    <meta property="og:image" content="{{ asset('images/meta.png') }}">

    {{-- TWITTER CARD META TAGS --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $website?->meta_title ?? $website?->nama_website ?? 'SIP Bongki' }}">
    <meta name="twitter:description" content="{{ $website?->meta_description ?? 'Sistem Informasi dan Pelayanan Kelurahan Bongki' }}">
    <meta name="twitter:image" content="{{ asset('images/meta.png') }}">

    {{-- VITE ASSET --}}
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    @stack('styles')
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-emerald-500 selection:text-white">

    {{-- BACK TO TOP BUTTON --}}
    <button id="backToTop" class="fixed bottom-6 right-6 z-40 p-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-full shadow-lg shadow-emerald-600/30 opacity-0 pointer-events-none transition-all duration-300 transform translate-y-4">
        <i class="fa-solid fa-arrow-up text-lg"></i>
    </button>

    {{-- NAVBAR --}}
    <x-public.navbar />

    {{-- CONTENT --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <x-public.footer />

    @stack('scripts')
</body>
</html>