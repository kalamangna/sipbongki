@extends('layouts.admin')

@section('title', 'Detail Permohonan Surat')

@section('content')

<div class="w-full">

 {{-- Breadcrumb --}}
 @include('admin.pelayanan.permohonan-surat.partials.breadcrumb')

 <div class="mb-4 flex justify-end">
 <a
 href="{{ route('admin.permohonan-surat.index') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600 !px-3 !py-1.5 !text-xs">

 <i class="fa-solid fa-arrow-left"></i>
 Kembali

 </a>
 </div>

 
 {{-- Header removed: consolidated into single-card --}}

 <div class="flex flex-wrap -mx-3">

 {{-- =========================
 KONTEN UTAMA
 ========================== --}}
 <div class="col-xl-8">

 <div class="flex flex-wrap -mx-3">

 {{-- Gabungkan semua informasi utama dalam satu card --}}
 <div class="w-full px-3">
 @include('admin.pelayanan.permohonan-surat.partials.single-card')
 </div>

 </div>

 </div>

 {{-- =========================
 SIDEBAR
 ========================== --}}
 <div class="w-full xl:w-1/3 px-3">

 <div class="sticky-top" style="top:90px;">

 @include('admin.pelayanan.permohonan-surat.partials.action-card')

 @include('admin.pelayanan.permohonan-surat.partials.notes-card')

 @include('admin.pelayanan.permohonan-surat.partials.timeline-card')

 </div>

 </div>

 </div>

</div>

@endsection