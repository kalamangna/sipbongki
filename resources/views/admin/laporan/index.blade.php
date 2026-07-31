@extends('layouts.admin')

@section('title', 'Dashboard Laporan')

@section('content')

<div class="container-fluid">

    <div class="row mb-4">

        <div class="col">

          
            <p class="text-muted mb-0">
                Ringkasan Data dan Akses Cepat ke Seluruh Laporan 
            </p>

        </div>

    </div>


    {{-- Statistik --}}

    <div class="row g-5">

        <div class="col-lg-3 col-md-5">

            <x-ui.stat-card
                title="Penduduk"
                :total="$statistik['penduduk']"
                icon="fa-users"
                color="primary"/>

        </div>


        <div class="col-lg-3 col-md-5">

            <x-ui.stat-card
                title="Kartu Keluarga"
                :total="$statistik['kk']"
                icon="fa-house-user"
                color="success"/>

        </div>


        <div class="col-lg-3 col-md-5">

            <x-ui.stat-card
                title="Permohonan Surat"
                :total="$statistik['permohonan']"
                icon="fa-envelope-open-text"
                color="warning"/>

        </div>


        <div class="col-lg-3 col-md-5">

            <x-ui.stat-card
                title="Jenis Surat"
                :total="$statistik['jenis_surat']"
                icon="fa-folder-open"
                color="info"/>

        </div>

    </div>



    {{-- Menu Laporan --}}

    <div class="row mt-0 g-5">


        {{-- Penduduk --}}

        <div class="col-lg-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h5 class="fw-bold">
                        Laporan Kependudukan
                    </h5>


                    <p class="text-muted">

                        Rekapitulasi Data Penduduk

                    </p>


                    <div class="d-flex gap-2 flex-wrap">

                        <a href="{{ route('admin.laporan.penduduk') }}"
                           class="btn btn-primary">

                            </p></p>Buka Laporan</p></p>

                        </a>


                        <a href="{{ route('admin.laporan.export-penduduk') }}"
                           class="btn btn-outline-success">

                            <i class="fa-solid fa-file-excel"></i>
                            Export Excel

                        </a>

                    </div>


                </div>

            </div>

        </div>


        {{-- Kartu Keluarga --}}

        <div class="col-lg-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h5 class="fw-bold">
                        Laporan Kartu Keluarga
                    </h5>


                    <p class="text-muted">

                        Rekapitulasi Data KK.

                    </p>


                    <div class="d-flex gap-2 flex-wrap">

                        <a href="{{ route('admin.laporan.kartu-keluarga') }}"
                           class="btn btn-success">

                        </p></p>Buka Laporan</p></p>

                        </a>


                        <a href="{{ route('admin.laporan.export-kartu-keluarga') }}"
                           class="btn btn-outline-success">

                            <i class="fa-solid fa-file-excel"></i>
                            Export Excel

                        </a>

                    </div>


                </div>

            </div>

        </div>




        {{-- Persuratan --}}

        <div class="col-lg-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h5 class="fw-bold">
                        Laporan Persuratan
                    </h5>


                    <p class="text-muted">

                        Rekapitulasi Layanan Persuratan

                    </p>


                    <div class="d-flex gap-2 flex-wrap">


                        <a href="{{ route('admin.laporan.persuratan') }}"
                           class="btn btn-warning text-white">

                        </p></p>Buka Laporan</p></p>

                        </a>


                        <a href="{{ route('admin.laporan.export-persuratan') }}"
                           class="btn btn-outline-success">

                            <i class="fa-solid fa-file-excel"></i>
                            Export Excel

                        </a>


                    </div>


                </div>

            </div>

        </div>


    </div>


</div>

@endsection