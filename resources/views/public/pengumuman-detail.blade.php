@extends('layouts.public')

@section('title', $pengumuman->judul)

@section('content')

<div class="pt-32 pb-20 bg-slate-50 min-h-screen">
    <div class="container mx-auto px-4 max-w-4xl space-y-8">

        {{-- TOMBOL KEMBALI --}}
        <div>
            <a href="{{ url('/#pengumuman') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 text-slate-700 font-semibold text-xs rounded-xl shadow-sm hover:bg-slate-100 transition">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali ke Pengumuman</span>
            </a>
        </div>

        {{-- CARD UTAMA --}}
        <article class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-100 shadow-xl space-y-6">

            {{-- TANGGAL & KATEGORI --}}
            <div class="flex items-center gap-3 text-xs font-semibold text-amber-600">
                <span class="px-3 py-1 bg-amber-50 rounded-full border border-amber-200/60">Pengumuman Resmi</span>
                <span class="text-slate-400">•</span>
                <span class="text-slate-500">
                    <i class="fa-regular fa-clock mr-1"></i>
                    {{ \Carbon\Carbon::parse($pengumuman->tanggal_publish)->translatedFormat('d F Y') }}
                </span>
            </div>

            {{-- JUDUL PENGUMUMAN --}}
            <h1 class="text-2xl sm:text-4xl font-black text-slate-900 leading-tight tracking-tight">
                {{ $pengumuman->judul }}
            </h1>

            {{-- GAMBAR UTAMA (JIKA ADA) --}}
            @if($pengumuman->gambar)
                <div class="rounded-2xl overflow-hidden shadow-md bg-slate-100 max-h-96">
                    <img src="{{ asset('storage/'.$pengumuman->gambar) }}" alt="{{ $pengumuman->judul }}" class="w-full h-full object-cover">
                </div>
            @endif

            {{-- ISI PENGUMUMAN --}}
            <div class="prose prose-slate max-w-none text-slate-700 text-base leading-relaxed pt-4 border-t border-slate-100">
                {!! nl2br(e($pengumuman->isi)) !!}
            </div>

        </article>

    </div>
</div>

@endsection