@extends('layouts.admin')

@section('title', 'Laporan Penduduk')

@section('content')

<div class="container-fluid">

    {{-- ==========================================================
        HEADER
    =========================================================== --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            
            <p class="text-muted mb-0">
                Statistik dan rekapitulasi data penduduk Kelurahan Bongki.
            </p>

        </div>

        <div>
    <a href="{{ url()->previous() }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>
        
    <a
                href="{{ route('admin.laporan.print-penduduk', request()->query()) }}"
                target="_blank"
                class="btn btn-danger">

                <i class="fa-solid fa-print me-1"></i>

                Cetak

 <a
                href="{{ route('admin.laporan.export-penduduk') }}"
                class="btn btn-success">

                <i class="fa-solid fa-file-excel me-1"></i>

                Export Excel

            </a>

        </div>

    </div>



    {{-- ==========================================================
        STATISTIK
    =========================================================== --}}

    <div class="row g-4 mb-3">

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <small class="text-muted">
                        Total Penduduk
                    </small>

                    <h2 class="fw-bold mt-2">
                        {{ number_format($statistik['total']) }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <small class="text-muted">
                        Laki-laki
                    </small>

                    <h2 class="fw-bold text-primary mt-2">
                        {{ number_format($statistik['laki']) }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <small class="text-muted">
                        Perempuan
                    </small>

                    <h2 class="fw-bold text-danger mt-2">
                        {{ number_format($statistik['perempuan']) }}
                    </h2>

                </div>

            </div>

        </div>

    </div>



{{-- ==========================================================
    FILTER DATA
========================================================== --}}

<div class="card border-0 shadow-sm mb-3">

    <div class="card-header bg-white">

        <h5 class="fw-bold mb-0">

            Filter Data Penduduk

        </h5>

    </div>

    <div class="card-body">

        <form method="GET"
              action="{{ route('admin.laporan.penduduk') }}">

            <div class="row g-3">

                {{-- Nama / NIK --}}
                <div class="col-lg-4">

                    <label class="form-label">

                        Nama / NIK

                    </label>

                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Cari Nama atau NIK"
                        value="{{ request('keyword') }}">

                </div>



                {{-- Lingkungan --}}
                <div class="col-lg-3">

                    <label class="form-label">

                        Lingkungan

                    </label>

                    <select
                        name="lingkungan"
                        class="form-select">

                        <option value="">

                            Semua Lingkungan

                        </option>

                        @foreach($lingkungans as $lingkungan)

                            <option
                                value="{{ $lingkungan->id }}"
                                @selected(request('lingkungan') == $lingkungan->id)>

                                {{ $lingkungan->nama }}

                            </option>

                        @endforeach

                    </select>

                </div>



                {{-- Jenis Kelamin --}}
                <div class="col-lg-2">

                    <label class="form-label">

                        JK

                    </label>

                    <select
                        name="jk"
                        class="form-select">

                        <option value="">

                            Semua

                        </option>

                        <option
                            value="L"
                            @selected(request('jk')=='L')>

                            Laki-laki

                        </option>

                        <option
                            value="P"
                            @selected(request('jk')=='P')>

                            Perempuan

                        </option>

                    </select>

                </div>



                {{-- Agama --}}
                <div class="col-lg-3">

                    <label class="form-label">

                        Agama

                    </label>

                    <select
                        name="agama"
                        class="form-select">

                        <option value="">

                            Semua Agama

                        </option>

                        @foreach($agamaList as $agama)

                            <option
                                value="{{ $agama }}"
                                @selected(request('agama') == $agama)>

                                {{ $agama }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>



            <div class="mt-4 d-flex gap-2">

                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="fa-solid fa-magnifying-glass"></i>

                    Tampilkan

                </button>



                <a href="{{ route('admin.laporan.penduduk') }}"
                   class="btn btn-outline-secondary">

                    <i class="fa-solid fa-rotate-right"></i>

                    Reset

                </a>

            </div>

        </form>

    </div>

</div> 

    {{-- ==========================================================
        REKAP LINGKUNGAN
    =========================================================== --}}

    <div class="card border-0 shadow-sm mb-3">

        <div class="card-header bg-white">

            <h5 class="mb-0 fw-bold">

                Rekap Penduduk per Lingkungan

            </h5>

        </div>

        <div class="card-body">

            <div class="row g-3">

                @foreach($rekapLingkungan as $item)

                    <div class="col-lg-3 col-md-6">

                        <div class="border rounded-3 p-3 h-100">

                            <div class="small text-muted mb-1">

                                {{ $item->nama }}

                            </div>

                            <div class="fs-3 fw-bold text-primary">

                                {{ number_format($item->penduduk_count) }}

                            </div>

                            <small class="text-muted">

                                Penduduk

                            </small>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

{{-- ==========================================================
    ANALISIS DATA
========================================================== --}}

<div class="row g-4 mb-3">

    {{-- Agama --}}
    <div class="col-lg-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white">

                <h6 class="fw-bold mb-0">
                    Berdasarkan Agama
                </h6>

            </div>

            <div class="card-body">

                @forelse($rekapAgama as $item)

                    <div class="d-flex justify-content-between mb-2">

                        <span>{{ $item->agama ?: '-' }}</span>

                        <strong>{{ $item->total }}</strong>

                    </div>

                @empty

                    <p class="text-muted mb-0">
                        Tidak ada data.
                    </p>

                @endforelse

            </div>

        </div>

    </div>



    {{-- Pendidikan --}}
    <div class="col-lg-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white">

                <h6 class="fw-bold mb-0">
                    Berdasarkan Pendidikan
                </h6>

            </div>

            <div class="card-body">

                @forelse($rekapPendidikan as $item)

                    <div class="d-flex justify-content-between mb-2">

                        <span>{{ $item->pendidikan ?: '-' }}</span>

                        <strong>{{ $item->total }}</strong>

                    </div>

                @empty

                    <p class="text-muted mb-0">
                        Tidak ada data.
                    </p>

                @endforelse

            </div>

        </div>

    </div>



    {{-- Pekerjaan --}}
    <div class="col-lg-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white">

                <h6 class="fw-bold mb-0">
                    Berdasarkan Pekerjaan
                </h6>

            </div>

            <div class="card-body">

                @forelse($rekapPekerjaan as $item)

                    <div class="d-flex justify-content-between mb-2">

                        <span>{{ $item->pekerjaan ?: '-' }}</span>

                        <strong>{{ $item->total }}</strong>

                    </div>

                @empty

                    <p class="text-muted mb-0">
                        Tidak ada data.
                    </p>

                @endforelse

            </div>

        </div>

    </div>

</div>

    {{-- ==========================================================
        TABEL DATA PENDUDUK
    =========================================================== --}}

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <h5 class="mb-0 fw-bold">

                Data Penduduk

            </h5>

            <span class="badge bg-primary">

                {{ $penduduks->total() }} Data

            </span>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                NIK
                            </th>

                            <th>
                                Nama Lengkap
                            </th>

                            <th>
                                JK
                            </th>

                            <th>
                                KK
                            </th>

                            <th>
                                Lingkungan
                            </th>

                            <th>
                                Alamat
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($penduduks as $penduduk)

                            <tr>

                                <td>

                                    {{ $loop->iteration + (($penduduks->currentPage()-1) * $penduduks->perPage()) }}

                                </td>

                                <td>

                                    {{ $penduduk->nik }}

                                </td>

                                <td>

                                    <strong>

                                        {{ $penduduk->nama_lengkap }}

                                    </strong>

                                </td>

                                <td>

                                    @if($penduduk->jenis_kelamin == 'L')

                                        <span class="badge bg-primary">

                                            L

                                        </span>

                                    @else

                                        <span class="badge bg-danger">

                                            P

                                        </span>

                                    @endif

                                </td>

                                <td>

                                    {{ optional($penduduk->kartuKeluarga)->nomor_kk ?? '-' }}

                                </td>

                                <td>

                                    {{ optional($penduduk->lingkungan)->nama ?? '-' }}

                                </td>

                                <td>

                                    {{ $penduduk->alamat }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center py-5 text-muted">

                                    Belum ada data penduduk.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="card-footer bg-white">

            {{ $penduduks->withQueryString()->links() }}

        </div>

    </div>

</div>

@endsection
