@extends('layouts.admin')

@section('title', 'Detail Lingkungan')

@section('content')
<div class="w-full">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-slate-100 tracking-tight">Detail Lingkungan</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Informasi lengkap data lingkungan Kelurahan Bongki.</p>
        </div>
        <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
            <a href="{{ route('admin.lingkungan.index') }}" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none active:scale-95 cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-slate-100">
                <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
            </a>
            <a href="{{ route('admin.lingkungan.edit', $lingkungan) }}" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-amber-500 text-white hover:bg-amber-600 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none active:scale-95 cursor-pointer">
                <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>
            <form action="{{ route('admin.lingkungan.destroy', $lingkungan) }}" method="POST" class="w-full sm:w-auto inline m-0" onsubmit="return confirm('Yakin ingin menghapus lingkungan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm focus:outline-none hover:-translate-y-0.5 active:scale-95 cursor-pointer">
                    <i class="fa-solid fa-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Kiri (Col-2) --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden h-full dark:bg-slate-900 dark:border-slate-800">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
                    <h3 class="font-bold text-slate-800 dark:text-slate-100 text-sm">Informasi Lingkungan</h3>
                </div>
                <div class="p-0">
                    <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300">
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                                <th width="200" class="px-6 py-4 font-semibold text-slate-700 dark:text-slate-300 bg-slate-50/30 dark:bg-slate-800/30">Kode Lingkungan</th>
                                <td class="px-6 py-4 font-mono font-medium text-slate-900 dark:text-slate-100">{{ $lingkungan->kode ?? '-' }}</td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                                <th class="px-6 py-4 font-semibold text-slate-700 dark:text-slate-300 bg-slate-50/30 dark:bg-slate-800/30">Nama Lingkungan</th>
                                <td class="px-6 py-4 font-bold text-slate-900 dark:text-slate-100">{{ $lingkungan->nama }}</td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                                <th class="px-6 py-4 font-semibold text-slate-700 dark:text-slate-300 bg-slate-50/30 dark:bg-slate-800/30">Kepala Lingkungan</th>
                                <td class="px-6 py-4">{{ $lingkungan->ketua_lingkungan ?? '-' }}</td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                                <th class="px-6 py-4 font-semibold text-slate-700 dark:text-slate-300 bg-slate-50/30 dark:bg-slate-800/30">Telepon</th>
                                <td class="px-6 py-4">{{ $lingkungan->telepon ?? '-' }}</td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                                <th class="px-6 py-4 font-semibold text-slate-700 dark:text-slate-300 bg-slate-50/30 dark:bg-slate-800/30">Status</th>
                                <td class="px-6 py-4">
                                    @if($lingkungan->status)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 tracking-wide">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 tracking-wide">Nonaktif</span>
                                    @endif
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                                <th class="px-6 py-4 font-semibold text-slate-700 dark:text-slate-300 bg-slate-50/30 dark:bg-slate-800/30 align-top">Keterangan</th>
                                <td class="px-6 py-4">{{ $lingkungan->keterangan ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Kanan (Col-1) --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden h-full dark:bg-slate-900 dark:border-slate-800">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
                    <h3 class="font-bold text-slate-800 dark:text-slate-100 text-sm">Profil Kepala Lingkungan</h3>
                </div>
                <div class="p-8 flex flex-col justify-center items-center text-center">
                    @if($kepalaLingkungan && $kepalaLingkungan->foto)
                        <img src="{{ asset('storage/' . $kepalaLingkungan->foto) }}" alt="Foto Kepala Lingkungan" class="w-40 h-40 object-cover rounded-full shadow-md border-4 border-white dark:border-slate-800 mb-6">
                    @else
                        <div class="w-40 h-40 bg-slate-100 dark:bg-slate-800 rounded-full mb-6 flex items-center justify-center text-5xl text-slate-300 dark:text-slate-600 shadow-inner">
                            <i class="fa-solid fa-user-circle"></i>
                        </div>
                    @endif
                    <h5 class="text-lg font-bold text-slate-900 dark:text-slate-100 mb-1">{{ $lingkungan->ketua_lingkungan ?? '-' }}</h5>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-800 px-3 py-1 rounded-full">Kepala Lingkungan</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection