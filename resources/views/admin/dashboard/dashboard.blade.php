@extends('layouts.admin')

@section('title','Dashboard')

@section('subtitle','Sistem Informasi dan Pelayanan Kelurahan Bongki')

@section('content')

<div class="dashboard-container">

    {{-- ==========================================================
        HERO
    =========================================================== --}}

    <section class="dashboard-hero">

        <div class="hero-content">

            <div class="hero-left">

                
                </span>

                <h4>

                    Selamat Datang,
                    {{ auth()->user()->name }}

                </h4>

                <p>
                    Kelola seluruh layanan administrasi,
                    kependudukan, persuratan dan informasi
                    Kelurahan Bongki melalui satu dashboard.

                </p>

                <div class="hero-action">

                    <a href="{{ route('admin.penduduk.create') }}"
                       class="btn btn-primary">

                        <i class="fa-solid fa-user-plus me-2"></i>

                        Tambah Penduduk

                    </a>

                    <a href="{{ route('admin.permohonan-surat.create') }}"
                       class="btn btn-light">

                        <i class="fa-solid fa-file-circle-plus me-2"></i>

                        Layanan Adminisrasi

                    </a>

                </div>

            </div>

            <div class="hero-right">

                <div class="hero-summary">

                    <div class="summary-item">

                        <small>Hari Ini</small>

                        <strong>

                            {{ now()->translatedFormat('d F Y') }}

                        </strong>

                    </div>

                    <div class="summary-item">

                        <small>Status Sistem</small>

                        <span class="badge bg-success">

                            Aktif

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </section>

    {{-- ==========================================================
        STATISTIK
    =========================================================== --}}

    <section class="dashboard-statistik">

        <div class="row g-5">

            <div class="col-xl-3 col-md-5">

                <x-ui.stat-card
                    title="Total Penduduk"
                    :total="$totalPenduduk"
                    icon="fa-users"
                    color="primary"/>

            </div>

            <div class="col-xl-3 col-md-5">

                <x-ui.stat-card
                    title="Kartu Keluarga"
                    :total="$totalKK"
                    icon="fa-address-card"
                    color="success"/>

            </div>

            <div class="col-xl-3 col-md-5">

                <x-ui.stat-card
                    title="Perangkat"
                    :total="$totalPerangkat"
                    icon="fa-user-tie"
                    color="warning"/>

            </div>

            <div class="col-xl-3 col-md-5">

                <x-ui.stat-card
                    title="Permohonan Surat"
                    :total="$totalPermohonan"
                    icon="fa-file-signature"
                    color="danger"/>

            </div>

        </div>

    </section>

    {{-- ==========================================================
        QUICK ACCESS
    =========================================================== --}}

    <section class="dashboard-shortcut mt-1">

        <div class="row g-4">

            <div class="col-xl-3 col-md-5">

                <a href="{{ route('admin.penduduk.index') }}"
                   class="shortcut-card">

                    <div class="shortcut-icon bg-primary">

                        <i class="fa-solid fa-users"></i>

                    </div>

                    <div>

                        <h5>Data Penduduk</h5>
                        <p>Kelola data kependudukan</p>

                    </div>

                </a>

            </div>

            <div class="col-xl-3 col-sm-5">

                <a href="{{ route('admin.kartu-keluarga.index') }}"
                   class="shortcut-card">

                    <div class="shortcut-icon bg-success">

                        <i class="fa-solid fa-address-card"></i>

                    </div>

                    <div>

                        <h5>Kartu Keluarga</h5>

                        <p>Data Kartu Keluarga</p>

                    </div>

                </a>

            </div>

            <div class="col-xl-3 col-sm-5">

                <a href="{{ route('admin.permohonan-surat.index') }}"
                   class="shortcut-card">

                    <div class="shortcut-icon bg-warning">

                        <i class="fa-solid fa-file-signature"></i>

                    </div>

                    <div>

                        <h5>Persuratan</h5>

                        <p>Pelayanan Administrasi</p>

                    </div>

                </a>

            </div>

            <div class="col-xl-3 col-sm-5">

                <a href="{{ route('admin.perangkat.index') }}"
                   class="shortcut-card">

                    <div class="shortcut-icon bg-info">

                        <i class="fa-solid fa-user-tie"></i>

                    </div>

                    <div>

                        <h5>Perangkat</h5>

                        <p>Data Pejabat Kelurahan</p>

                    </div>

                </a>

            </div>

        </div>

    </section>
    {{-- ==========================================================
        GRAFIK & AKTIVITAS
    =========================================================== --}}

    <div class="row g-3 mt-1">

        {{-- Grafik --}}
        <div class="col-xl-8">

            <div class="card dashboard-card h-100">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <div>

                        <h5 class="fw-bold mb-1">

                            Statistik Pelayanan

                        </h5>

                       
                    </div>

                    <button
    class="btn btn-outline-primary btn-sm"
    onclick="downloadChart()">

    <i class="fa-solid fa-download me-1"></i>
    Export

