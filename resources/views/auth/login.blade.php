@extends('layouts.auth')

@section('title', 'Login - SIP Bongki')

@section('content')

<div class="bg-white rounded-3xl shadow-md border border-slate-200 p-6 sm:p-8 md:p-10 dark:bg-slate-900 dark:border-slate-800">

    {{-- System Header / Logo --}}
    <div class="text-center mb-8">
        <div class="w-16 h-16 mx-auto bg-primary-light dark:bg-primary-950/60 rounded-2xl flex items-center justify-center mb-4 text-primary dark:text-primary-400 p-2.5 shadow-sm border border-slate-100 dark:border-slate-800">
            <img src="{{ asset('images/logo.png') }}"
                 alt="Logo Kelurahan Bongki"
                 class="h-11 w-auto">
        </div>
        <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">SIP Bongki</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Sistem Informasi & Pelayanan Kelurahan</p>
    </div>

    {{-- Alerts --}}
    @if(session('status'))
        <div class="mb-6 p-4 rounded-2xl bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 text-sm flex items-start gap-2.5 border border-emerald-100 dark:border-emerald-900/60 shadow-sm">
            <i class="fa-solid fa-circle-check text-base mt-0.5 shrink-0"></i>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-rose-50 text-rose-700 dark:bg-rose-950/60 dark:text-rose-300 text-sm flex items-start gap-2.5 border border-rose-100 dark:border-rose-900/60 shadow-sm">
            <i class="fa-solid fa-circle-exclamation text-base mt-0.5 shrink-0"></i>
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
                   class="w-full px-4 py-2.5 bg-slate-50 border @error('username') border-rose-500 dark:border-rose-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl text-sm text-slate-900 dark:bg-slate-800 dark:text-slate-100 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors shadow-sm">
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
                       class="w-full pl-4 pr-10 py-2.5 bg-slate-50 border @error('password') border-rose-500 dark:border-rose-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl text-sm text-slate-900 dark:bg-slate-800 dark:text-slate-100 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors shadow-sm">
                <button type="button"
                        onclick="togglePasswordVisibility()"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 dark:text-slate-400 dark:hover:text-slate-200 focus:outline-none cursor-pointer"
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
                class="w-full flex items-center justify-center gap-2 py-2.5 px-4 mt-2 bg-primary-600 hover:bg-primary-700 text-white font-semibold text-sm rounded-xl transition-all shadow-sm cursor-pointer active:scale-95 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
            <i class="fa-solid fa-right-to-bracket text-sm"></i>
            <span>Login</span>
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