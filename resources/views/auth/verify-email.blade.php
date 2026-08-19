@extends('layouts.auth')

@section('title', 'Verifikasi Email - SIP Bongki')

@section('content')

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 sm:p-10 dark:bg-slate-900 dark:border-slate-800">

    {{-- Header --}}
    <div class="text-center mb-8">
        <img src="{{ asset('images/logo.png') }}"
             alt="Logo Kelurahan Bongki"
             class="w-16 h-16 object-contain mx-auto mb-4">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100 tracking-tight">Verifikasi Email</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">
            Terima kasih telah mendaftar. Sebelum melanjutkan, silakan periksa email Anda dan klik tautan verifikasi yang telah dikirim.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 p-3 rounded-xl bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 text-sm flex items-start gap-2">
            <i class="fa-solid fa-circle-check mt-0.5"></i>
            <span>Link verifikasi baru telah berhasil dikirim ke alamat email Anda.</span>
        </div>
    @endif

    <div class="space-y-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                    class="w-full py-2.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-semibold text-sm rounded-xl transition-colors shadow-sm cursor-pointer active:scale-95 flex items-center justify-center gap-2">
                <i class="fa-solid fa-envelope-circle-check"></i> Kirim Ulang Email Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full py-2.5 px-4 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-semibold text-sm rounded-xl transition-colors cursor-pointer active:scale-95 flex items-center justify-center gap-2">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar
            </button>
        </form>
    </div>

</div>

{{-- Footer --}}
<div class="text-center mt-8 text-xs text-slate-500 dark:text-slate-400">
    <p>&copy; {{ date('Y') }} Kelurahan Bongki</p>
</div>

@endsection