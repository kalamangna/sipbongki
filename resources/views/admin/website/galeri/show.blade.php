@extends('layouts.admin')

@section('title', 'Detail Galeri')

@section('content')
<div class="w-full">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Detail Galeri</h2>
            <p class="text-sm text-slate-500 mt-1">Informasi dokumentasi kegiatan Kelurahan Bongki.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.website.galeri.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none">
                <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
            </a>
            <a href="{{ route('admin.website.galeri.edit', $galeri->id) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-amber-500 text-white hover:bg-amber-600 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none">
                <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>
            <form action="{{ route('admin.website.galeri.destroy', $galeri->id) }}" method="POST" class="inline m-0" onsubmit="return confirm('Hapus dokumentasi galeri ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm focus:outline-none hover:-translate-y-0.5">
                    <i class="fa-solid fa-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Kiri (Col-2) : Gambar & Konten Utama --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-8">
                    @if($galeri->gambar)
                        <div class="bg-slate-50 rounded-xl mb-8 border border-slate-200 p-2 text-center">
                            <img src="{{ asset('storage/'.$galeri->gambar) }}" class="w-full h-auto max-h-[500px] object-cover rounded-lg mx-auto" alt="{{ $galeri->judul }}">
                        </div>
                    @else
                        <div class="w-full h-[300px] bg-slate-100 rounded-xl mb-8 border border-slate-200 flex flex-col items-center justify-center text-slate-400">
                            <i class="fa-solid fa-image text-5xl mb-4"></i>
                            <p>Tidak ada foto</p>
                        </div>
                    @endif

                    <h1 class="text-2xl font-extrabold text-slate-900 mb-4 leading-tight">{{ $galeri->judul }}</h1>
                    
                    <div class="flex items-center gap-3 text-sm text-slate-500 mb-6 pb-6 border-b border-slate-100">
                        @if($galeri->status == 'aktif')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-emerald-700 bg-emerald-50 border border-emerald-100 font-semibold uppercase tracking-wide text-[11px]">
                                <i class="fa-solid fa-circle-check"></i> Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-slate-700 bg-slate-50 border border-slate-200 font-semibold uppercase tracking-wide text-[11px]">
                                <i class="fa-solid fa-ban"></i> Nonaktif
                            </span>
                        @endif
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 mb-3">Deskripsi</h3>
                    <div class="prose prose-slate max-w-none text-slate-700 leading-loose">
                        {{ $galeri->deskripsi ?: 'Tidak ada deskripsi.' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Kanan (Col-1) : Metadata --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden sticky top-6">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="font-bold text-slate-800 text-sm">Informasi Riwayat</h3>
                </div>
                <div class="p-6 space-y-5">
                    <div>
                        <small class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Tanggal Dibuat</small>
                        <div class="font-medium text-slate-900">{{ $galeri->created_at->format('d F Y') }}</div>
                        <div class="text-xs text-slate-500">{{ $galeri->created_at->format('H:i') }} WITA</div>
                    </div>
                    <div>
                        <small class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Terakhir Diperbarui</small>
                        <div class="font-medium text-slate-900">{{ $galeri->updated_at->format('d F Y') }}</div>
                        <div class="text-xs text-slate-500">{{ $galeri->updated_at->format('H:i') }} WITA</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection