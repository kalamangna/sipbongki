@extends('layouts.operator')

@section('title','Detail Laporan Kartu Keluarga')

@section('subtitle','Informasi laporan kartu keluarga dan anggota keluarga')

@section('content')

<div class="dashboard-container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">Detail Laporan Kartu Keluarga</h4>
            <p class="text-muted mb-0">Informasi detail Kartu Keluarga khusus dari laporan.</p>
        </div>

        <a href="{{ route('operator.laporan.kartu-keluarga') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-2"></i>
            Kembali ke Laporan
        </a>

    </div>

    <div class="card dashboard-card mb-4">
        <div class="card-header">
            <h5 class="fw-bold mb-0">Data Kartu Keluarga</h5>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="text-muted">Nomor KK</label>
                    <h6 class="fw-bold">{{ $kartuKeluarga->no_kk }}</h6>
                </div>
                <div class="col-md-6">
                    <label class="text-muted">Kepala Keluarga</label>
                    <h6 class="fw-bold">{{ optional($kartuKeluarga->kepalaKeluarga)->nama_lengkap ?? '-' }}</h6>
                </div>
                <div class="col-md-6">
                    <label class="text-muted">Lingkungan</label>
                    <h6>{{ optional($kartuKeluarga->lingkungan)->nama ?? '-' }}</h6>
                </div>
                <div class="col-md-6">
                    <label class="text-muted">RT / RW</label>
                    <h6>{{ $kartuKeluarga->rt ?? '00' }} / {{ $kartuKeluarga->rw ?? '00' }}</h6>
                </div>
                <div class="col-md-12">
                    <label class="text-muted">Alamat</label>
                    <p>{{ $kartuKeluarga->alamat ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card dashboard-card">
        <div class="card-header">
            <h5 class="fw-bold mb-0 text-center">Anggota Keluarga</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 text-center table-normal-case">
                    <thead>
                        <tr>
                            <th style="text-transform: capitalize !important; text-align: center;">No.</th>
                            <th style="text-transform: uppercase !important; text-align: center;">NIK</th>
                            <th style="text-transform: capitalize !important; text-align: center;">Nama Lengkap</th>
                            <th style="text-transform: capitalize !important; text-align: center;">Tempat, Tanggal Lahir</th>
                            <th style="text-transform: capitalize !important; text-align: center;">Hubungan</th>
                            <th style="text-transform: capitalize !important; text-align: center;">Jenis Kelamin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kartuKeluarga->anggota as $anggota)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $anggota->nik }}</td>
                            <td>{{ $anggota->nama_lengkap }}</td>
                            <td>
                                {{ $anggota->tempat_lahir ?? '-' }},
                                {{ $anggota->tanggal_lahir
                                    ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->translatedFormat('d F Y')
                                    : '-' }}
                            </td>
                            <td>{{ $anggota->hubungan_keluarga ?? '-' }}</td>
                            <td>@gender($anggota->jenis_kelamin)</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Belum ada anggota keluarga.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
