@extends('layouts.public')

@section('seo_title', $berita->judul)
@section('seo_description', Str::limit(strip_tags($berita->isi), 160))
@if($berita->gambar)
    @section('seo_image', asset('storage/'.$berita->gambar))
@endif

@section('content')

<section class="py-24 bg-slate-50 pt-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-slate-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <a href="{{ route('home') }}#berita" class="hover:text-primary transition-colors">Berita</a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <span class="text-slate-400">Detail Berita</span>
        </nav>

        <div class="grid lg:grid-cols-12 gap-10 items-start">
            
            {{-- ── KOLOM UTAMA (KONTEN ARTIKEL) ── --}}
            <div class="lg:col-span-8">
                
                {{-- Header --}}
                <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800 leading-tight mb-6">
                    {{ $berita->judul }}
                </h1>

                {{-- Meta --}}
                <div class="flex flex-wrap items-center gap-3 text-sm text-slate-500 border-b border-slate-200 pb-6 mb-8">
                    <div class="flex items-center gap-2 bg-white px-3 py-1.5 rounded-full border border-slate-200 shadow-sm">
                        <i class="fa-solid fa-calendar-days text-primary"></i>
                        <span class="font-medium">{{ optional($berita->tanggal_publish)->translatedFormat('d F Y') ?? $berita->created_at->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white px-3 py-1.5 rounded-full border border-slate-200 shadow-sm">
                        <i class="fa-solid fa-circle-user text-primary"></i>
                        <span class="font-medium">Pemerintah Kel. Bongki</span>
                    </div>
                </div>

                {{-- Image & Body --}}
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden mb-8">
                    @if($berita->gambar)
                        <div class="overflow-hidden">
                            <img src="{{ asset('storage/'.$berita->gambar) }}"
                                 alt="{{ $berita->judul }}"
                                 class="w-full aspect-video object-cover hover:scale-105 transition-transform duration-700">
                        </div>
                    @endif

                    <div class="p-6 md:p-10 prose prose-slate max-w-none prose-headings:font-bold prose-a:text-primary prose-img:rounded-2xl">
                        {!! $berita->isi !!}
                    </div>

                    {{-- Social Share Bottom --}}
                    <div class="px-6 md:px-10 py-5 border-t border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <span class="text-sm font-bold text-slate-700">Bagikan artikel ini:</span>
                        <div class="flex items-center gap-3">
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' ' . request()->url()) }}" target="_blank" 
                               class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center hover:bg-emerald-500 hover:text-white transition-colors shadow-sm" title="Bagikan ke WhatsApp">
                                <i class="fa-brands fa-whatsapp text-lg"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" 
                               class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors shadow-sm" title="Bagikan ke Facebook">
                                <i class="fa-brands fa-facebook-f text-lg"></i>
                            </a>
                            <button onclick="navigator.clipboard.writeText('{{ request()->url() }}'); alert('Tautan berhasil disalin!');" 
                                    class="w-10 h-10 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center hover:bg-slate-600 hover:text-white transition-colors shadow-sm" title="Salin Tautan">
                                <i class="fa-solid fa-link text-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Back Button --}}
                <div class="mt-4 mb-8 lg:mb-0">
                    <a href="{{ route('home') }}#berita"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border-2 border-primary text-primary font-semibold hover:bg-primary hover:text-white transition-all duration-200 hover:-translate-y-0.5 shadow-sm">
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali ke Beranda
                    </a>
                </div>

            </div>

            {{-- ── SIDEBAR ── --}}
            <aside class="lg:col-span-4 space-y-8 sticky top-28">
                
                {{-- Berita Terbaru --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                    <h3 class="text-base font-bold text-slate-800 mb-4 flex items-center gap-2 border-b border-slate-100 pb-3">
                        <i class="fa-solid fa-newspaper text-primary"></i> Berita Terbaru
                    </h3>
                    
                    <div class="flex flex-col gap-4">
                        @forelse($beritaTerbaru ?? [] as $terbaru)
                            <a href="{{ route('berita.show', $terbaru) }}" class="group flex gap-4 items-start">
                                <div class="w-20 h-20 shrink-0 rounded-xl overflow-hidden bg-slate-100 shadow-inner">
                                    <img src="{{ $terbaru->gambar ? asset('storage/'.$terbaru->gambar) : asset('images/kantor.png') }}" 
                                         alt="{{ $terbaru->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-slate-800 group-hover:text-primary transition-colors line-clamp-2 leading-snug mb-1.5">
                                        {{ $terbaru->judul }}
                                    </h4>
                                    <p class="text-xs text-slate-500 flex items-center gap-1.5">
                                        <i class="fa-regular fa-calendar"></i>
                                        {{ optional($terbaru->tanggal_publish)->translatedFormat('d M Y') ?? $terbaru->created_at->translatedFormat('d M Y') }}
                                    </p>
                                </div>
                            </a>
                        @empty
                            <p class="text-sm text-slate-500 italic">Belum ada berita lainnya.</p>
                        @endforelse
                    </div>
                </div>

            </aside>

        </div>

    </div>
</section>

@endsection