@extends('layouts.admin')

@section('title','Dashboard')

@section('subtitle','Sistem Informasi dan Pelayanan Kelurahan Bongki')

@section('content')

<div class="d-flex flex-column gap-4">

    {{-- 1. HERO SECTION --}}
    <div class="card border-0 shadow-sm rounded-4 text-white overflow-hidden" style="background: linear-gradient(135deg, #059669 0%, #047857 100%);">
        <div class="card-body p-4 p-lg-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <span class="badge bg-white bg-opacity-25 text-white fw-semibold mb-2 px-3 py-1.5 rounded-pill">Administrator Panel</span>
                    <h2 class="fw-bold mb-2">Selamat Datang, {{ auth()->user()->name }}</h2>
                    <p class="mb-4 text-white-50 leading-relaxed" style="max-width: 600px;">
                        Kelola seluruh layanan administrasi, kependudukan, persuratan dan informasi Kelurahan Bongki melalui satu dashboard terpadu.
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.penduduk.create') }}" class="btn btn-light text-success fw-bold px-4 py-2 rounded-3 shadow-xs">
                            <i class="fa-solid fa-user-plus me-2"></i> Tambah Penduduk
                        </a>
                        <a href="{{ route('admin.permohonan-surat.create') }}" class="btn btn-outline-light fw-semibold px-4 py-2 rounded-3">
                            <i class="fa-solid fa-file-circle-plus me-2"></i> Layanan Administrasi
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end border-start border-white border-opacity-25 ps-lg-4">
                    <div class="bg-white bg-opacity-10 p-3 rounded-4 mb-2">
                        <small class="text-white-50 d-block text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Hari Ini</small>
                        <strong class="fs-5">{{ now()->translatedFormat('d F Y') }}</strong>
                    </div>
                    <div class="bg-white bg-opacity-10 p-3 rounded-4 d-flex justify-content-between align-items-center">
                        <small class="text-white-50 text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Status Sistem</small>
                        <span class="badge bg-emerald-400 text-dark font-bold px-2.5 py-1 rounded-pill" style="background-color: #34d399;">Aktif</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. STATISTIK CARDS --}}
    <div class="row g-3">
        <div class="col-xl-3 col-md-6">
            <x-ui.stat-card title="Total Penduduk" :total="$totalPenduduk" icon="fa-users" color="primary"/>
        </div>
        <div class="col-xl-3 col-md-6">
            <x-ui.stat-card title="Kartu Keluarga" :total="$totalKK" icon="fa-address-card" color="success"/>
        </div>
        <div class="col-xl-3 col-md-6">
            <x-ui.stat-card title="Perangkat" :total="$totalPerangkat" icon="fa-user-tie" color="warning"/>
        </div>
        <div class="col-xl-3 col-md-6">
            <x-ui.stat-card title="Permohonan Surat" :total="$totalPermohonan" icon="fa-file-signature" color="danger"/>
        </div>
    </div>

    {{-- 3. QUICK ACCESS CARDS (MODUL UTAMA) --}}
    <div class="row g-3">
        <div class="col-xl-2 col-md-4 col-6">
            <a href="{{ route('admin.penduduk.index') }}" class="card border-0 shadow-sm rounded-4 text-decoration-none text-dark h-100 transition-all hover-translate-y">
                <div class="card-body p-3 d-flex flex-column align-items-center text-center gap-2">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2.5 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="fa-solid fa-users fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-truncate" style="font-size: 13px;">Data Penduduk</h6>
                        <small class="text-muted" style="font-size: 11px;">Kelola Warga</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-2 col-md-4 col-6">
            <a href="{{ route('admin.kartu-keluarga.index') }}" class="card border-0 shadow-sm rounded-4 text-decoration-none text-dark h-100 transition-all hover-translate-y">
                <div class="card-body p-3 d-flex flex-column align-items-center text-center gap-2">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-2.5 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="fa-solid fa-address-card fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-truncate" style="font-size: 13px;">Kartu Keluarga</h6>
                        <small class="text-muted" style="font-size: 11px;">Data KK</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-2 col-md-4 col-6">
            <a href="{{ route('admin.permohonan-surat.index') }}" class="card border-0 shadow-sm rounded-4 text-decoration-none text-dark h-100 transition-all hover-translate-y">
                <div class="card-body p-3 d-flex flex-column align-items-center text-center gap-2">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-2.5 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="fa-solid fa-envelope-open-text fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-truncate" style="font-size: 13px;">Persuratan</h6>
                        <small class="text-muted" style="font-size: 11px;">Pelayanan Surat</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-2 col-md-4 col-6">
            <a href="{{ route('admin.pengaduan.index') }}" class="card border-0 shadow-sm rounded-4 text-decoration-none text-dark h-100 transition-all hover-translate-y">
                <div class="card-body p-3 d-flex flex-column align-items-center text-center gap-2">
                    <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-2.5 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="fa-solid fa-comments fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-truncate" style="font-size: 13px;">Pengaduan</h6>
                        <small class="text-muted" style="font-size: 11px;">Laporan Warga</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-2 col-md-4 col-6">
            <a href="{{ route('admin.website.berita.index') }}" class="card border-0 shadow-sm rounded-4 text-decoration-none text-dark h-100 transition-all hover-translate-y">
                <div class="card-body p-3 d-flex flex-column align-items-center text-center gap-2">
                    <div class="bg-info bg-opacity-10 text-info rounded-3 p-2.5 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="fa-solid fa-newspaper fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-truncate" style="font-size: 13px;">CMS Berita</h6>
                        <small class="text-muted" style="font-size: 11px;">Artikel & Berita</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-2 col-md-4 col-6">
            <a href="{{ route('admin.website.pengaturan.index') }}" class="card border-0 shadow-sm rounded-4 text-decoration-none text-dark h-100 transition-all hover-translate-y">
                <div class="card-body p-3 d-flex flex-column align-items-center text-center gap-2">
                    <div class="bg-dark bg-opacity-10 text-dark rounded-3 p-2.5 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="fa-solid fa-building fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-truncate" style="font-size: 13px;">Setting Web</h6>
                        <small class="text-muted" style="font-size: 11px;">Profil & Kontak</small>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- 4. GRAFIK PELAYANAN & AKTIVITAS TERBARU --}}
    <div class="row g-3">
        <div class="col-xl-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-0 text-dark">Statistik Pelayanan</h5>
                        <small class="text-muted">Grafik permohonan persuratan bulanan</small>
                    </div>
                    <button class="btn btn-outline-success btn-sm rounded-3 px-3" onclick="downloadChart()">
                        <i class="fa-solid fa-download me-1"></i> Export
                    </button>
                </div>
                <div class="card-body p-4">
                    <canvas id="chartPelayanan" height="100"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h5 class="fw-bold mb-0 text-dark">Aktivitas Terbaru</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex gap-3 align-items-start pb-3 border-bottom">
                            <div class="bg-success bg-opacity-10 text-success p-2.5 rounded-3">
                                <i class="fa-solid fa-user-plus fs-5"></i>
                            </div>
                            <div>
                                <strong class="d-block text-dark small fw-bold">Penduduk Baru</strong>
                                <p class="mb-0 text-muted small">Penambahan data penduduk baru.</p>
                                <small class="text-muted" style="font-size: 11px;">Hari ini</small>
                            </div>
                        </div>
                        <div class="d-flex gap-3 align-items-start pb-3 border-bottom">
                            <div class="bg-primary bg-opacity-10 text-primary p-2.5 rounded-3">
                                <i class="fa-solid fa-house-user fs-5"></i>
                            </div>
                            <div>
                                <strong class="d-block text-dark small fw-bold">Kartu Keluarga</strong>
                                <p class="mb-0 text-muted small">Pembaruan data kartu keluarga.</p>
                                <small class="text-muted" style="font-size: 11px;">Hari ini</small>
                            </div>
                        </div>
                        <div class="d-flex gap-3 align-items-start">
                            <div class="bg-warning bg-opacity-10 text-warning p-2.5 rounded-3">
                                <i class="fa-solid fa-file-signature fs-5"></i>
                            </div>
                            <div>
                                <strong class="d-block text-dark small fw-bold">Permohonan Surat</strong>
                                <p class="mb-0 text-muted small">Permohonan surat menunggu proses.</p>
                                <small class="text-muted" style="font-size: 11px;">Hari ini</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 5. PERMOHONAN SURAT TERBARU & KOMPOSISI PENDUDUK --}}
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 text-dark">Permohonan Surat Terbaru</h5>
                    <a href="{{ route('admin.permohonan-surat.index') }}" class="btn btn-success btn-sm rounded-3 px-3">
                        Lihat Semua
                    </a>
                </div>
                <div class="card-body p-0 mt-3">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Nama Pemohon</th>
                                    <th>Jenis Surat</th>
                                    <th class="pe-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($permohonanTerbaru as $item)
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">{{ optional($item->penduduk)->nama_lengkap }}</td>
                                        <td>{{ optional($item->jenisSurat)->nama }}</td>
                                        <td class="pe-4">
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
                                                    <span class="badge bg-secondary">{{ $item->status }}</span>
                                            @endswitch
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted">Belum ada data permohonan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h5 class="fw-bold mb-0 text-dark">Komposisi Penduduk</h5>
                </div>
                <div class="card-body p-4">
                    <div style="height:240px;">
                        <canvas id="chartPenduduk"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 6. STATISTIK LINGKUNGAN & PENDUDUK TERBARU --}}
    <div class="row g-3">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h5 class="fw-bold mb-0 text-dark">Statistik Lingkungan</h5>
                </div>
                <div class="card-body p-4">
                    @forelse($lingkungan as $item)
                        @php
                            $persen = $totalPenduduk > 0
                                ? ($item->penduduk_count / $totalPenduduk) * 100
                                : 0;
                        @endphp
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1 small">
                                <span class="fw-bold text-dark">{{ $item->nama }}</span>
                                <span class="text-muted">{{ number_format($item->penduduk_count) }} jiwa ({{ number_format($persen, 1) }}%)</span>
                            </div>
                            <div class="progress rounded-pill" style="height: 8px;">
                                <div class="progress-bar bg-success rounded-pill" style="width: {{ $persen }}%;"></div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-muted small">
                            Belum ada data lingkungan.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 text-dark">Penduduk Terbaru</h5>
                    <a href="{{ route('admin.penduduk.index') }}" class="btn btn-success btn-sm rounded-3 px-3">
                        Lihat Semua
                    </a>
                </div>
                <div class="card-body p-0 mt-3">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">NIK</th>
                                    <th>Nama Lengkap</th>
                                    <th>JK</th>
                                    <th class="pe-4">Lingkungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendudukTerbaru as $item)
                                    <tr>
                                        <td class="ps-4 text-muted small">{{ $item->nik }}</td>
                                        <td class="fw-semibold text-dark">{{ $item->nama_lengkap }}</td>
                                        <td>
                                            <span class="badge {{ $item->jenis_kelamin == 'L' ? 'bg-primary-subtle text-primary border border-primary-subtle' : 'bg-danger-subtle text-danger border border-danger-subtle' }} rounded-pill">
                                                {{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                            </span>
                                        </td>
                                        <td class="pe-4 text-secondary">{{ optional($item->lingkungan)->nama }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted small">Belum ada data penduduk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 7. INFORMASI WILAYAH & SISTEM --}}
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h5 class="fw-bold mb-0 text-dark">Informasi Wilayah</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-4 d-flex align-items-center gap-3">
                                <div class="bg-primary text-white rounded-3 p-3">
                                    <i class="fa-solid fa-map-location-dot fs-4"></i>
                                </div>
                                <div>
                                    <small class="text-muted text-uppercase d-block" style="font-size: 10px;">Lingkungan</small>
                                    <h4 class="fw-bold text-dark mb-0">4</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-success bg-opacity-10 p-3 rounded-4 d-flex align-items-center gap-3">
                                <div class="bg-success text-white rounded-3 p-3">
                                    <i class="fa-solid fa-road fs-4"></i>
                                </div>
                                <div>
                                    <small class="text-muted text-uppercase d-block" style="font-size: 10px;">RT</small>
                                    <h4 class="fw-bold text-dark mb-0">16</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-warning bg-opacity-10 p-3 rounded-4 d-flex align-items-center gap-3">
                                <div class="bg-warning text-white rounded-3 p-3">
                                    <i class="fa-solid fa-sitemap fs-4"></i>
                                </div>
                                <div>
                                    <small class="text-muted text-uppercase d-block" style="font-size: 10px;">RW</small>
                                    <h4 class="fw-bold text-dark mb-0">4</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 small">
                        <div class="col-6">
                            <div class="d-flex justify-content-between py-1 border-bottom"><span class="text-muted">Kelurahan</span> <strong>Bongki</strong></div>
                            <div class="d-flex justify-content-between py-1 border-bottom"><span class="text-muted">Kecamatan</span> <strong>Sinjai Utara</strong></div>
                            <div class="d-flex justify-content-between py-1"><span class="text-muted">Kabupaten</span> <strong>Sinjai</strong></div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex justify-content-between py-1 border-bottom"><span class="text-muted">Provinsi</span> <strong>Sulawesi Selatan</strong></div>
                            <div class="d-flex justify-content-between py-1 border-bottom"><span class="text-muted">Status</span> <span class="badge bg-success">Aktif</span></div>
                            <div class="d-flex justify-content-between py-1"><span class="text-muted">Versi</span> <strong>SIPBongki v2.0</strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h5 class="fw-bold mb-0 text-dark">Informasi Sistem</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex flex-column gap-2.5 small">
                        <div class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Framework</span> <strong>Laravel 12</strong></div>
                        <div class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">PHP Version</span> <strong>8.2</strong></div>
                        <div class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Database</span> <strong>MariaDB / MySQL</strong></div>
                        <div class="d-flex justify-content-between py-2"><span class="text-muted">UI Framework</span> <strong>Bootstrap 5.3</strong></div>
                    </div>
                </div>
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
                    backgroundColor: ['#2563EB', '#10B981', '#F59B0B', '#EF4444'],
                    borderRadius: 8,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
            }
        });
    }

    const chartJK = @json($chartJK);
    const pendudukCanvas = document.getElementById('chartPenduduk');

    if (pendudukCanvas && chartJK) {
        new Chart(pendudukCanvas, {
            type: 'doughnut',
            data: {
                labels: chartJK.labels,
                datasets: [{
                    data: chartJK.data,
                    backgroundColor: ['#2563EB', '#EC4899'],
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
                        labels: { usePointStyle: true, padding: 20 }
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