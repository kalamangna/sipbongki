@extends('layouts.auth')

@section('title', 'Login - SIP Bongki')

@section('content')

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 sm:p-10 dark:bg-slate-900 dark:border-slate-800">

    {{-- System Header / Logo --}}
    <div class="text-center mb-8">
        <img src="{{ asset('images/logo.png') }}"
             alt="Logo Kelurahan Bongki"
             class="w-16 h-16 object-contain mx-auto mb-4">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100 tracking-tight">SIP Bongki</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Sistem Informasi & Pelayanan Kelurahan</p>
    </div>

    {{-- Alerts --}}
    @if(session('status'))
        <div class="mb-6 p-3 rounded-xl bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 text-sm flex items-start gap-2">
            <i class="fa-solid fa-circle-check mt-0.5"></i>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-3 rounded-xl bg-rose-50 text-rose-700 dark:bg-rose-950/60 dark:text-rose-300 text-sm flex items-start gap-2">
            <i class="fa-solid fa-circle-exclamation mt-0.5"></i>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    {{-- Login Form --}}
    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- Username Input --}}
        <div>
            <label for="username" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                Username
            </label>
            <input id="username"
                   type="text"
                   name="username"
                   value="{{ old('username') }}"
                   required
                   autofocus
                   class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-800 focus:border-primary-600 focus:ring-1 focus:ring-primary-600 outline-none transition-colors">
            @error('username')
                <p class="text-xs text-rose-600 dark:text-rose-400 mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password Input --}}
        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                Password
            </label>
            <div class="relative">
                <input id="password"
                       type="password"
                       name="password"
                       required
                       class="w-full pl-4 pr-10 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-800 focus:border-primary-600 focus:ring-1 focus:ring-primary-600 outline-none transition-colors">
                <button type="button"
                        onclick="togglePasswordVisibility()"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 focus:outline-none cursor-pointer"
                        aria-label="Lihat Password">
                    <i class="fa-solid fa-eye text-sm" id="password-toggle-icon"></i>
                </button>
            </div>
            @error('password')
                <p class="text-xs text-rose-600 dark:text-rose-400 mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Options --}}
        <div class="flex items-center justify-between pt-1">
            <label class="inline-flex items-center gap-2 cursor-pointer select-none">
                <input type="checkbox"
                       name="remember"
                       id="remember"
                       class="w-4 h-4 rounded border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-primary-600 focus:ring-primary-600">
                <span class="text-sm text-slate-600 dark:text-slate-400">Ingat saya</span>
            </label>
        </div>

        {{-- Submit Button --}}
        <button type="submit"
                class="w-full py-2.5 px-4 mt-2 bg-primary-600 hover:bg-primary-700 text-white font-semibold text-sm rounded-xl transition-colors shadow-sm cursor-pointer active:scale-95">
            Login
        </button>
    </form>

</div>

{{-- Footer --}}
<div class="text-center mt-8 text-xs text-slate-500 dark:text-slate-400">
    <p>&copy; {{ date('Y') }} Kelurahan Bongki</p>
</div>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('password-toggle-icon');

        if (!passwordInput || !toggleIcon) return;

        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';

        toggleIcon.classList.toggle('fa-eye', !isPassword);
        toggleIcon.classList.toggle('fa-eye-slash', isPassword);
    }
</script>

@endsection