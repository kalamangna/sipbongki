@extends('layouts.operator')

@section('title','Laporan Kartu Keluarga')

@section('content')

<div class="container-fluid">

    {{-- ==========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">

                <i class="bi bi-people-fill text-primary me-2"></i>

                Laporan Kartu Keluarga

            </h3>

            <p class="text-muted mb-0">
                Rekapitulasi data Kartu Keluarga Kelurahan Bongki.
            </p>

        </div>

        <div class="d-flex gap-2 mt-3 mt-lg-0">

            <a
                href="{{ route('operator.laporan.export-kartu-keluarga') }}"
                class="btn btn-success">

                <i class="bi bi-file-earmark-excel me-1"></i>

                Export Excel

            </a>

            <a
                href="{{ route('operator.laporan.print-kartu-keluarga', request()->query()) }}"
                target="_blank"
                class="btn btn-danger">

                <i class="bi bi-printer me-1"></i>

                Cetak

            </a>

            <a href="{{ route('operator.laporan.kartu-keluarga') }}"
   class="btn btn-light border shadow-sm">

    <i class="bi bi-arrow-clockwise me-1"></i>

    Refresh

</a>

        </div>

    </div>



    {{-- ==========================================================
        STATISTIK
    ========================================================== --}}

    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <div class="text-muted small mb-1">

                                Total Kartu Keluarga

                            </div>

                            <h3 class="fw-bold mb-0">

                                {{ number_format($statistik['total_kk']) }}

                            </h3>

                        </div>

                        <div
                            class="rounded-circle bg-primary bg-opacity-10
                                   d-flex align-items-center justify-content-center"
                            style="width:60px;height:60px;">

                            <i class="bi bi-people-fill fs-3 text-primary"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <div class="text-muted small mb-1">

                                Total Anggota

                            </div>

                            <h3 class="fw-bold mb-0">

                                {{ number_format($statistik['total_anggota']) }}

                            </h3>

                        </div>

                        <div
                            class="rounded-circle bg-success bg-opacity-10
                                   d-flex align-items-center justify-content-center"
                            style="width:60px;height:60px;">

                            <i class="bi bi-person-vcard fs-3 text-success"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <div class="text-muted small mb-1">

                                KK Aktif

                            </div>

                            <h3 class="fw-bold mb-0">

                                {{ number_format($statistik['kk_aktif']) }}

                            </h3>

                        </div>

                        <div
                            class="rounded-circle bg-warning bg-opacity-10
                                   d-flex align-items-center justify-content-center"
                            style="width:60px;height:60px;">

                            <i class="bi bi-patch-check-fill fs-3 text-warning"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <div class="text-muted small mb-1">

                                Rata-rata Anggota / KK

                            </div>

                            <h3 class="fw-bold mb-0">

                                {{ $statistik['rata_anggota'] }}

                            </h3>

                        </div>

                        <div
                            class="rounded-circle bg-info bg-opacity-10
                                   d-flex align-items-center justify-content-center"
                            style="width:60px;height:60px;">

                            <i class="bi bi-bar-chart-fill fs-3 text-info"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- ==========================================================
        FILTER
    ========================================================== --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white">

            <h6 class="fw-bold mb-0">

                <i class="bi bi-funnel me-2"></i>

                Filter Laporan

            </h6>

        </div>

        <div class="card-body">

            <form method="GET"
                  action="{{ route('operator.laporan.kartu-keluarga') }}">

                <div class="row g-3">

                    <div class="col-lg-4">

                        <label class="form-label">

                            Nomor KK / Kepala Keluarga

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="keyword"
                            value="{{ request('keyword') }}"
                            placeholder="Cari Nomor KK atau Kepala Keluarga">

                    </div>

                    <div class="col-lg-3">

                        <label class="form-label">

                            Lingkungan

                        </label>

                        <select
                            class="form-select"
                            name="lingkungan">

                            <option value="">
                                Semua Lingkungan
                            </option>

                            @foreach($lingkungans as $lingkungan)

                                <option
                                    value="{{ $lingkungan->id }}"
                                    @selected(request('lingkungan')==$lingkungan->id)>

                                    {{ $lingkungan->nama }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-lg-1">

                        <label class="form-label">
                            RT
                        </label>

                        <input
                            type="text"
                            name="rt"
                            value="{{ request('rt') }}"
                            class="form-control">

                    </div>

                    <div class="col-lg-1">

                        <label class="form-label">
                            RW
                        </label>

                        <input
                            type="text"
                            name="rw"
                            value="{{ request('rw') }}"
                            class="form-control">

                    </div>

                    <div class="col-lg-2">

                        <label class="form-label">

                            Status

                        </label>

                        <select
                            class="form-select"
                            name="status">

                            <option value="">
                                Semua
                            </option>

                            <option
                                value="1"
                                @selected(request('status')==='1')>

                                Aktif

                            </option>

                            <option
                                value="0"
                                @selected(request('status')==='0')>

                                Tidak Aktif

                            </option>

                        </select>

                    </div>

                    <div class="col-lg-1 d-grid">

                        <label class="form-label">&nbsp;</label>

                        <button
                            class="btn btn-primary">

                            <i class="bi bi-search"></i>

                        </button>

                    </div>

                </div>

                <div class="mt-3">

                    <a
                        href="{{ route('operator.laporan.kartu-keluarga') }}"
                        class="btn btn-outline-secondary">

                        Reset Filter

                    </a>

                </div>

            </form>

        </div>

    </div>
    {{-- ==========================================================
        REKAP PER LINGKUNGAN
    ========================================================== --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white">

            <h6 class="fw-bold mb-0">

                <i class="bi bi-bar-chart-line me-2"></i>

                Rekap Kartu Keluarga Per Lingkungan

            </h6>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th width="60">No</th>

                            <th>Lingkungan</th>

                            <th class="text-center">Jumlah KK</th>

                            <th class="text-center">Jumlah Penduduk</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($rekapLingkungan as $item)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>

                                    <strong>

                                        {{ $item->nama }}

                                    </strong>

                                </td>

                                <td class="text-center">

                                    <span class="badge bg-primary">

                                        {{ number_format($item->kartu_keluargas_count) }} KK

                                    </span>

                                </td>

                                <td class="text-center">

                                    <span class="badge bg-success">

                                        {{ number_format($item->penduduk_count) }} Jiwa

                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4"
                                    class="text-center text-muted py-4">

                                    Belum ada data.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>



    {{-- ==========================================================
        TABEL LAPORAN
    ========================================================== --}}

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <h6 class="fw-bold mb-0">

                <i class="bi bi-table me-2"></i>

                Data Kartu Keluarga

            </h6>

            <span class="badge bg-primary">

                {{ $kartuKeluargas->total() }} Data

            </span>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th width="60">No</th>

                        <th>No. KK</th>

                        <th>Kepala Keluarga</th>

                        <th class="text-center">Anggota</th>

                        <th>Lingkungan</th>

                        <th class="text-center">RT/RW</th>

                        <th class="text-center">Status</th>

                        <th width="150" class="text-center">

                            Aksi

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($kartuKeluargas as $kk)

                        <tr>

                            <td>

                                {{ $kartuKeluargas->firstItem() + $loop->index }}

                            </td>

                            <td>

                                <strong>

                                    {{ $kk->no_kk }}

                                </strong>

                            </td>

                            <td>

                                {{ optional($kk->kepalaKeluarga)->nama_lengkap ?? '-' }}

                            </td>

                            <td class="text-center">

                                <span class="badge bg-info">

                                    {{ $kk->anggota_count }} Orang

                                </span>

                            </td>

                            <td>

                                {{ optional($kk->lingkungan)->nama ?? '-' }}

                            </td>

                            <td class="text-center">

                                {{ $kk->rt }}

                                /

                                {{ $kk->rw }}

                            </td>

                            <td class="text-center">

                                @if($kk->aktif)

                                    <span class="badge bg-success">

                                        Aktif

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        Tidak Aktif

                                    </span>

                                @endif

                            </td>

                            <td>

                                <div class="d-flex justify-content-center gap-1">

                                    <a
                                        href="{{ route('operator.kartu-keluarga.show',$kk->id) }}"
                                        class="btn btn-sm btn-outline-primary">

                                        <i class="bi bi-eye"></i>

                                    </a>

                                    <a
                                        href="{{ route('operator.kartu-keluarga.edit',$kk->id) }}"
                                        class="btn btn-sm btn-outline-warning">

                                        <i class="bi bi-pencil"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8" class="text-center py-5">

                                <div class="text-muted">

                                    <i class="bi bi-inbox fs-1 d-block mb-3"></i>

                                    <h6>

                                        Tidak ada data Kartu Keluarga.

                                    </h6>

                                    <p class="mb-0">

                                        Silakan ubah filter atau tambahkan data terlebih dahulu.

                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        @if($kartuKeluargas->hasPages())

            <div class="card-footer bg-white">

                {{ $kartuKeluargas->links() }}

            </div>

        @endif

    </div>

</div>

@endsection