</button>

                </div>

                <div class="card-body">

                    <canvas id="chartPelayanan" height="100"></canvas>

                </div>

            </div>

        </div>

        {{-- Aktivitas --}}
        <div class="col-xl-4">

            <div class="card dashboard-card h-100">

                <div class="card-header">

                    <h5 class="fw-bold mb-0">

                        Aktivitas Terbaru

                    </h5>

                </div>

                <div class="card-body">

                    <div class="activity-item">

                        <div class="activity-icon success">

                            <i class="fa-solid fa-user-plus"></i>

                        </div>

                        <div>

                            <strong>Penduduk Baru</strong>

                            <p class="mb-1">

                                Penambahan data penduduk baru.

                            </p>

                            <small class="text-muted">

                                Hari ini

                            </small>

                        </div>

                    </div>

                    <div class="activity-item">

                        <div class="activity-icon primary">

                            <i class="fa-solid fa-house-user"></i>

                        </div>

                        <div>

                            <strong>Kartu Keluarga</strong>

                            <p class="mb-1">

                                Pembaruan data kartu keluarga.

                            </p>

                            <small class="text-muted">

                                Hari ini

                            </small>

                        </div>

                    </div>

                    <div class="activity-item">

                        <div class="activity-icon warning">

                            <i class="fa-solid fa-file-signature"></i>

                        </div>

                        <div>

                            <strong>Permohonan Surat</strong>

                            <p class="mb-1">

                                Permohonan surat menunggu proses.

                            </p>

                            <small class="text-muted">

                                Hari ini

                            </small>

                        </div>

                    </div>

                    <div class="activity-item">

                        <div class="activity-icon danger">

                            <i class="fa-solid fa-gear"></i>

                        </div>

                        <div>

                            <strong>Sistem</strong>

                            <p class="mb-1">

                                Sistem berjalan normal.

                            </p>

                            <small class="text-muted">

                                Aktif

                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- ==========================================================
        PERMOHONAN SURAT TERBARU
    =========================================================== --}}

    <div class="row g-4 mt-0">

        <div class="col-lg-9">

            <div class="card dashboard-card h-100">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <div>

                        <h5 class="fw-bold mb-1">

                            Permohonan Surat Terbaru

                        </h5>

                    </div>

                    <a href="{{ route('admin.permohonan-surat.index') }}"
                       class="btn btn-primary btn-sm">

                        Lihat Semua

                    </a>

                </div>

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead>

                            <tr>

                                <th>Nama</th>
                                <th>Jenis Surat</th>
                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($permohonanTerbaru as $item)

                                <tr>

                                    <td>

                                        {{ optional($item->penduduk)->nama_lengkap }}

                                    </td>

                                    <td>

                                        {{ optional($item->jenisSurat)->nama }}

                                    </td>

                                    <td>

                                        @switch($item->status)

                                            @case('Menunggu')
                                                <span class="badge bg-secondary">Menunggu</span>
                                            @break

                                            @case('Diproses')
                                                <span class="badge bg-warning text-dark">Diproses</span>
                                            @break

                                            @case('Selesai')
                                                <span class="badge bg-success">Selesai</span>
                                            @break

                                            @case('Ditolak')
                                                <span class="badge bg-danger">Ditolak</span>
                                            @break

                                            @default
                                                <span class="badge bg-secondary">
                                                    {{ $item->status }}
                                                </span>

                                        @endswitch

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="3" class="text-center py-4">

                                        Belum ada data permohonan.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card dashboard-card h-100">

                <div class="card-header">

                    <h5 class="fw-bold mb-0">

                        Komposisi Penduduk

                    </h5>

                </div>

               <div class="card-body">

    <div style="height:260px;">
        <canvas id="chartPenduduk"></canvas>
    </div>

