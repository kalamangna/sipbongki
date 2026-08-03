@extends('layouts.admin')

@section('title','Laporan Persuratan')

@section('content')

<div class="container-fluid">

    {{-- ==========================================================
        HEADER
    ========================================================== --}}

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">

                <i class="fa-solid fa-envelope-open-text text-primary me-2"></i>

                Laporan Persuratan

            </h3>

            <p class="text-muted mb-0">

                Rekapitulasi seluruh pelayanan persuratan Kelurahan Bongki.

            </p>

        </div>

        <div class="d-flex gap-2 mt-3 mt-lg-0">
        
         <a href="{{ url()->previous() }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <a
                href="{{ route('admin.laporan.print-persuratan', request()->query()) }}"
                target="_blank"
                class="btn btn-danger">

                <i class="fa-solid fa-print me-1"></i>

                Cetak

            </a>

            <a
                href="{{ route('admin.laporan.export-persuratan') }}"
                class="btn btn-success">

                <i class="fa-solid fa-file-excel me-1"></i>

                Export Excel

            </a>

                      
        </div>

    </div>
        {{-- ==========================================================
        STATISTIK
    ========================================================== --}}

    <div class="row g-4 mb-3">

        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="action-buttons">

                        <div>

                            <div class="text-muted small mb-1">

                                Total Permohonan

                            </div>

                            <h3 class="fw-bold mb-0">

                                {{ number_format($statistik['total']) }}

                            </h3>

                        </div>

                        <div class="rounded-circle bg-primary bg-opacity-10
                                    d-flex align-items-center justify-content-center"
                             style="width:60px;height:60px;">

                            <i class="fa-solid fa-envelope-open-text fs-3 text-primary"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="action-buttons">

                        <div>

                            <div class="text-muted small mb-0">

                                Menunggu

                            </div>

                            <h3 class="fw-bold text-warning mb-0">

                                {{ number_format($statistik['menunggu']) }}

                            </h3>

                        </div>

                        <div class="rounded-circle bg-warning bg-opacity-10
                                    d-flex align-items-center justify-content-center"
                             style="width:60px;height:60px;">

                            <i class="fa-solid fa-hourglass-half fs-3 text-warning"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="action-buttons">

                        <div>

                            <div class="text-muted small mb-1">

                                Diproses

                            </div>

                            <h3 class="fw-bold text-info mb-0">

                                {{ number_format($statistik['diproses']) }}

                            </h3>

                        </div>

                        <div class="rounded-circle bg-info bg-opacity-10
                                    d-flex align-items-center justify-content-center"
                             style="width:60px;height:60px;">

                            <i class="fa-solid fa-gear fs-3 text-info"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="action-buttons">

                        <div>

                            <div class="text-muted small mb-1">

                                Selesai

                            </div>

                            <h3 class="fw-bold text-success mb-0">

                                {{ number_format($statistik['selesai']) }}

                            </h3>

                        </div>

                        <div class="rounded-circle bg-success bg-opacity-10
                                    d-flex align-items-center justify-content-center"
                             style="width:60px;height:60px;">

                            <i class="fa-solid fa-circle-check fs-3 text-success"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- Ringkasan Status --}}

    <div class="alert alert-light border shadow-sm mb-4">

        <div class="row text-center">

            <div class="col-md-3">

                <strong class="text-warning">

                    {{ $statistik['menunggu'] }}

                </strong>

                <div class="small text-muted">

                    Menunggu

                </div>

            </div>

            <div class="col-md-3">

                <strong class="text-info">

                    {{ $statistik['diproses'] }}

                </strong>

                <div class="small text-muted">

                    Diproses

                </div>

            </div>

            <div class="col-md-3">

                <strong class="text-success">

                    {{ $statistik['selesai'] }}

                </strong>

                <div class="small text-muted">

                    Selesai

                </div>

            </div>

            <div class="col-md-3">

                <strong class="text-danger">

                    {{ $statistik['ditolak'] }}

                </strong>

                <div class="small text-muted">

                    Ditolak

                </div>

            </div>

        </div>

    </div>
        {{-- ==========================================================
        FILTER
    ========================================================== --}}

    <div class="card border-0 shadow-sm mb-3">

        <div class="card-header bg-white">

            <h6 class="fw-bold mb-0">

                <i class="fa-solid fa-filter me-2"></i>

                Filter Laporan Persuratan

            </h6>

        </div>

        <div class="card-body">

            <form
                method="GET"
                action="{{ route('admin.laporan.persuratan') }}">

                <div class="row g-3">

                    {{-- Keyword --}}
                    <div class="col-lg-3">

                        <label class="form-label">

                            Nomor / Nama / NIK

                        </label>

                        <input
                            type="text"
                            name="keyword"
                            class="form-control"
                            value="{{ request('keyword') }}"
                            placeholder="Nomor surat, nama atau NIK">

                    </div>



                    {{-- Jenis Surat --}}
                    <div class="col-lg-3">

                        <label class="form-label">

                            Jenis Surat

                        </label>

                        <select
                            name="jenis_surat"
                            class="form-select">

                            <option value="">

                                Semua Jenis Surat

                            </option>

                            @foreach($jenisSurats as $jenis)

                                <option
                                    value="{{ $jenis->id }}"
                                    @selected(request('jenis_surat') == $jenis->id)>

                                    {{ $jenis->nama }}

                                </option>

                            @endforeach

                        </select>

                    </div>



                    {{-- Status --}}
                    <div class="col-lg-2">

                        <label class="form-label">

                            Status

                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option value="">

                                Semua

                            </option>

                            <option value="Menunggu"
                                @selected(request('status')=='Menunggu')>

                                Menunggu

                            </option>

                            <option value="Diproses"
                                @selected(request('status')=='Diproses')>

                                Diproses

                            </option>

                            <option value="Selesai"
                                @selected(request('status')=='Selesai')>

                                Selesai

                            </option>

                            <option value="Ditolak"
                                @selected(request('status')=='Ditolak')>

                                Ditolak

                            </option>

                        </select>

                    </div>



                    {{-- Tanggal Awal --}}
                    <div class="col-lg-2">

                        <label class="form-label">

                            Dari

                        </label>

                        <input
                            type="date"
                            name="tanggal_awal"
                            class="form-control"
                            value="{{ request('tanggal_awal') }}">

                    </div>



                    {{-- Tanggal Akhir --}}
                    <div class="col-lg-2">

                        <label class="form-label">

                            Sampai

                        </label>

                        <input
                            type="date"
                            name="tanggal_akhir"
                            class="form-control"
                            value="{{ request('tanggal_akhir') }}">

                    </div>

                </div>



                <div class="mt-4 d-flex gap-2">

                    <button
                        class="btn btn-primary">

                        <i class="fa-solid fa-magnifying-glass"></i>

                        Tampilkan

                    </button>

                    <a
                        href="{{ route('admin.laporan.persuratan') }}"
                        class="btn btn-outline-secondary">

                        <i class="fa-solid fa-rotate-right"></i>

                        Reset

                    </a>

                </div>

            </form>

        </div>

    </div>
        {{-- ==========================================================
        REKAP JENIS SURAT
    ========================================================== --}}

    <div class="card border-0 shadow-sm mb-3">

        <div class="card-header bg-white">

            <h6 class="fw-bold mb-0">

                <i class="fa-solid fa-chart-line me-1"></i>

                Rekap Permohonan Berdasarkan Jenis Surat

            </h6>

        </div>

        <div class="card-body">

            <div class="row g-1">

                @forelse($rekapJenis as $item)

                    <div class="col-xl-3 col-lg-4 col-md-0">

                        <div class="border rounded-0 p-1 h-100">

                            <div class="small text-muted mb-0">

                                {{ $item->nama }}

                            </div>

                            <div class="fs-3 fw-bold text-primary">

                                {{ number_format($item->permohonan_surats_count) }}

                            </div>

                            <small class="text-muted">

                                Permohonan

                            </small>

                        </div>

                    </div>

                @empty

                    <div class="col-10">

                        <div class="alert alert-light mb-0">

                            Belum ada data jenis surat.

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </div>
        {{-- ==========================================================
        TABEL LAPORAN PERSURATAN
    ========================================================== --}}

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <h6 class="fw-bold mb-0">

                <i class="fa-solid fa-table me-0"></i>

                Data Permohonan Surat

            </h6>

            <span class="badge bg-primary">

                {{ $permohonans->total() }} Data

            </span>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th width="40">No</th>

                        <th>No. Permohonan</th>

                        <th>No. Surat</th>

                        <th>Pemohon</th>

                        <th>Jenis Surat</th>

                        <th>Tanggal</th>

                        <th>Penandatangan</th>

                        <th class="text-center">Status</th>

                        <th width="100" class="text-center">

                            Aksi

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($permohonans as $item)

                        <tr>

                            <td>

                                {{ $permohonans->firstItem() + $loop->index }}

                            </td>

                            <td>

                                <strong>

                                    {{ $item->nomor_permohonan }}

                                </strong>

                            </td>

                            <td>

                                {{ $item->nomor_surat ?: '-' }}

                            </td>

                            <td>

                                <strong>

                                    {{ optional($item->penduduk)->nama_lengkap }}

                                </strong>

                                <br>

                                <small class="text-muted">

                                    {{ optional($item->penduduk)->nik }}

                                </small>

                            </td>

                            <td>

                                {{ optional($item->jenisSurat)->nama }}

                            </td>

                            <td>

                                {{ optional($item->tanggal_permohonan)->format('d-m-Y') }}

                            </td>

                            <td>

                                {{ optional($item->penandatangan)->nama_lengkap }}

                                <br>

                                <small class="text-muted">

                                    {{ optional(optional($item->penandatangan)->jabatan)->nama }}

                                </small>

                            </td>

                            <td class="text-center">

                                @switch($item->status)

                                    @case('Menunggu')

                                        <span class="badge bg-warning">

                                            Menunggu

                                        </span>

                                    @break

                                    @case('Diproses')

                                        <span class="badge bg-info">

                                            Diproses

                                        </span>

                                    @break

                                    @case('Selesai')

                                        <span class="badge bg-success">

                                            Selesai

                                        </span>

                                    @break

                                    @default

                                        <span class="badge bg-danger">

                                            Ditolak

                                        </span>

                                @endswitch

                            </td>

                            <td>

                                <div class="action-buttons">

                                    <a
                                        href="{{ route('admin.permohonan-surat.show',$item->id) }}"
                                        class="btn btn-sm btn-outline-primary">

                                        <i class="fa-solid fa-eye"></i>

                                    </a>

                                    <a
                                        href="{{ route('admin.permohonan-surat.preview',$item->id) }}"
                                        target="_blank"
                                        class="btn btn-sm btn-outline-success">

                                        <i class="fa-solid fa-file-lines"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9" class="text-center py-5">

                                <div class="text-muted">

                                    <i class="fa-solid fa-inbox fs-1 d-block mb-3"></i>

                                    <h6>

                                        Belum ada data permohonan surat.

                                    </h6>

                                    <p class="mb-0">

                                        Data akan muncul setelah pelayanan persuratan dibuat.

                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        @if($permohonans->hasPages())

            <div class="card-footer bg-white">

                {{ $permohonans->links() }}

            </div>

        @endif

    </div>

</div>

@endsection