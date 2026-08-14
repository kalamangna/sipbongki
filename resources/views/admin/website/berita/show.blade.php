@extends('layouts.admin')

@section('title', 'Detail Berita')

@section('content')
<div class="w-full">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Detail Berita</h2>
            <p class="text-sm text-slate-500 mt-1">Informasi lengkap berita Kelurahan Bongki.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.website.berita.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none">
                <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
            </a>
            <a href="{{ route('admin.website.berita.edit', $berita) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-amber-500 text-white hover:bg-amber-600 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none">
                <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>
            <form action="{{ route('admin.website.berita.destroy', $berita) }}" method="POST" class="inline m-0" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm focus:outline-none hover:-translate-y-0.5">
                    <i class="fa-solid fa-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Kiri (Col-2) --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden h-full">
                <div class="p-8">
                    @if($berita->gambar)
                        <img src="{{ asset('storage/'.$berita->gambar) }}" class="w-full h-auto max-h-[400px] object-cover rounded-xl shadow-sm mb-8 border border-slate-200" alt="{{ $berita->judul }}">
                    @endif

                    <h1 class="text-3xl font-extrabold text-slate-900 mb-4 leading-tight">{{ $berita->judul }}</h1>
                    
                    <div class="flex flex-wrap items-center gap-4 text-sm text-slate-500 mb-8 pb-6 border-b border-slate-100">
                        <span class="inline-flex items-center gap-2 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100">
                            <i class="fa-solid fa-calendar-day text-slate-400"></i>
                            {{ $berita->tanggal_publish ? $berita->tanggal_publish->format('d F Y') : '-' }}
                        </span>
                        @if($berita->status == 'publish')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-emerald-700 bg-emerald-50 border border-emerald-100 font-semibold uppercase tracking-wide text-xs">
                                <i class="fa-solid fa-circle-check"></i> Publish
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-slate-700 bg-slate-50 border border-slate-200 font-semibold uppercase tracking-wide text-xs">
                                <i class="fa-solid fa-pen-to-square"></i> Draft
                            </span>
                        @endif
                    </div>

                    <div class="prose prose-slate max-w-none text-slate-700 leading-loose text-justify">
                        {!! nl2br(e($berita->isi)) !!}
                    </div>
                </div>
            </div>
        </div>

        {{-- Kanan (Col-1) --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden sticky top-6">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="font-bold text-slate-800 text-sm">Informasi Publikasi</h3>
                </div>
                <div class="p-6 space-y-5">
                    <div>
                        <small class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Status</small>
                        @if($berita->status == 'publish')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 uppercase tracking-wide">Publish</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700 uppercase tracking-wide">Draft</span>
                        @endif
                    </div>
                    <div>
                        <small class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Tanggal Publish</small>
                        <div class="font-medium text-slate-900">{{ $berita->tanggal_publish ? $berita->tanggal_publish->format('d F Y') : '-' }}</div>
                    </div>
                    <div>
                        <small class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Slug URL</small>
                        <div class="font-mono text-sm text-slate-700 break-all">{{ $berita->slug }}</div>
                    </div>
                    <div class="pt-4 border-t border-slate-100">
                        <small class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Tanggal Dibuat</small>
                        <div class="font-medium text-slate-900">{{ $berita->created_at->format('d F Y') }}</div>
                        <div class="text-xs text-slate-500">{{ $berita->created_at->format('H:i') }} WITA</div>
                    </div>
                    <div>
                        <small class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Terakhir Diubah</small>
                        <div class="font-medium text-slate-900">{{ $berita->updated_at->format('d F Y') }}</div>
                        <div class="text-xs text-slate-500">{{ $berita->updated_at->format('H:i') }} WITA</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection