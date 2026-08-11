@extends('layouts.operator')

@section('title', 'Dashboard Laporan')

@section('content')

<div class="container-fluid">


    <div class="row mb-4">

        <div class="col">

            <h4 class="fw-bold mb-1">
                Dashboard Laporan
            </h4>


            <p class="text-muted mb-0">

                Ringkasan data dan akses cepat ke seluruh laporan SIP Bongki.

            </p>


        </div>

    </div>




    {{-- Statistik --}}

    <div class="row g-4">


        <div class="col-lg-3 col-md-6">


            <x-ui.stat-card

                title="Penduduk"

                :total="$statistik['penduduk']"

                icon="fa-users"

                color="primary"/>


        </div>




        <div class="col-lg-3 col-md-6">


            <x-ui.stat-card

                title="Kartu Keluarga"

                :total="$statistik['kk']"

                icon="fa-house-user"

                color="success"/>


        </div>




        <div class="col-lg-3 col-md-6">


            <x-ui.stat-card

                title="Permohonan Surat"

                :total="$statistik['permohonan']"

                icon="fa-envelope-open-text"

                color="warning"/>


        </div>




        <div class="col-lg-3 col-md-6">


            <x-ui.stat-card

                title="Jenis Surat"

                :total="$statistik['jenis_surat']"

                icon="fa-folder-open"

                color="info"/>


        </div>



    </div>







    {{-- Menu Laporan --}}


    <div class="row mt-5 g-4">





        {{-- Penduduk --}}


        <div class="col-lg-4">


            <div class="card shadow-sm border-0 h-100">


                <div class="card-body">


                    <h5 class="fw-bold">

                        Laporan Penduduk

                    </h5>



                    <p class="text-muted">


                        Statistik dan data penduduk berdasarkan lingkungan,
                        jenis kelamin, agama, pendidikan dan pekerjaan.


                    </p>




                    <a href="{{ route('operator.laporan.penduduk') }}"

                       class="btn btn-primary">


                        Buka Laporan


                    </a>



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


                        Rekapitulasi data kartu keluarga dan anggota keluarga.


                    </p>




                    <a href="{{ route('operator.laporan.kartu-keluarga') }}"

                       class="btn btn-success">


                        Buka Laporan


                    </a>



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


                        Statistik permohonan surat berdasarkan periode,
                        status dan jenis surat.


                    </p>





                    <a href="{{ route('operator.laporan.persuratan') }}"

                       class="btn btn-warning text-white">


                        Buka Laporan


                    </a>



                </div>


            </div>


        </div>



    </div>


</div>


@endsection