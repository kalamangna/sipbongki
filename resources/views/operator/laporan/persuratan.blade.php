@extends('layouts.operator')

@section('title', 'Laporan Persuratan')

@section('content')

<div class="container-fluid">

{{-- ==========================================================
    HEADER
========================================================== --}}

<div class="d-flex justify-content-between align-items-start flex-wrap mb-4">

    <div>

        <h2 class="fw-bold mb-1">

            <i class="bi bi-envelope-paper-fill text-primary me-2"></i>

            Laporan Persuratan

        </h2>

        <p class="text-muted mb-0">

            Rekapitulasi data pelayanan surat Kelurahan Bongki.

        </p>

    </div>


    <div class="d-flex gap-2 mt-3 mt-md-0">

        <a href="{{ route('operator.laporan.export-persuratan') }}"
           class="btn btn-success">

            <i class="bi bi-file-earmark-excel me-1"></i>

            Export Excel

        </a>


        <a href="{{ route('operator.laporan.print-persuratan', request()->query()) }}"
           target="_blank"
           class="btn btn-danger">

            <i class="bi bi-printer me-1"></i>

            Cetak

        </a>


        <a href="{{ route('operator.laporan.persuratan') }}"
           class="btn btn-light border">

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

        <x-ui.stat-card
            title="Total Permohonan"
            :total="$statistik['total']"
            icon="fa-envelope"
            color="primary"
        />

    </div>


    <div class="col-xl-3 col-md-6">

        <x-ui.stat-card
            title="Menunggu"
            :total="$statistik['menunggu']"
            icon="fa-clock"
            color="warning"
        />

    </div>


    <div class="col-xl-3 col-md-6">

        <x-ui.stat-card
            title="Diproses"
            :total="$statistik['diproses']"
            icon="fa-gears"
            color="info"
        />

    </div>


    <div class="col-xl-3 col-md-6">

        <x-ui.stat-card
            title="Selesai"
            :total="$statistik['selesai']"
            icon="fa-circle-check"
            color="success"
        />

    </div>

</div>

   


    {{-- FILTER --}}

    <div class="card shadow-sm mb-4">

        <div class="card-header">
            <strong>
                <i class="bi bi-funnel"></i>
                Filter Laporan
            </strong>
        </div>


        <div class="card-body">


            <form method="GET" action="{{ route('operator.laporan.persuratan') }}">


                <div class="row g-3">


                    <div class="col-md-3">

                        <label class="form-label">
                            Dari Tanggal
                        </label>

                        <input type="date"
                               name="tanggal_mulai"
                               class="form-control"
                               value="{{ request('tanggal_mulai') }}">

                    </div>



                    <div class="col-md-3">

                        <label class="form-label">
                            Sampai Tanggal
                        </label>

                        <input type="date"
                               name="tanggal_selesai"
                               class="form-control"
                               value="{{ request('tanggal_selesai') }}">

                    </div>



                    <div class="col-md-3">

                        <label class="form-label">
                            Jenis Surat
                        </label>


                        <select name="jenis_surat"
                                class="form-select">


                            <option value="">
                                Semua Jenis Surat
                            </option>


                            @foreach($jenisSurats as $item)

<option value="{{ $item->id }}"
    {{ request('jenis_surat')==$item->id ? 'selected':'' }}>

    {{ $item->nama }}

</option>

@endforeach


                        </select>

                    </div>




                    <div class="col-md-3">


                        <label class="form-label">
                            Status
                        </label>


                        <select name="status"
                                class="form-select">


                            <option value="">
                                Semua Status
                            </option>


                            <option value="diajukan"
                            {{ request('status')=='diajukan'?'selected':'' }}>
                                Diajukan
                            </option>


                            <option value="diproses"
                            {{ request('status')=='diproses'?'selected':'' }}>
                                Diproses
                            </option>


                            <option value="selesai"
                            {{ request('status')=='selesai'?'selected':'' }}>
                                Selesai
                            </option>


                            <option value="ditolak"
                            {{ request('status')=='ditolak'?'selected':'' }}>
                                Ditolak
                            </option>


                        </select>


                    </div>


                </div>


                <div class="mt-3">


                    <button class="btn btn-primary">

                        <i class="bi bi-search"></i>
                        Tampilkan

                    </button>


                    <a href="{{ route('operator.laporan.persuratan') }}"
                       class="btn btn-secondary">

                        <i class="bi bi-arrow-repeat"></i>
                        Reset

                    </a>


                </div>


            </form>


        </div>


    </div>





    {{-- DATA --}}

    <div class="card shadow-sm">


        <div class="card-header d-flex justify-content-between">


            <strong>
                Data Pelayanan Surat
            </strong>


            <span class="badge bg-primary">

                Total :
                {{ $permohonans->total() }}

            </span>


        </div>



        <div class="card-body p-0">


            <div class="table-responsive">


                <table class="table table-hover mb-0">


                    <thead class="table-light">


                        <tr>

                            <th width="50">
                                No
                            </th>


                            <th>
                                Nomor Surat
                            </th>


                            <th>
                                Pemohon
                            </th>


                            <th>
                                Jenis Surat
                            </th>


                            <th>
                                Tanggal
                            </th>


                            <th>
                                Status
                            </th>


                            <th width="100">
                                Aksi
                            </th>


                        </tr>


                    </thead>



                    <tbody>


                    @forelse($permohonans as $row)


                    <tr>


                        <td>
                            {{ $loop->iteration }}
                        </td>


                        <td>

                            {{ $row->nomor_surat ?? '-' }}

                        </td>



                        <td>

                            {{ optional($row->penduduk)->nama_lengkap ?? '-' }}

                        </td>



                        <td>

                            {{ $row->jenisSurat->nama ?? '-' }}

                        </td>



                        <td>

                            {{ optional($row->created_at)->format('d-m-Y') }}

                        </td>




                        <td>


                            @if($row->status=='selesai')

                                <span class="badge bg-success">
                                    Selesai
                                </span>


                            @elseif($row->status=='diproses')

                                <span class="badge bg-warning">
                                    Diproses
                                </span>


                            @elseif($row->status=='ditolak')

                                <span class="badge bg-danger">
                                    Ditolak
                                </span>


                            @else

                                <span class="badge bg-secondary">
                                    Diajukan
                                </span>


                            @endif


                        </td>




                        <td>


                            <a href="#"
                               class="btn btn-sm btn-info">

                                <i class="bi bi-eye"></i>

                            </a>


                        </td>


                    </tr>


                    @empty


                    <tr>

                        <td colspan="7"
                            class="text-center py-4">


                            Belum ada data pelayanan surat


                        </td>


                    </tr>


                    @endforelse



                    </tbody>


                </table>


            </div>


        </div>



        <div class="card-footer">

            {{ $permohonans->links() }}

        </div>



    </div>


</div>


@endsection