@extends('layouts.operator')


@section('title','Dashboard Operator')


@section(
    'subtitle',
    'Pelayanan Masyarakat Kelurahan Bongki'
)


@section('content')


<div class="dashboard-container">



{{-- ==========================================================
    HERO OPERATOR
=========================================================== --}}


<section class="dashboard-hero">


    <div class="hero-content">


        <div class="hero-left">


            <span class="hero-badge">

                Operator Pelayanan

            </span>




            <h1>

                Selamat Datang,
                {{ auth()->user()->name }}

            </h1>




            <p>

                Kelola pelayanan masyarakat,
                data penduduk dan permohonan surat
                Kelurahan Bongki melalui satu dashboard.

            </p>




            <div class="hero-action">


                <a href="{{ route('operator.penduduk.create') }}"
                   class="btn btn-primary">


                    <i class="fa-solid fa-user-plus me-2"></i>


                    Tambah Penduduk


                </a>





                <a href="{{ route('operator.permohonan-surat.create') }}"
                   class="btn btn-light">


                    <i class="fa-solid fa-file-circle-plus me-2"></i>


                    Layanan Persuratan


                </a>



            </div>


        </div>





        <div class="hero-right">


            <div class="hero-summary">


                <div class="summary-item">


                    <small>

                        Hari Ini

                    </small>


                    <strong>

                        {{ now()->translatedFormat('d F Y') }}

                    </strong>


                </div>





                <div class="summary-item">


                    <small>

                        Status Sistem

                    </small>



                    <span class="badge bg-success">

                        Online

                    </span>


                </div>



            </div>


        </div>



    </div>


</section>








{{-- ==========================================================
    STATISTIK PELAYANAN
=========================================================== --}}


<section class="dashboard-statistik">


<div class="row g-4">



<div class="col-xl-3 col-md-6 col-12">


<x-ui.stat-card

    title="Permohonan Hari Ini"

    :total="$permohonanHariIni ?? 0"

    icon="fa-file-circle-plus"

    color="primary"

/>


</div>





<div class="col-xl-3 col-md-6 col-12">


<x-ui.stat-card

    title="Sedang Diproses"

    :total="$sedangDiproses ?? 0"

    icon="fa-clock"

    color="warning"

/>


</div>





<div class="col-xl-3 col-md-6 col-12">


<x-ui.stat-card

    title="Selesai Hari Ini"

    :total="$selesaiHariIni ?? 0"

    icon="fa-circle-check"

    color="success"

/>


</div>





<div class="col-xl-3 col-md-6 col-12">


<x-ui.stat-card

    title="Penduduk Baru"

    :total="$pendudukBaru ?? 0"

    icon="fa-user-plus"

    color="info"

/>


</div>




</div>


</section>



</section>


{{-- ==========================================================
    DATA RINGKAS KEPENDUDUKAN
=========================================================== --}}

<section class="dashboard-statistik mt-4">

    <div class="row g-4">


        <div class="col-xl-4 col-md-6 col-12">

            <x-ui.stat-card

                title="Total Penduduk"

                :total="$totalPenduduk ?? 0"

                icon="fa-users"

                color="primary"

            />

        </div>



        <div class="col-xl-4 col-md-6 col-12">

            <x-ui.stat-card

                title="Total Kartu Keluarga"

                :total="$totalKK ?? 0"

                icon="fa-address-card"

                color="success"

            />

        </div>



        <div class="col-xl-4 col-md-6 col-12">

            <x-ui.stat-card

                title="Lingkungan"

                :total="$totalLingkungan ?? 0"

                icon="fa-map-location-dot"

                color="warning"

            />

        </div>


    </div>

</section>





{{-- ==========================================================
    QUICK ACCESS
=========================================================== --}}






{{-- ==========================================================
    QUICK ACCESS
=========================================================== --}}


<section class="dashboard-shortcut mt-4">


<div class="row g-4">





<div class="col-lg-3 col-sm-6">


<a href="{{ route('operator.permohonan-surat.create') }}"
   class="shortcut-card">


<div class="shortcut-icon bg-primary">


