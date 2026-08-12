@extends('layouts.admin')

@section('title', 'Detail Permohonan Surat')

@section('content')

<div class="w-full">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Detail Permohonan</h2>
            <p class="text-sm text-slate-500 mt-1">Informasi detail mengenai permohonan surat atas nama <span class="font-semibold text-slate-700">{{ optional($permohonanSurat->penduduk)->nama_lengkap ?? data_get($permohonanSurat->data_surat, 'nama_lengkap', '-') }}</span></p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.permohonan-surat.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none">
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