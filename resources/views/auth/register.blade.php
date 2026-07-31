@extends('layouts.auth')

@section('title', 'Daftar Akun Masyarakat')

@section('content')

<div class="login-container">

    <div class="login-header text-center">

        <h2 class="login-title">
            Daftar Akun
        </h2>

        <p class="login-subtitle">
            Buat akun masyarakat untuk mengakses layanan SIPBongki.
        </p>

    </div>

    @if ($errors->any())

        <div class="alert alert-danger">

            Terdapat data yang belum valid.

        </div>

    @endif

    <form method="POST"
          action="{{ route('register') }}"
          class="login-form">

        @csrf

        {{-- Nama --}}

        <div class="mb-3">

            <label class="form-label">

                Nama Lengkap

            </label>

            <div class="login-input">

                <i class="fa-solid fa-user"></i>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama lengkap"
                    required>

            </div>

            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>

        {{-- Email --}}

        <div class="mb-3">

            <label class="form-label">

                Email

            </label>

            <div class="login-input">

                <i class="fa-solid fa-envelope"></i>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email"
                    required>

            </div>

            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>

        {{-- Password --}}

        <div class="mb-3">

            <label class="form-label">

                Password

            </label>

            <div class="login-input">

                <i class="fa-solid fa-lock"></i>

                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    required>

            </div>

            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>

        {{-- Konfirmasi Password --}}

        <div class="mb-4">

            <label class="form-label">

                Konfirmasi Password

            </label>

            <div class="login-input">

                <i class="fa-solid fa-lock"></i>

                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Ulangi password"
                    required>

            </div>

        </div>

        <button
            type="submit"
            class="btn-login">

            <i class="fa-solid fa-user-plus me-2"></i>

            Daftar Akun

        </button>

    </form>

    <div class="register-box">

        <span>

            Sudah memiliki akun?

        </span>

        <a href="{{ url('/login') }}">

            Masuk

        </a>

    </div>

</div>

@endsection