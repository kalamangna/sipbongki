@extends('layouts.admin')

@section('title', 'Detail Berita')

@section('content')
<div class="w-full">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight dark:text-slate-100">Detail Berita</h2>
            <p class="text-sm text-slate-500 mt-1 dark:text-slate-400">Informasi lengkap berita Kelurahan Bongki.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.website.berita.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white">
                <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
            </a>
            <a href="{{ route('admin.website.berita.edit', $berita) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-amber-500 text-white hover:bg-amber-600 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none cursor-pointer">
                <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>
            <form action="{{ route('admin.website.berita.destroy', $berita) }}" method="POST" class="inline m-0" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm focus:outline-none hover:-translate-y-0.5 cursor-pointer">
                    <i class="fa-solid fa-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Kiri (Col-2) --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden h-full dark:bg-slate-900 dark:border-slate-800">
                <div class="p-8">
                    @if($berita->gambar)
                        <img src="{{ asset('storage/'.$berita->gambar) }}" class="w-full h-auto max-h-[400px] object-cover rounded-xl shadow-sm mb-8 border border-slate-200 dark:border-slate-700" alt="{{ $berita->judul }}">
                    @endif

                    <h1 class="text-3xl font-extrabold text-slate-900 dark:text-slate-100 mb-4 leading-tight">{{ $berita->judul }}</h1>
                    
                    <div class="flex flex-wrap items-center gap-4 text-sm text-slate-500 mb-8 pb-6 border-b border-slate-100 dark:border-slate-800">
                        <span class="inline-flex items-center gap-2 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300">
                            <i class="fa-solid fa-calendar-day text-slate-400"></i>
                            {{ $berita->tanggal_publish ? $berita->tanggal_publish->format('d F Y') : '-' }}
                        </span>
                        @if($berita->status == 'publish')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-emerald-700 bg-emerald-50 border border-emerald-100 font-semibold uppercase tracking-wide text-xs dark:bg-emerald-950/60 dark:border-emerald-900/60 dark:text-emerald-300">
                                <i class="fa-solid fa-circle-check"></i> Publish
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-slate-700 bg-slate-50 border border-slate-200 font-semibold uppercase tracking-wide text-xs dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300">
                                <i class="fa-solid fa-pen-to-square"></i> Draft
                            </span>
                        @endif
                    </div>

                    <div class="berita-content text-slate-700 dark:text-slate-300 text-base">
                        @if(preg_match('/<[a-z][\s\S]*>/i', $berita->isi))
                            {!! $berita->isi !!}
                        @else
                            {!! nl2br(e($berita->isi)) !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Kanan (Col-1) --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden sticky top-6 dark:bg-slate-900 dark:border-slate-800">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
                    <h3 class="font-bold text-slate-800 dark:text-slate-100 text-sm">Informasi Publikasi</h3>
                </div>
                <div class="p-6 space-y-5">
                    <div>
                        <small class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1 dark:text-slate-400">Status</small>
                        @if($berita->status == 'publish')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 uppercase tracking-wide">Publish</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 uppercase tracking-wide">Draft</span>
                        @endif
                    </div>
                    <div>
                        <small class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1 dark:text-slate-400">Tanggal Publish</small>
                        <div class="font-medium text-slate-900 dark:text-slate-100">{{ $berita->tanggal_publish ? $berita->tanggal_publish->format('d F Y') : '-' }}</div>
                    </div>
                    <div>
                        <small class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1 dark:text-slate-400">Slug URL</small>
                        <div class="font-mono text-sm text-slate-700 dark:text-slate-300 break-all">{{ $berita->slug }}</div>
                    </div>
                    <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                        <small class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1 dark:text-slate-400">Tanggal Dibuat</small>
                        <div class="font-medium text-slate-900 dark:text-slate-100">{{ $berita->created_at->format('d F Y') }}</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">{{ $berita->created_at->format('H:i') }} WITA</div>
                    </div>
                    <div>
                        <small class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1 dark:text-slate-400">Terakhir Diubah</small>
                        <div class="font-medium text-slate-900 dark:text-slate-100">{{ $berita->updated_at->format('d F Y') }}</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">{{ $berita->updated_at->format('H:i') }} WITA</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .berita-content p {
        margin-top: 0;
        margin-bottom: 0.75rem;
    }
    .berita-content p:last-child {
        margin-bottom: 0;
    }
    .berita-content h1, .berita-content h2, .berita-content h3, .berita-content h4 {
        font-weight: 700;
        color: #0f172a;
        margin-top: 1.75rem;
        margin-bottom: 0.75rem;
        line-height: 1.3;
    }
    .dark .berita-content h1, .dark .berita-content h2, .dark .berita-content h3, .dark .berita-content h4 {
        color: #f1f5f9;
    }
    .berita-content ul {
        list-style-type: disc;
        padding-left: 1.5rem;
        margin-bottom: 1rem;
    }
    .berita-content ol {
        list-style-type: decimal;
        padding-left: 1.5rem;
        margin-bottom: 1rem;
    }
    .berita-content blockquote {
        border-left: 4px solid #059669;
        padding-left: 1rem;
        font-style: italic;
        color: #475569;
        margin: 1.25rem 0;
    }
    .dark .berita-content blockquote {
        color: #94a3b8;
    }
    .berita-content img {
        border-radius: 0.75rem;
        max-width: 100%;
        height: auto;
        margin: 1.5rem 0;
    }
    .berita-content a {
        color: #059669;
        text-decoration: underline;
    }
</style>
@endpush