<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-4">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>
    @yield('title', $website?->meta_title ?? $website?->nama_website ?? 'SiP Bongki')
    </title>

@if($website)

    <meta 
        name="description"
        content="{{ $website->meta_description }}">

    <meta 
        name="keywords"
        content="{{ $website->meta_keyword }}">

    @if($website?->favicon)

        <link 
            rel="icon"
            href="{{ asset('storage/'.$website->favicon) }}">
    @else
        <link 
            rel="icon"
            href="{{ asset('favicon.ico') }}">
    @endif
@else
    <link 
        rel="icon"
        href="{{ asset('favicon.ico') }}">
@endif


    {{-- VITE ASSET --}}
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])



    {{-- PAGE STYLE --}}
    @stack('styles')


</head>

{{-- BACK TO TOP --}}
<button
    id="backToTop"
    class="back-to-top">

    <i class="bi bi-arrow-up"></i>

</button>
<body class="public-layout">

<div id="preloader">

    <div class="loader-wrapper">

        <div class="loader-ring"></div>

        

        <p>Memuat SIP Bongki..</p>

    </div>

</div>

<div id="scrollProgress"></div>



    {{-- NAVBAR --}}
    <x-public.navbar />



    {{-- CONTENT --}}
    <main class="main-wrapper">

        @yield('content')

    </main>



    {{-- FOOTER --}}
    <x-public.footer />



    {{-- PAGE SCRIPT --}}
    @stack('scripts')



</body>


</html>