@extends('layouts.public')

@section('title', $berita->judul)

@section('content')

<div class="pt-32 pb-20 bg-slate-50 min-h-screen">
    <div class="container mx-auto px-4 max-w-4xl space-y-8">

        {{-- TOMBOL KEMBALI --}}
        <div>
            <a href="{{ url('/#berita') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 text-slate-700 font-semibold text-xs rounded-xl shadow-sm hover:bg-slate-100 transition">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali ke Berita</span>
            </a>
        </div>

        {{-- CARD UTAMA --}}
        <article class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-100 shadow-xl space-y-6">

            {{-- TANGGAL & KATEGORI --}}
            <div class="flex items-center gap-3 text-xs font-semibold text-emerald-600">
                <span class="px-3 py-1 bg-emerald-50 rounded-full">Berita Kelurahan</span>
                <span class="text-slate-400">•</span>
                <span class="text-slate-500">
                    <i class="fa-regular fa-clock mr-1"></i>
                    {{ \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('d F Y') }}
                </span>
            </div>

            {{-- JUDUL BERITA --}}
            <h1 class="text-2xl sm:text-4xl font-black text-slate-900 leading-tight tracking-tight">
                {{ $berita->judul }}
            </h1>

            {{-- GAMBAR UTAMA --}}
            @if($berita->gambar)
                <div class="rounded-2xl overflow-hidden shadow-md bg-slate-100 max-h-96">
                    <img src="{{ asset('storage/'.$berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover">
                </div>
            @endif

            {{-- ISI BERITA --}}
            <div class="prose prose-slate max-w-none text-slate-700 text-base leading-relaxed pt-4 border-t border-slate-100">
                {!! nl2br(e($berita->isi)) !!}
            </div>

        </article>

    </div>
</div>

@endsection