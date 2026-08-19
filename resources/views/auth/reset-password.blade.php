@extends('layouts.auth')

@section('title', 'Reset Password - SIP Bongki')

@section('content')

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 sm:p-10 dark:bg-slate-900 dark:border-slate-800">

    {{-- Header --}}
    <div class="text-center mb-8">
        <img src="{{ asset('images/logo.png') }}"
             alt="Logo Kelurahan Bongki"
             class="w-16 h-16 object-contain mx-auto mb-4">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100 tracking-tight">Reset Password</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Masukkan email dan password baru akun Anda.</p>
    </div>

    {{-- Form --}}
    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ request()->route('token') }}">

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                Alamat Email
            </label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email', request('email')) }}"
                   required
                   class="w-full px-4 py-2.5 bg-slate-50 border @error('email') border-rose-500 dark:border-rose-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl text-sm text-slate-900 dark:bg-slate-800 dark:text-slate-100 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors shadow-sm">
            @error('email')
                <p class="text-xs text-rose-600 dark:text-rose-400 mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                Password Baru
            </label>
            <input id="password"
                   type="password"
                   name="password"
                   required
                   placeholder="Minimal 8 karakter"
                   class="w-full px-4 py-2.5 bg-slate-50 border @error('password') border-rose-500 dark:border-rose-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl text-sm text-slate-900 dark:bg-slate-800 dark:text-slate-100 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors shadow-sm">
            @error('password')
                <p class="text-xs text-rose-600 dark:text-rose-400 mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                Konfirmasi Password Baru
            </label>
            <input id="password_confirmation"
                   type="password"
                   name="password_confirmation"
                   required
                   placeholder="Ketik ulang password"
                   class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-900 dark:bg-slate-800 dark:text-slate-100 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors shadow-sm">
        </div>

        <button type="submit"
                class="w-full py-2.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-semibold text-sm rounded-xl transition-colors shadow-sm cursor-pointer active:scale-95 flex items-center justify-center gap-2">
            <i class="fa-solid fa-key"></i> Simpan Password Baru
        </button>

        <div class="text-center pt-2">
            <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400 inline-flex items-center gap-1.5 transition-colors cursor-pointer">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Login
            </a>
        </div>
    </form>

</div>

{{-- Footer --}}
<div class="text-center mt-8 text-xs text-slate-500 dark:text-slate-400">
    <p>&copy; {{ date('Y') }} Kelurahan Bongki</p>
</div>

@endsection