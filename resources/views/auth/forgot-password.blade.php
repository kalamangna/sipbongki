@extends('layouts.auth')

@section('title', 'Lupa Password - SIP Bongki')

@section('content')

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 sm:p-10 dark:bg-slate-900 dark:border-slate-800">

    {{-- Header --}}
    <div class="text-center mb-8">
        <img src="{{ asset('images/logo.png') }}"
             alt="Logo Kelurahan Bongki"
             class="w-16 h-16 object-contain mx-auto mb-4">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100 tracking-tight">Lupa Password</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Masukkan alamat email Anda untuk menerima tautan reset password.</p>
    </div>

    {{-- Status Alert --}}
    @if (session('status'))
        <div class="mb-6 p-3 rounded-xl bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 text-sm flex items-start gap-2">
            <i class="fa-solid fa-circle-check mt-0.5"></i>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    {{-- Form --}}
    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                Alamat Email
            </label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autofocus
                   placeholder="nama@email.com"
                   class="w-full px-4 py-2.5 bg-slate-50 border @error('email') border-rose-500 dark:border-rose-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl text-sm text-slate-900 dark:bg-slate-800 dark:text-slate-100 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors shadow-sm">
            @error('email')
                <p class="text-xs text-rose-600 dark:text-rose-400 mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full py-2.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-semibold text-sm rounded-xl transition-colors shadow-sm cursor-pointer active:scale-95 flex items-center justify-center gap-2">
            <i class="fa-solid fa-paper-plane"></i> Kirim Link Reset Password
        </button>

        <div class="text-center pt-2">
            <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400 inline-flex items-center gap-1.5 transition-colors">
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