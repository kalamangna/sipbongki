@extends('layouts.admin')

@section('title', 'Detail Persuratan')

@section('content')

<div class="w-full">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight dark:text-slate-100">Detail Persuratan</h2>
            <p class="text-sm text-slate-500 mt-1 dark:text-slate-400">Informasi detail mengenai permohonan surat atas nama <span class="font-semibold text-slate-700 dark:text-slate-200">{{ optional($permohonanSurat->penduduk)->nama_lengkap ?? data_get($permohonanSurat->data_surat, 'nama_lengkap', '-') }}</span></p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.permohonan-surat.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none active:scale-95 cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white">
                <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- =========================
        KONTEN UTAMA
        ========================== --}}
        <div class="lg:col-span-2 space-y-6">
            @include('admin.pelayanan.permohonan-surat.partials.single-card')
        </div>

        {{-- =========================
        SIDEBAR
        ========================== --}}
        <div class="space-y-6">
            @include('admin.pelayanan.permohonan-surat.partials.action-card')
            @include('admin.pelayanan.permohonan-surat.partials.notes-card')
            @include('admin.pelayanan.permohonan-surat.partials.timeline-card')
        </div>

    </div>

</div>

@endsection