<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','SIPBongki')</title>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

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
<body class="auth-page">

    <div class="auth-wrapper">

        <div class="auth-header">

            <img
                src="{{ asset('images/logo/logo.png') }}"
                alt="Logo SIPBongki"
                class="auth-logo">

            <h1 class="system-title">
                SIP BONGKI
            </h1>

            <p class="system-subtitle">
                Sistem Informasi & Layanan Masyarakat
                <br>
                Kelurahan Bongki
            </p>

        </div>

        <div class="auth-card">

            @yield('content')

        </div>

        <div class="auth-footer">

            <h6>
                Kantor Kelurahan Bongki
            </h6>

            <p>
                Kecamatan Sinjai Utara, Kabupaten Sinjai
            </p>

            <small>
                © {{ date('Y') }} SIPBongki. All Rights Reserved.
            </small>

        </div>

    </div>

</body>

</html>