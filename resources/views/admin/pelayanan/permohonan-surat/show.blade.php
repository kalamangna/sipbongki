@extends('layouts.admin')

@section('title', 'Detail Permohonan Surat')

@section('content')

<div class="w-full">

 {{-- Breadcrumb --}}
 @include('admin.pelayanan.permohonan-surat.partials.breadcrumb')

 <div class="mb-4 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Detail Permohonan</h2>
    <a href="{{ route('admin.permohonan-surat.index') }}"
        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none active:scale-95 cursor-pointer">
        <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
    </a>
 </div>

 
 {{-- Header removed: consolidated into single-card --}}

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- =========================
        KONTEN UTAMA
        ========================== --}}
        <div class="xl:col-span-2 space-y-6">
            @include('admin.pelayanan.permohonan-surat.partials.single-card')
        </div>

        {{-- =========================
        SIDEBAR
        ========================== --}}
        <div class="space-y-6">
            <div class="sticky top-24 space-y-6">
                @include('admin.pelayanan.permohonan-surat.partials.action-card')
                @include('admin.pelayanan.permohonan-surat.partials.notes-card')
                @include('admin.pelayanan.permohonan-surat.partials.timeline-card')
            </div>
        </div>

    </div>

</div>

@endsection