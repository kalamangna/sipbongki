@extends('layouts.auth')

@section('title', 'Masuk ke SIPBongki')

@section('content')

<div class="login-container">

    <div class="login-header">

        <h2 class="login-title">
            Masuk
        </h2>

        <p class="login-subtitle">
            Silakan masuk menggunakan akun Anda untuk mengakses layanan SIPBongki.
        </p>

    </div>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            Email atau password yang Anda masukkan tidak sesuai.
        </div>
    @endif

    <form
        method="POST"
        action="{{ $loginRoute }}"
        class="login-form">

        @csrf

        {{-- Email --}}
        <div class="mb-4">

            <label
                for="email"
                class="form-label">

                Email

            </label>

            <div class="login-input">

                <i class="fa-solid fa-envelope"></i>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email Anda"
                    required
                    autofocus>

            </div>

            @error('email')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror

        </div>

        {{-- Password --}}
        <div class="mb-4">

            <label
                for="password"
                class="form-label">

                Password

            </label>

            <div class="login-input password-input">

                <i class="fa-solid fa-lock"></i>

                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Masukkan password Anda"
                    required>

                <button
                    type="button"
                    class="password-toggle"
                    id="togglePassword">

                    <i
                        class="fa-regular fa-eye"
                        id="toggleIcon"></i>

                </button>

            </div>

            @error('password')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror

        </div>

        <div class="login-option mb-4">

            <div class="form-check">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="remember"
                    id="remember">

                <label
                    class="form-check-label"
                    for="remember">

                    Ingat Saya

                </label>

            </div>

            @if(Route::has('password.request'))

                <a href="{{ route('password.request') }}">

                    Lupa Password?

                </a>

            @endif

        </div>

        <button
            type="submit"
            class="btn-login">

            <i class="fa-solid fa-right-to-bracket me-2"></i>

            Masuk

        </button>

    </form>

    @if(Route::has('register'))

        <div class="register-box">

            <span>
                Belum memiliki akun?
            </span>

            <a href="{{ route('register') }}">

                Daftar Sekarang

            </a>

        </div>

    @endif

</div>

@endsection