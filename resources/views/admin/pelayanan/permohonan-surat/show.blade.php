@extends('layouts.admin')

@section('title', 'Detail Permohonan Surat')

@section('content')

<div class="container-fluid">

    {{-- Breadcrumb --}}
    @include('admin.pelayanan.permohonan-surat.partials.breadcrumb')

  
    {{-- Header --}}
    @include('admin.pelayanan.permohonan-surat.partials.header')

    <div class="row g-4">

        {{-- =========================
            KONTEN UTAMA
        ========================== --}}
        <div class="col-xl-8">

            <div class="row g-4">

                {{-- Data Pemohon --}}
                <div class="col-12">
                    @include('admin.pelayanan.permohonan-surat.partials.applicant-card')
                </div>

                {{-- Informasi Surat --}}
                <div class="col-12">
                    @include('admin.pelayanan.permohonan-surat.partials.request-card')
                </div>

                {{-- Keperluan --}}
                <div class="col-12">
                    @include('admin.pelayanan.permohonan-surat.partials.purpose-card')
                </div>

                {{-- Catatan --}}
                <div class="col-12">
                    @include('admin.pelayanan.permohonan-surat.partials.notes-card')
                </div>

            </div>

        </div>

        {{-- =========================
            SIDEBAR
        ========================== --}}
        <div class="col-xl-4">

            <div class="sticky-top" style="top:90px;">

                @include('admin.pelayanan.permohonan-surat.partials.status-card')

                @include('admin.pelayanan.permohonan-surat.partials.action-card')

                @include('admin.pelayanan.permohonan-surat.partials.timeline-card')

                @include('admin.pelayanan.permohonan-surat.partials.system-card')

            </div>

        </div>

    </div>

    {{-- Footer --}}
    @include('admin.pelayanan.permohonan-surat.partials.footer')

</div>

@endsection