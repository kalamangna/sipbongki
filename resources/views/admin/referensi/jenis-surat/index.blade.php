@extends('layouts.admin')

@section('title', 'Jenis Surat')

@section('content')
<div class="w-full">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Data Jenis Surat</h2>
            <p class="text-sm text-slate-500 mt-1">Master Data Jenis Surat Kelurahan Bongki.</p>
        </div>
        <a href="{{ route('admin.jenis-surat.create') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none">
            <i class="fa-solid fa-circle-plus"></i> Tambah Jenis Surat
        </a>
    </div>

    <div class="mb-6 p-4 rounded-xl bg-amber-50 border border-amber-200 flex gap-3 items-start shadow-sm">
        <i class="fa-solid fa-triangle-exclamation text-amber-500 mt-0.5"></i>
        <div>
            <h4 class="text-sm font-bold text-amber-800">Perhatian</h4>
            <p class="text-sm text-amber-700 mt-1">Data jenis surat berperan dalam logika persuratan. Jangan melakukan perubahan sembarangan karena dapat memengaruhi alur pembuatan dan pencetakan surat di website.</p>
        </div>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        
        {{-- Filters --}}
        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
            <form method="GET" class="flex flex-col md:flex-row gap-3">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ $search }}" class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-2.5 shadow-sm" placeholder="Cari Kode atau Nama Surat...">
                </div>
                
                <div class="flex gap-2">
                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl bg-slate-800 text-white hover:bg-slate-700 shadow-sm transition-all w-full md:w-auto focus:outline-none focus:ring-2 focus:ring-slate-500">
                        <i class="fa-solid fa-magnifying-glass"></i> Cari
                    </button>
                    @if($search)
                        <a href="{{ route('admin.jenis-surat.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all focus:outline-none" title="Reset Filter">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/80">
                    <tr>
                        <th width="70" class="px-6 py-4 border-b border-slate-100 text-center">No</th>
                        <th width="150" class="px-6 py-4 border-b border-slate-100">Kode</th>
                        <th class="px-6 py-4 border-b border-slate-100">Nama Surat</th>
                        <th width="120" class="px-6 py-4 border-b border-slate-100 text-center">Status</th>
                        <th width="100" class="px-6 py-4 border-b border-slate-100 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($jenisSurats as $jenisSurat)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-6 py-4 text-center font-medium">{{ $jenisSurats->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-4 font-mono text-xs">{{ $jenisSurat->kode }}</td>
                        <td class="px-6 py-4 font-bold text-slate-900">{{ $jenisSurat->nama }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($jenisSurat->aktif)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 tracking-wide">Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 tracking-wide">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.jenis-surat.edit', $jenisSurat) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 hover:text-amber-700 transition-colors focus:outline-none" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.jenis-surat.destroy', $jenisSurat) }}" method="POST" class="inline mb-0" onsubmit="return confirm('Yakin ingin menghapus jenis surat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 hover:text-rose-700 transition-colors focus:outline-none" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <i class="fa-solid fa-inbox text-4xl mb-4 text-slate-300"></i>
                                <p class="text-sm">Belum ada data Jenis Surat.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($jenisSurats->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-white">
            {{ $jenisSurats->links() }}
        </div>
        @endif

    </div>
</div>
@endsection