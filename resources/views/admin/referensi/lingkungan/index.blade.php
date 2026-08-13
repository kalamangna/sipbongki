@extends('layouts.admin')

@section('title', 'Lingkungan')

@section('content')
<div class="w-full">

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Data Lingkungan</h2>
            <p class="text-sm text-slate-500 mt-1">Master Data Lingkungan Kelurahan Bongki</p>
        </div>
        <a href="{{ route('admin.lingkungan.create') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none">
            <i class="fa-solid fa-circle-plus"></i> Tambah Lingkungan
        </a>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        
        {{-- Filters --}}
        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
            <form method="GET" class="flex flex-col md:flex-row gap-3">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ $search }}" class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-2.5 shadow-sm" placeholder="Cari nama lingkungan...">
                </div>
                
                <div class="flex gap-2">
                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl bg-slate-800 text-white hover:bg-slate-700 shadow-sm transition-all w-full md:w-auto focus:outline-none focus:ring-2 focus:ring-slate-500">
                        <i class="fa-solid fa-magnifying-glass"></i> Cari
                    </button>
                    @if($search)
                        <a href="{{ route('admin.lingkungan.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all focus:outline-none" title="Reset Filter">
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
                        <th width="50" class="px-6 py-4 border-b border-slate-100 text-center">No</th>
                        <th class="px-6 py-4 border-b border-slate-100">Kode</th>
                        <th class="px-6 py-4 border-b border-slate-100">Nama Lingkungan</th>
                        <th class="px-6 py-4 border-b border-slate-100">Kepala Lingkungan</th>
                        <th class="px-6 py-4 border-b border-slate-100 text-center">Status</th>
                        <th width="100" class="px-6 py-4 border-b border-slate-100 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($lingkungans as $lingkungan)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-6 py-4 text-center font-medium">{{ $lingkungans->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-4 font-mono text-xs">{{ $lingkungan->kode }}</td>
                        <td class="px-6 py-4 font-medium text-slate-900">{{ $lingkungan->nama }}</td>
                        <td class="px-6 py-4">{{ $lingkungan->ketua_lingkungan ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($lingkungan->status)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 tracking-wide">Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 tracking-wide">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.lingkungan.show', $lingkungan) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 hover:text-sky-700 transition-colors focus:outline-none" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <i class="fa-solid fa-inbox text-4xl mb-4 text-slate-300"></i>
                                <p class="text-sm">Tidak ada data lingkungan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($lingkungans->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-white">
            {{ $lingkungans->links() }}
        </div>
        @endif

    </div>
</div>
@endsection
