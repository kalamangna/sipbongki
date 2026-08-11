@extends('layouts.operator')

@section('title','Detail Laporan Persuratan')

@section('subtitle','Informasi detail permohonan surat khusus dari laporan')

@section('content')

<div class="dashboard-container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Detail Laporan Persuratan</h4>
            <p class="text-muted mb-0">Informasi detail permohonan surat khusus dari laporan.</p>
        </div>

        <a href="{{ route('operator.laporan.persuratan') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-2"></i>
            Kembali
        </a>
    </div>

    <div class="card dashboard-card mb-4">
        <div class="card-header">
            <h5 class="fw-bold mb-0">Data Permohonan</h5>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="text-muted">Nomor Permohonan</label>
                    <h6 class="fw-bold">{{ $permohonanSurat->nomor_permohonan ?? '-' }}</h6>
                </div>
                <div class="col-md-6">
                    <label class="text-muted">Nomor Surat</label>
                    <h6>{{ $permohonanSurat->nomor_surat ?? 'Belum diterbitkan' }}</h6>
                </div>
                <div class="col-md-6">
                    <label class="text-muted">Jenis Surat</label>
                    <h6>{{ optional($permohonanSurat->jenisSurat)->nama ?? '-' }}</h6>
                </div>
                <div class="col-md-6">
                    <label class="text-muted">Status</label>
                    <h6><span class="badge bg-{{ $permohonanSurat->status_badge_class }}">{{ $permohonanSurat->status }}</span></h6>
                </div>
                <div class="col-md-6">
                    <label class="text-muted">Nama Pemohon</label>
                    <h6>{{ optional($permohonanSurat->penduduk)->nama_lengkap ?? '-' }}</h6>
                </div>
                <div class="col-md-6">
                    <label class="text-muted">NIK</label>
                    <h6>{{ optional($permohonanSurat->penduduk)->nik ?? '-' }}</h6>
                </div>
                <div class="col-md-6">
                    <label class="text-muted">Tanggal Permohonan</label>
                    <h6>{{ $permohonanSurat->tanggal_permohonan ? $permohonanSurat->tanggal_permohonan->translatedFormat('d F Y') : '-' }}</h6>
                </div>
                <div class="col-md-6">
                    <label class="text-muted">Penandatangan</label>
                    <h6>{{ optional($permohonanSurat->penandatangan)->nama_lengkap ?? '-' }}</h6>
                </div>
                <div class="col-12">
                    <label class="text-muted">Keperluan</label>
                    <p>{{ $permohonanSurat->keperluan ?? '-' }}</p>
                </div>
                <div class="col-12">
                    <label class="text-muted">Alamat</label>
                    <p>{{ optional($permohonanSurat->penduduk)->alamat ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
