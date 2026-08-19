@extends('layouts.admin')

@section('title', 'Aparatur')

@section('content')
<div class="w-full">

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight dark:text-slate-100">Aparatur</h2>
            <p class="text-sm text-slate-500 mt-1 dark:text-slate-400">Kelola data aparatur dan perangkat kelurahan</p>
        </div>
        <a href="{{ route('admin.perangkat.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-primary-500 active:scale-95 cursor-pointer">
            <i class="fa-solid fa-circle-plus"></i> Tambah Perangkat
        </a>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
        
        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300 min-w-[650px]">
                <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/50 dark:bg-slate-800/80 dark:text-slate-400">
                    <tr>
                        <th width="80" class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 text-center">Foto</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">Nama Lengkap</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">NIP</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">Jabatan</th>
                        <th width="100" class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 text-center">Status</th>
                        <th width="120" class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($perangkats as $perangkat)
                    <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">
                            @if($perangkat->foto)
                                <img src="{{ asset('storage/'.$perangkat->foto) }}" alt="Foto {{ $perangkat->nama_lengkap }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-white dark:ring-slate-700 shadow-sm mx-auto">
                            @else
                                <div class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-500 ring-2 ring-white dark:ring-slate-700 shadow-sm mx-auto">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 font-bold text-slate-900 dark:text-slate-100">{{ $perangkat->nama_lengkap }}</td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 font-mono text-slate-700 dark:text-slate-300">{{ $perangkat->nip ?? '-' }}</td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 font-medium text-slate-800 dark:text-slate-200">{{ $perangkat->jabatan->nama ?? '-' }}</td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">
                            @if($perangkat->aktif)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 tracking-wide">Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 dark:bg-rose-950/60 dark:text-rose-300 tracking-wide">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.perangkat.show', $perangkat->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 hover:text-sky-700 dark:bg-sky-950/40 dark:text-sky-300 dark:hover:bg-sky-900/60 transition-all active:scale-95 cursor-pointer" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-400 dark:text-slate-500">
                            <i class="fa-solid fa-user-tie text-4xl mb-4 text-slate-300 dark:text-slate-600"></i>
                            <p class="text-sm">Belum ada data perangkat kelurahan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($perangkats->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-white dark:bg-slate-900 dark:border-slate-800">
            {{ $perangkats->links() }}
        </div>
        @endif

    </div>
</div>
@endsection