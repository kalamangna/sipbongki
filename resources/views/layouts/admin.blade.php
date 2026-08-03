<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Administrator') | SIPBongki</title>

    <link rel="icon" type="image/png" href="{{ asset('images/sinjai.png') }}">

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

    {{-- Bootstrap 5.3 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- Vite --}}
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    @stack('styles')

</head>

<body class="bg-light">

<div class="d-flex min-vh-100">

    {{-- Sidebar --}}
    @include('components.admin.sidebar')

    {{-- Main Content --}}
    <div class="flex-fill d-flex flex-column min-w-0">

        {{-- Navbar --}}
        @include('components.admin.navbar')

        {{-- Workspace --}}
        <main class="flex-fill p-4">

            <div class="container-fluid max-w-7xl">

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

{{-- Bootstrap 5.3 JS Bundle --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@stack('scripts')

</body>
</html>