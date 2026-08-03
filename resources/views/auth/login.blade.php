@extends('layouts.auth')

@section('title', 'Masuk ke SIPBongki')

@section('content')

<div class="text-center mb-3">
    <h5 class="fw-bold text-slate-900 mb-1">Selamat Datang</h5>
    <p class="text-slate-500 small mb-0">Silakan masukkan akun Anda untuk melanjutkan</p>
</div>

@if(session('status'))
    <div class="alert alert-emerald alert-dismissible fade show text-start py-2.5 px-3 mb-3 small border-0 bg-emerald-50 text-emerald-800 rounded-3" role="alert">
        <i class="fa-solid fa-circle-check me-2 text-emerald-600"></i> {{ session('status') }}
        <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-rose alert-dismissible fade show text-start py-2.5 px-3 mb-3 small border-0 bg-rose-50 text-rose-800 rounded-3" role="alert">
        <i class="fa-solid fa-circle-exclamation me-2 text-rose-600"></i> Email atau password yang Anda masukkan tidak sesuai.
        <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<form method="POST" action="{{ $loginRoute }}">
    @csrf

    {{-- Login Field (Username / Email) --}}
    <div class="mb-3 text-start">
        <label for="login" class="form-label small fw-bold text-slate-700 mb-1">Username / Email</label>
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0 text-slate-400">
                <i class="fa-solid fa-user text-sm"></i>
            </span>
            <input id="login" type="text" name="login" value="{{ old('login') }}" class="form-control border-start-0 shadow-none focus-ring focus-ring-emerald @error('login') is-invalid @enderror" placeholder="Masukkan username atau email" required autofocus>
        </div>
        @error('login')
            <div class="invalid-feedback d-block small mt-1 text-rose-600">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- Password Field --}}
    <div class="mb-3 text-start">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <label for="password" class="form-label small fw-bold text-slate-700 mb-0">Password</label>
            @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-emerald-600 hover:text-emerald-700 text-decoration-none small fw-semibold transition">
                    Lupa password?
                </a>
            @endif
        </div>
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0 text-slate-400">
                <i class="fa-solid fa-lock text-sm"></i>
            </span>
            <input id="password" type="password" name="password" class="form-control border-start-0 border-end-0 shadow-none focus-ring focus-ring-emerald @error('password') is-invalid @enderror" placeholder="••••••••" required>
            <button class="btn btn-outline-secondary border-start-0 text-slate-400 hover:text-slate-600 shadow-none" type="button" id="togglePassword">
                <i class="fa-regular fa-eye" id="toggleIcon"></i>
            </button>
        </div>
        @error('password')
            <div class="invalid-feedback d-block small mt-1 text-rose-600">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- Remember Me --}}
    <div class="mb-3 form-check text-start">
        <input class="form-check-input shadow-none" type="checkbox" name="remember" id="remember">
        <label class="form-check-label small text-slate-600" for="remember">
            Ingat Sesi Saya
        </label>
    </div>

    {{-- Submit Button (Bootstrap 5.3 Clean Button) --}}
    <button type="submit" class="btn btn-success w-100 fw-bold py-2.5 shadow-sm rounded-3 d-inline-flex align-items-center justify-content-center gap-2">
        <i class="fa-solid fa-right-to-bracket"></i>
        <span>Masuk Sekarang</span>
    </button>

</form>

@endsection