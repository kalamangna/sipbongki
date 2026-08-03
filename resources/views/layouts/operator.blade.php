<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'Operator') | SIPBongki
    </title>


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


    {{-- Bootstrap Icons --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Bootstrap 5.3 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- Vite --}}
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])


    @stack('styles')


</head>


<body class="admin-body">


<div class="admin-layout">


    {{-- Sidebar Operator --}}
    @include('components.operator.sidebar')


    {{-- Main --}}
    <div class="admin-main">


        {{-- Navbar Operator --}}
        @include('components.operator.navbar')



        <main class="operator-content">


            <div class="content-container">


                {{-- Breadcrumb --}}
                @hasSection('breadcrumb')

                    @yield('breadcrumb')

                @else

                    @include('components.admin.breadcrumb')

                @endif



                {{-- Success Alert --}}
                @if(session('success'))

                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4">


                        <i class="fa-solid fa-circle-check me-2"></i>


                        {{ session('success') }}


                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>


                    </div>

                @endif



                {{-- Error Alert --}}
                @if(session('error'))

                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4">


                        <i class="fa-solid fa-circle-exclamation me-2"></i>


                        {{ session('error') }}


                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>


                    </div>

                @endif



                {{-- Content --}}
                @yield('content')


            </div>


        </main>



        {{-- Footer Operator --}}
        @include('components.operator.footer')


    </div>


</div>


{{-- Bootstrap 5.3 JS Bundle --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@stack('scripts')


</body>

</html>