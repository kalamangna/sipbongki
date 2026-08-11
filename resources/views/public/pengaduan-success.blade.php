@extends('layouts.public')

@section('title', 'Pengaduan Berhasil')

@section('content')

<div class="container py-5 mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <div class="display-4 text-success">✓</div>
                        <h2 class="fw-bold">Pengaduan Berhasil Dikirim</h2>
                        <p class="text-muted mb-0">
                            Pengaduan Anda telah diterima dan akan diproses oleh petugas Kelurahan Bongki.
                        </p>
                    </div>

                    <div class="row gx-3 gy-3 text-center">
                        <div class="col-12">
                            <div class="card border rounded-3 p-4 p-md-5">
                                <div class="row g-3 align-items-stretch text-center">
                                    <div class="col-md-6">
                                        <div class="border rounded-3 p-3 h-100 bg-light-subtle d-flex flex-column justify-content-center align-items-center">
                                            <small class="text-uppercase text-muted d-block mb-1">Kode Pengaduan</small>
                                            <div class="fw-bold text-primary mb-0 fs-6">{{ $pengaduan->kode }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="border rounded-3 p-3 h-100 bg-light-subtle d-flex flex-column justify-content-center align-items-center">
                                            <small class="text-uppercase text-muted d-block mb-1">Status</small>
                                            <div class="mb-0">
                                                <span class="badge bg-danger">{{ $pengaduan->status }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="border rounded-3 p-3 h-100 bg-light-subtle d-flex flex-column justify-content-center align-items-center">
                                            <small class="text-uppercase text-muted d-block mb-1">Nama Pelapor</small>
                                            <div class="fw-bold text-primary mb-0 fs-6">{{ $pengaduan->nama }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="border rounded-3 p-3 h-100 bg-light-subtle d-flex flex-column justify-content-center align-items-center">
                                            <small class="text-uppercase text-muted d-block mb-1">NIK Pelapor</small>
                                            <div class="fw-bold text-primary mb-0 fs-6">{{ $pengaduan->nik_pelapor ?? '-' }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="border rounded-3 p-3 h-100 bg-light-subtle d-flex flex-column justify-content-center align-items-center">
                                            <small class="text-uppercase text-muted d-block mb-1">Nomor Telepon</small>
                                            <div class="fw-bold text-primary mb-0 fs-6">{{ $pengaduan->telepon }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="border rounded-3 p-3 h-100 bg-light-subtle d-flex flex-column justify-content-center align-items-center">
                                            <small class="text-uppercase text-muted d-block mb-1">Kategori</small>
                                            <div class="fw-bold text-primary mb-0 fs-6">{{ $pengaduan->kategori }}</div>
                                        </div>
                                    </div>
                                </div>

@if(!empty($pengaduan->catatan))
                                    <div class="alert alert-light border complaint-note-panel mt-4 mb-0 text-start">
                                        <div class="fw-bold text-success mb-2">Catatan Petugas</div>
                                        <div class="text-muted">
                                            {{ $pengaduan->catatan }}
                                        </div>
                                    </div>
                                @endif

                                <div class="alert alert-success mt-4 mb-0 text-center">
                                    Simpan kode pengaduan ini untuk mengecek perkembangan pengaduan Anda di kemudian hari.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
