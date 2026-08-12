@extends('layouts.admin')

@section('title', 'Detail Permohonan Surat')

@section('content')

<div class="w-full">

 {{-- Breadcrumb --}}
 @include('admin.pelayanan.permohonan-surat.partials.breadcrumb')

 <div class="mb-4 flex justify-end">
 <a href="{{ route('admin.permohonan-surat.index') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600 !px-3 !py-1.5 !text-xs focus:outline-none active:scale-95 cursor-pointer">
 <i class="fa-solid fa-arrow-left"></i>
 Kembali

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