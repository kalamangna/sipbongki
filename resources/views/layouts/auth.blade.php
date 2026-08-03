<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','SIPBongki')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/sinjai.png') }}">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    {{-- Bootstrap 5.3 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>
<script>

document.addEventListener("DOMContentLoaded", function () {

    const password = document.getElementById("password");

    const button = document.getElementById("togglePassword");

    const icon = document.getElementById("toggleIcon");

    if(button){

        button.addEventListener("click", function(){

            if(password.type === "password"){

                password.type = "text";

                icon.classList.remove("fa-eye");

                icon.classList.add("fa-eye-slash");

            }else{

                password.type = "password";

                icon.classList.remove("fa-eye-slash");

                icon.classList.add("fa-eye");

            }

        });

    }

});

</script>
<body class="bg-slate-50 min-vh-100 d-flex align-items-center justify-content-center py-2 overflow-y-auto" style="background-color: #f8fafc;">

    <div class="container py-2">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">

                {{-- HEADER / BRAND --}}
                <div class="text-center mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center p-2 bg-white rounded-circle shadow-sm mb-2" style="width: 60px; height: 60px;">
                        <img src="{{ asset('images/sinjai.png') }}" alt="Logo SIPBongki" class="img-fluid" style="max-height: 42px; object-fit: contain;">
                    </div>
                    <h4 class="fw-bold text-slate-900 mb-0 tracking-tight fs-5">SIP BONGKI</h4>
                    <p class="text-secondary mb-0" style="font-size: 12px;">
                        Sistem Informasi dan Pelayanan<br>
                        <span class="badge rounded-pill mt-1" style="background-color: #d1fae5; color: #065f46;">Kelurahan Bongki</span>
                    </p>
                </div>

                {{-- MAIN AUTH CARD --}}
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body p-3 p-sm-4">
                        @yield('content')
                    </div>
                </div>

                {{-- FOOTER --}}
                <div class="text-center text-muted" style="font-size: 11px;">
                    <p class="mb-0 text-secondary">Kantor Kelurahan Bongki • Sinjai Utara</p>
                    <span class="text-muted opacity-75">© {{ date('Y') }} SIPBongki</span>
                </div>

            </div>
        </div>
    </div>

    {{-- Bootstrap JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>