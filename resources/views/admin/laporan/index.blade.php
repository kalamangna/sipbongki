@extends('layouts.admin')

@section('title', 'Dashboard Laporan')

@section('content')

<div class="container-fluid">

    <div class="flex flex-wrap -mx-3 mb-6">

        <div class="col">

          
            <p class="text-slate-500 mb-0">
                Ringkasan Data dan Akses Cepat ke Seluruh Laporan 
            </p>

        </div>

    </div>


    {{-- Statistik --}}

    <div class="flex flex-wrap -mx-3 g-5">

        <div class="w-full lg:w-1/4 px-3 col-md-5">

            <x-ui.stat-card
                title="Penduduk"
                :total="$statistik['penduduk']"
                icon="fa-users"
                color="primary"/>

        </div>


        <div class="w-full lg:w-1/4 px-3 col-md-5">

            <x-ui.stat-card
                title="Kartu Keluarga"
                :total="$statistik['kk']"
                icon="fa-house-user"
                color="success"/>

        </div>


        <div class="w-full lg:w-1/4 px-3 col-md-5">

            <x-ui.stat-card
                title="Permohonan Surat"
                :total="$statistik['permohonan']"
                icon="fa-envelope-open-text"
                color="warning"/>

        </div>


        <div class="w-full lg:w-1/4 px-3 col-md-5">

            <x-ui.stat-card
                title="Jenis Surat"
                :total="$statistik['jenis_surat']"
                icon="fa-folder-open"
                color="info"/>

        </div>

    </div>



    {{-- Menu Laporan --}}

    <div class="flex flex-wrap -mx-3 mt-0 g-5">


        {{-- Penduduk --}}

        <div class="w-full lg:w-1/3 px-3">

            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 h-100">

                <div class="p-6">

                    <h5 class="font-bold">
                        Laporan Kependudukan
                    </h5>


                    <p class="text-slate-500">

                        Rekapitulasi Data Penduduk

                    </p>


                    <div class="flex gap-2 flex-wrap">

                        <a href="{{ route('admin.laporan.penduduk') }}"
                           class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

                            </p></p>Buka Laporan</p></p>

                        </a>


                                <a href="{{ route('admin.laporan.export-penduduk') }}"
                                    class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-outline-success">

                            <i class="fa-solid fa-file-excel"></i>
                            Export Excel

                        </a>

                        <a href="{{ route('admin.laporan.statistik') }}"
                           class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all text-primary-600 border border-primary-600 hover:bg-primary-50">

                            Lihat Statistik

                        </a>

                    </div>


                </div>

            </div>

        </div>


        {{-- Kartu Keluarga --}}

        <div class="w-full lg:w-1/3 px-3">

            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 h-100">

                <div class="p-6">

                    <h5 class="font-bold">
                        Laporan Kartu Keluarga
                    </h5>


                    <p class="text-slate-500">

                        Rekapitulasi Data KK.

                    </p>


                    <div class="flex gap-2 flex-wrap">

                        <a href="{{ route('admin.laporan.kartu-keluarga') }}"
                           class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm">

                        </p></p>Buka Laporan</p></p>

                        </a>


                        <a href="{{ route('admin.laporan.export-kartu-keluarga') }}"
                           class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-outline-success">

                            <i class="fa-solid fa-file-excel"></i>
                            Export Excel

                        </a>

                    </div>


                </div>

            </div>

        </div>




        {{-- Persuratan --}}

        <div class="w-full lg:w-1/3 px-3">

            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 h-100">

                <div class="p-6">

                    <h5 class="font-bold">
                        Laporan Persuratan
                    </h5>


                    <p class="text-slate-500">

                        Rekapitulasi Layanan Persuratan

                    </p>


                    <div class="flex gap-2 flex-wrap">


                        <a href="{{ route('admin.laporan.persuratan') }}"
                           class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-amber-500 text-white hover:bg-amber-600 shadow-sm">

                        </p></p>Buka Laporan</p></p>

                        </a>


                        <a href="{{ route('admin.laporan.export-persuratan') }}"
                           class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-outline-success">

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