</div>
        </div>

    </div>
    {{-- ==========================================================
        INFORMASI KELURAHAN
    =========================================================== --}}

    <div class="row g-4 mt-4">

        <div class="col-lg-8">

            <div class="card dashboard-card h-100">

                <div class="card-header">

                    <h5 class="fw-bold mb-0">

                        Informasi Kelurahan Bongki

                    </h5>

                </div>

                <div class="card-body">

                    <div class="row g-2">

                        <div class="col-md-4">

                            <div class="info-box">

                                <div class="info-icon bg-primary">

                                    <i class="fa-solid fa-map-location-dot"></i>

                                </div>

                                <div>

                                    <small>Lingkungan</small>

                                    <h4>4</h4>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="info-box">

                                <div class="info-icon bg-success">

                                    <i class="fa-solid fa-road"></i>

                                </div>

                                <div>

                                    <small>RT</small>

                                    <h4>16</h4>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="info-box">

                                <div class="info-icon bg-warning">

                                    <i class="fa-solid fa-sitemap"></i>

                                </div>

                                <div>

                                    <small>RW</small>

                                    <h4>4</h4>

                                </div>

                            </div>

                        </div>

                    </div>

                    <hr>

                    <div class="row">

                        <div class="col-xl-22">

                            <table class="table table-borderless mb-0">

                                <tr>

                                    <td width="45%">Kelurahan</td>

                                    <td><strong>Bongki</strong></td>

                                </tr>

                                <tr>

                                    <td>Kecamatan</td>

                                    <td><strong>Sinjai Utara</strong></td>

                                </tr>

                                <tr>

                                    <td>Kabupaten</td>

                                    <td><strong>Sinjai</strong></td>

                                </tr>

                            </table>

                        </div>

                        <div class="col-xl-22">

                            <table class="table table-borderless mb-0">

                                <tr>

                                    <td width="45%">Provinsi</td>

                                    <td><strong>Sulawesi Selatan</strong></td>

                                </tr>

                                <tr>

                                    <td>Status</td>

                                    <td>

                                        <span class="badge bg-success">

                                            Aktif

                                        </span>

                                    </td>

                                </tr>

                                <tr>

                                    <td>Versi</td>

                                    <td>SiPBongki 2.0</td>

                                </tr>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card dashboard-card h-100">

                <div class="card-header">

                    <h5 class="fw-bold mb-0">

                        Informasi Sistem

                    </h5>

                </div>

                <div class="card-body">

                    <div class="system-item">

                        <span>Framework</span>

                        <strong>Laravel 12</strong>

                    </div>

                    <div class="system-item">

                        <span>PHP</span>

                        <strong>8.2</strong>

                    </div>

                    <div class="system-item">

                        <span>Database</span>

                        <strong>MariaDB</strong>

                    </div>

                    <div class="system-item">

                        <span>UI</span>

                        <strong>Bootstrap 5</strong>

                    </div>

                    <div class="system-item">

                        <span>Status</span>

                        <span class="badge bg-success">

                            Online

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- ==========================================================
        STATISTIK LINGKUNGAN
    =========================================================== --}}

    <div class="row g-4 mt-4">

        <div class="col-lg-3">

            <div class="card dashboard-card h-100">

                <div class="card-header">

                    <h5 class="fw-bold mb-0">

                        Statistik Lingkungan

                    </h5>

                </div>

                <div class="card-body">

                    @forelse($lingkungan as $item)

                        @php

                            $persen = $totalPenduduk > 0
                                ? ($item->penduduk_count / $totalPenduduk) * 100
                                : 0;

                        @endphp

                        <div class="mb-4">

                            <div class="d-flex justify-content-between mb-2">

                                <strong>

                                    {{ $item->nama }}

                                </strong>

                                <strong>

                                    {{ number_format($item->penduduk_count) }}

                                </strong>

                            </div>

                            <div class="progress">

                                <div class="progress-bar bg-primary"
                                     style="width: {{ $persen }}%">

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="text-center py-5">

                            Belum ada data lingkungan.

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

        <div class="col-lg-9">

            <div class="card dashboard-card h-100">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h5 class="fw-bold mb-0">

                        Penduduk Terbaru

                    </h5>

                    <a href="{{ route('admin.penduduk.index') }}"
                       class="btn btn-primary btn-sm">

                        Lihat Semua

                    </a>

                </div>

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead>

                            <tr>

                                <th>NIK</th>
                                <th>Nama</th>
                                <th>JK</th>
                                <th>Lingkungan</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($pendudukTerbaru as $item)

                                <tr>

                                    <td>{{ $item->nik }}</td>

                                    <td>

                                        <strong>

                                            {{ $item->nama_lengkap }}

                                        </strong>

                                    </td>

                                    <td>{{ $item->jenis_kelamin }}</td>

                                    <td>{{ optional($item->lingkungan)->nama }}</td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="text-center">

                                        Belum ada data.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
