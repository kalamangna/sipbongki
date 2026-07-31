<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Administrator') | SIPBongki</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- Font Awesome --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    {{-- Vite --}}
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    @stack('styles')

</head>

<body class="admin-body">

<div class="admin-layout">

    {{-- Sidebar --}}
    @include('components.admin.sidebar')

    {{-- Main Content --}}
    <div class="admin-main">

        {{-- Navbar --}}
        @include('components.admin.navbar')

        {{-- Workspace --}}
        <main class="admin-content">

            <div class="content-container">

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

        </main>

        {{-- Footer --}}
        @include('components.admin.footer')

    </div>

</div>

@stack('scripts')

</body>
</html>