<i class="fa-solid fa-file-circle-plus"></i>


</div>



<div>


<h5>

Layanan Persuratan

</h5>


<p>

Buat permohonan surat

</p>


</div>


</a>


</div>







<div class="col-lg-3 col-sm-6">


<a href="{{ route('operator.penduduk.create') }}"
   class="shortcut-card">


<div class="shortcut-icon bg-success">


<i class="fa-solid fa-user-plus"></i>


</div>



<div>


<h5>

Tambah Penduduk

</h5>


<p>

Input data warga baru

</p>


</div>


</a>


</div>







<div class="col-lg-3 col-sm-6">


<a href="{{ route('operator.penduduk.index') }}"
   class="shortcut-card">


<div class="shortcut-icon bg-warning">


<i class="fa-solid fa-magnifying-glass"></i>


</div>



<div>


<h5>

Cari Penduduk

</h5>


<p>

Pencarian Data Warga

</p>


</div>


</a>


</div>







<div class="col-lg-3 col-sm-6">


<a href="{{ route('operator.riwayat-pelayanan.index') }}"
   class="shortcut-card">


<div class="shortcut-icon bg-info">


<i class="fa-solid fa-clock-rotate-left"></i>


</div>



<div>


<h5>

Riwayat

</h5>


<p>

Riwayat pelayanan

</p>


</div>


</a>


</div>




</div>


</section>










{{-- ==========================================================
    PERMOHONAN TERBARU
=========================================================== --}}


<div class="row g-4 mt-4">



<div class="col-xl-9">



<div class="card dashboard-card h-100">


<div class="card-header">


<h5 class="fw-bold mb-0">


Permohonan Terbaru


</h5>


</div>





<div class="table-responsive">

<table class="table table-hover align-middle mb-0">


<thead>


<tr>

<th>
Nama
</th>

<th>
Jenis Surat
</th>

<th>
Status
</th>


</tr>


</thead>




<tbody>


@forelse($permohonanTerbaru ?? [] as $item)


<tr>


<td>


{{ optional($item->penduduk)->nama_lengkap }}


</td>




<td>


{{ optional($item->jenisSurat)->nama }}


</td>




<td>


<span class="badge bg-warning">

{{ $item->status }}

</span>


</td>



</tr>



@empty


<tr>


<td colspan="3"
class="text-center py-4">


Belum ada permohonan.


</td>


</tr>



@endforelse



</tbody>


</table>


</div>


</div>


</div>









{{-- AKTIVITAS --}}


<div class="col-xl-3">


<div class="card dashboard-card h-100">


<div class="card-header">


<h5 class="fw-bold mb-0">


Aktivitas Hari Ini


</h5>


</div>




<div class="card-body">



<div class="activity-item">


<div class="activity-icon success">


<i class="fa-solid fa-user-plus"></i>


</div>



<div>


<strong>

Penduduk Baru

</strong>


<p class="mb-0">

Input data penduduk

</p>


</div>


</div>







<div class="activity-item">


<div class="activity-icon primary">


<i class="fa-solid fa-file-signature"></i>


</div>



<div>


<strong>

Pelayanan Surat

</strong>


<p class="mb-0">

Permohonan diproses

</p>


</div>


</div>







<div class="activity-item">


<div class="activity-icon warning">


<i class="fa-solid fa-clock"></i>


</div>



<div>


<strong>

Antrian

</strong>


<p class="mb-0">

Menunggu pelayanan

</p>


</div>


</div>



</div>



</div>


</div>




</div>







{{-- ==========================================================
    INFO PELAYANAN
=========================================================== --}}


<div class="card dashboard-card mt-4">


<div class="card-body">


<div class="row text-center">



<div class="col-md-4">


<h6>

Jam Pelayanan

</h6>


<strong>

08.00 - 16.00

</strong>


</div>





<div class="col-md-4">


<h6>

Lokasi

</h6>


<strong>

Kelurahan Bongki

</strong>


</div>





<div class="col-md-4">


<h6>

Sistem

</h6>


<span class="badge bg-success">

Aktif

</span>


</div>



</div>


</div>


</div>



</div>


@endsection