@php
    $bulanIndonesia = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember',
    ];

    $bulan = $bulanIndonesia[date('F')];
@endphp

<script>

let pelayananChart;

document.addEventListener('DOMContentLoaded', function () {


    // ===========================
    // CHART PELAYANAN
    // ===========================

    const pelayanan = @json($chartPelayanan);

    const pelayananCanvas = document.getElementById('chartPelayanan');


    if (pelayananCanvas && pelayanan) {

        pelayananChart = new Chart(pelayananCanvas, {

            type: 'bar',

            data: {

                labels: pelayanan.labels,

                datasets: [{

                    label: 'Jumlah',

                    data: pelayanan.data,

                    backgroundColor: [

                        '#2563EB',
                        '#10B981',
                        '#F59B0B',
                        '#EF4444'

                    ],

                    borderRadius: 8,

                    borderSkipped: false

                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                plugins: {

                    legend: {

                        display: false

                    }

                },

                scales: {

                    y: {

                        beginAtZero: true,

                        ticks: {

                            precision: 0

                        }

                    }

                }

            }

        });

    }



    // ===========================
    // CHART KOMPOSISI PENDUDUK
    // ===========================

    const chartJK = @json($chartJK);

    const pendudukCanvas = document.getElementById('chartPenduduk');


    if (pendudukCanvas && chartJK) {

        new Chart(pendudukCanvas, {

            type: 'doughnut',

            data: {

                labels: chartJK.labels,

                datasets: [{

                    data: chartJK.data,

                    backgroundColor: [

                        '#2563EB',
                        '#EC4899'

                    ],

                    borderColor: '#ffffff',

                    borderWidth: 2,

                    hoverOffset: 10

                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                cutout: '65%',

                plugins: {

                    legend: {

                        position: 'bottom',

                        labels: {

                            usePointStyle: true,

                            padding: 20

                        }

                    }

                }

            }

        });

    }


});



function downloadChart() {

    if (!pelayananChart) {

        alert('Grafik belum tersedia');

        return;

    }


    const link = document.createElement('a');

    link.download = 'Laporan-Pelayanan-{{ $bulan }}-{{ date("Y") }}.png';

    link.href = pelayananChart.toBase64Image();

    link.click();

}


</script>



@endsection