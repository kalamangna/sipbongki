@extends('layouts.public')

@section('title', $pengumuman->judul)

@section('content')

<section class="py-24 bg-slate-50 pt-32">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
            <i class="fa-solid fa-chevron-right"></i>
            <a href="{{ route('home') }}#pengumuman" class="hover:text-primary transition-colors">Pengumuman</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span class="text-slate-400">Detail Pengumuman</span>
        </nav>

        {{-- Header --}}
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800 leading-tight mb-6">
            {{ $pengumuman->judul }}
        </h1>

        <div class="flex flex-wrap items-center gap-4 text-sm text-slate-500 mb-8 border-b border-slate-200 pb-8">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-calendar-days"></i>
                {{ optional($pengumuman->tanggal_publish)->translatedFormat('d F Y')
                    ?? $pengumuman->created_at->translatedFormat('d F Y') }}
            </div>
            <div class="flex items-center gap-2">
                <i class="fa-regular fa-circle-user"></i>
                Pemerintah Kelurahan Bongki
            </div>
        </div>

        {{-- Main Content --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-8">
            @if($pengumuman->gambar)
                <img src="{{ asset('storage/'.$pengumuman->gambar) }}"
                     alt="{{ $pengumuman->judul }}"
                     class="w-full max-h-[500px] object-cover">
            @endif

            <div class="p-6 md:p-10 prose prose-slate max-w-none prose-headings:font-bold prose-a:text-primary prose-img:rounded-xl">
                {!! $pengumuman->isi !!}
            </div>
        </div>

        {{-- Back Button --}}
        <div>
            <a href="{{ route('home') }}#pengumuman"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border border-primary text-primary font-semibold hover:bg-primary-light transition-colors">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali ke Pengumuman
            </a>
        </div>

    </div>
</section>

@endsection