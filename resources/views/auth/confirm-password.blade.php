@extends('layouts.auth')

@section('title', 'Konfirmasi Password - SIP Bongki')

@section('content')

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 sm:p-10 dark:bg-slate-900 dark:border-slate-800">

    {{-- Header --}}
    <div class="text-center mb-8">
        <img src="{{ asset('images/logo.png') }}"
             alt="Logo Kelurahan Bongki"
             class="w-16 h-16 object-contain mx-auto mb-4">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100 tracking-tight">Konfirmasi Password</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Demi keamanan, silakan masukkan password Anda untuk melanjutkan.</p>
    </div>

    {{-- Form --}}
    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                Password
            </label>
            <input id="password"
                   type="password"
                   name="password"
                   required
                   autofocus
                   class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-800 focus:border-primary-600 focus:ring-1 focus:ring-primary-600 outline-none transition-colors">
            @error('password')
                <p class="text-xs text-rose-600 dark:text-rose-400 mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full py-2.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-semibold text-sm rounded-xl transition-colors shadow-sm cursor-pointer active:scale-95 flex items-center justify-center gap-2">
            <i class="fa-solid fa-shield-halved"></i> Konfirmasi Password
        </button>
    </form>

</div>

{{-- Footer --}}
<div class="text-center mt-8 text-xs text-slate-500 dark:text-slate-400">
    <p>&copy; {{ date('Y') }} Kelurahan Bongki</p>
</div>

@endsection