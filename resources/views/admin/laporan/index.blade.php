@extends('layouts.admin')

@section('title', 'Laporan')

@section('content')

{{-- HEADER --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mb-1">Laporan</h3>
        <p class="text-sm text-slate-500 dark:text-slate-400">Ringkasan data dan akses cepat ke seluruh laporan</p>
    </div>
</div>

{{-- STATISTIK --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
    <div class="bg-white rounded-2xl p-5 ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] hover:shadow-md transition-shadow dark:bg-slate-900 dark:ring-slate-800">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-primary-50 text-primary-600 dark:bg-primary-950/50 dark:text-primary-400 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-0.5">Penduduk</p>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-slate-100 tracking-tight">{{ number_format($statistik['penduduk']) }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-5 ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] hover:shadow-md transition-shadow dark:bg-slate-900 dark:ring-slate-800">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-950/50 dark:text-emerald-400 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-house-user"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-0.5">Kartu Keluarga</p>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-slate-100 tracking-tight">{{ number_format($statistik['kk']) }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-5 ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] hover:shadow-md transition-shadow dark:bg-slate-900 dark:ring-slate-800">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-950/50 dark:text-amber-400 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-0.5">Permohonan Surat</p>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-slate-100 tracking-tight">{{ number_format($statistik['permohonan']) }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-5 ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] hover:shadow-md transition-shadow dark:bg-slate-900 dark:ring-slate-800">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-600 dark:bg-sky-950/50 dark:text-sky-400 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-folder-open"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-0.5">Jenis Surat</p>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-slate-100 tracking-tight">{{ number_format($statistik['jenis_surat']) }}</p>
            </div>
        </div>
    </div>
</div>

{{-- MENU LAPORAN --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Kependudukan --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col dark:bg-slate-900 dark:border-slate-800">
        <div class="p-6 flex-1">
            <div class="w-11 h-11 rounded-xl bg-primary-50 text-primary-600 dark:bg-primary-950/50 dark:text-primary-400 flex items-center justify-center text-lg mb-4">
                <i class="fa-solid fa-users"></i>
            </div>
            <h5 class="font-bold text-slate-800 dark:text-slate-100 mb-1">Laporan Kependudukan</h5>
            <p class="text-sm text-slate-500 dark:text-slate-400">Rekapitulasi data penduduk berdasarkan berbagai kategori demografis.</p>
        </div>
        <div class="px-6 pb-6 flex flex-wrap gap-2">
            <a href="{{ route('admin.laporan.penduduk') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all active:scale-95">
                <i class="fa-solid fa-chart-bar"></i> Buka Laporan
            </a>
            <a href="{{ route('admin.laporan.export-penduduk') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 shadow-sm transition-all active:scale-95 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700">
                <i class="fa-solid fa-file-excel text-emerald-600"></i> Export Excel
            </a>
            <a href="{{ route('admin.laporan.statistik') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 shadow-sm transition-all active:scale-95 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700">
                <i class="fa-solid fa-chart-pie text-sky-600"></i> Statistik
            </a>
        </div>
    </div>

    {{-- Kartu Keluarga --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col dark:bg-slate-900 dark:border-slate-800">
        <div class="p-6 flex-1">
            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-950/50 dark:text-emerald-400 flex items-center justify-center text-lg mb-4">
                <i class="fa-solid fa-house-user"></i>
            </div>
            <h5 class="font-bold text-slate-800 dark:text-slate-100 mb-1">Laporan Kartu Keluarga</h5>
            <p class="text-sm text-slate-500 dark:text-slate-400">Rekapitulasi data kartu keluarga dan anggota keluarga per lingkungan.</p>
        </div>
        <div class="px-6 pb-6 flex flex-wrap gap-2">
            <a href="{{ route('admin.laporan.kartu-keluarga') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm transition-all active:scale-95">
                <i class="fa-solid fa-chart-bar"></i> Buka Laporan
            </a>
            <a href="{{ route('admin.laporan.export-kartu-keluarga') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 shadow-sm transition-all active:scale-95 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700">
                <i class="fa-solid fa-file-excel text-emerald-600"></i> Export Excel
            </a>
        </div>
    </div>

    {{-- Persuratan --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col dark:bg-slate-900 dark:border-slate-800">
        <div class="p-6 flex-1">
            <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-950/50 dark:text-amber-400 flex items-center justify-center text-lg mb-4">
                <i class="fa-solid fa-file-signature"></i>
            </div>
            <h5 class="font-bold text-slate-800 dark:text-slate-100 mb-1">Laporan Persuratan</h5>
            <p class="text-sm text-slate-500 dark:text-slate-400">Rekapitulasi layanan permohonan surat dan statusnya per periode.</p>
        </div>
        <div class="px-6 pb-6 flex flex-wrap gap-2">
            <a href="{{ route('admin.laporan.persuratan') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-amber-500 text-white hover:bg-amber-600 shadow-sm transition-all active:scale-95">
                <i class="fa-solid fa-chart-bar"></i> Buka Laporan
            </a>
            <a href="{{ route('admin.laporan.export-persuratan') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 shadow-sm transition-all active:scale-95 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700">
                <i class="fa-solid fa-file-excel text-emerald-600"></i> Export Excel
            </a>
        </div>
    </div>

</div>

@endsection