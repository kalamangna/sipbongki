@extends('layouts.public')

@section('title', $pageMode === 'status' ? 'Status Permohonan' : 'Permohonan Berhasil')

@section('content')

@php
    $isStatusMode = $pageMode === 'status';
@endphp

<div class="container py-5 mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm shadow-sm border-0">
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm-body text-center">
                    @if(session('success'))
                        <div class="alert alert-success text-start">
                            <strong>{{ session('success') }}</strong>
                        </div>
                    @endif
                    <div class="mb-4">
                        <div class="display-4 {{ $isStatusMode ? 'text-info' : 'text-success' }}">
                            {{ $isStatusMode ? '↻' : '✓' }}
                        </div>
                        <h2 class="fw-bold">{{ $isStatusMode ? 'Status Permohonan' : 'Permohonan Berhasil' }}</h2>
                        <p class="text-muted mb-0">
                            {{ $isStatusMode
                                ? 'Berikut adalah status terkini pengajuan surat Anda.'
                                : 'Permohonan Anda telah dikirim dan sedang menunggu proses verifikasi.'
                            }}
                        </p>
                    </div>

                    @php
                        $pemohon = $permohonanSurat->penduduk;
                        $namaPemohon = $pemohon?->nama_lengkap
                            ?? data_get($permohonanSurat->data_surat, 'nama_pemohon')
                            ?? data_get($permohonanSurat->data_surat, 'nama_lengkap')
                            ?? '-';
                        $nikPemohon = $pemohon?->nik
                            ?? data_get($permohonanSurat->data_surat, 'nik')
                            ?? '-';
                    @endphp

                    <div class="row gx-3 gy-3 text-center">
                        <div class="col-12">
                            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm border rounded-3 p-4 p-md-5">
                                <div class="row g-3 align-items-stretch text-center">
                                    <div class="col-md-6">
                                        <div class="border rounded-3 p-3 h-100 bg-light-subtle d-flex flex-column justify-content-center align-items-center">
                                            <small class="text-uppercase text-muted d-block mb-1">Nomor Pengajuan</small>
                                            <div class="fw-bold text-primary mb-0 fs-6">{{ $permohonanSurat->nomor_permohonan }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="border rounded-3 p-3 h-100 bg-light-subtle d-flex flex-column justify-content-center align-items-center">
                                            <small class="text-uppercase text-muted d-block mb-1">Jenis Layanan</small>
                                            <div class="fw-bold text-primary mb-0 fs-6">{{ $permohonanSurat->jenisSurat->nama }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="border rounded-3 p-3 h-100 bg-light-subtle d-flex flex-column justify-content-center align-items-center">
                                            <small class="text-uppercase text-muted d-block mb-1">Nama Pemohon</small>
                                            <div class="fw-bold text-primary mb-0 fs-6">{{ $namaPemohon }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="border rounded-3 p-3 h-100 bg-light-subtle d-flex flex-column justify-content-center align-items-center">
                                            <small class="text-uppercase text-muted d-block mb-1">NIK Pemohon</small>
                                            <div class="fw-bold text-primary mb-0 fs-6">{{ $nikPemohon }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="border rounded-3 p-3 h-100 bg-light-subtle d-flex flex-column justify-content-center align-items-center">
                                            <small class="text-uppercase text-muted d-block mb-1">Tanggal & Waktu Pengajuan</small>
                                            <div class="mb-0">
                                                {{ $permohonanSurat->tanggal_permohonan?->setTimezone('Asia/Makassar')->translatedFormat('l, j F Y, H:i') }} WITA
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="border rounded-3 p-3 h-100 bg-light-subtle d-flex flex-column justify-content-center align-items-center">
                                            <small class="text-uppercase text-muted d-block mb-1">Status</small>
                                            <div class="mb-0">
                                                @php
                                                    $status = $permohonanSurat->status;
                                                    $badge = match($status) {
                                                        'Menunggu' => 'warning text-dark',
                                                        'Diproses' => 'info text-white',
                                                        'Selesai' => 'success',
                                                        'Ditolak' => 'danger',
                                                        default => 'secondary',
                                                    };
                                                @endphp
                                                <span class="badge bg-{{ explode(' ', $badge)[0] }} {{ explode(' ', $badge)[1] ?? '' }}">
                                                    {{ $status }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @php
                                    $status = $permohonanSurat->status;
                                    $hasNote = !empty($permohonanSurat->catatan);
                                    $statusAlertClass = match($status) {
                                        'Selesai' => 'alert-success',
                                        'Ditolak' => 'alert-danger',
                                        'Diproses' => 'alert-info',
                                        'Menunggu' => 'alert-warning',
                                        default => 'alert-info',
                                    };

                                    $submittedText = match($status) {
                                        'Selesai' => 'Permohonan Anda telah selesai. Silakan datang ke kantor Kelurahan Bongki untuk mengambil Surat Keterangan yang telah dibuat.',
                                        'Ditolak' => 'Permohonan Anda telah dikirim namun ditolak. Silakan hubungi petugas Kelurahan untuk detail alasan penolakan.',
                                        'Diproses' => 'Permohonan Anda berhasil dikirim dan sedang diproses oleh petugas Kelurahan. Mohon tunggu informasi lebih lanjut.',
                                        'Menunggu' => 'Permohonan Anda berhasil dikirim dan sedang menunggu verifikasi awal oleh petugas Kelurahan.',
                                        default => 'Permohonan Anda berhasil dikirim. Simpan nomor pengajuan dan cek status secara berkala.',
                                    };

                                    $statusModeText = match($status) {
                                        'Selesai' => 'Permohonan Anda telah selesai. Silakan datang ke kantor Kelurahan Bongki untuk mengambil Surat Keterangan yang telah dibuat.',
                                        'Ditolak' => 'Mohon maaf, permohonan Anda ditolak. Silakan hubungi petugas Kelurahan untuk informasi lebih lanjut.',
                                        'Diproses' => 'Permohonan Anda sedang diproses oleh petugas Kelurahan. Mohon cek kembali nanti untuk perkembangan status.',
                                        'Menunggu' => 'Permohonan Anda masih menunggu verifikasi awal dari petugas Kelurahan. Silakan cek kembali dalam beberapa waktu.',
                                        default => 'Simpan nomor pengajuan ini untuk mengecek perkembangan permohonan Anda.',
                                    };

                                    $noteText = $hasNote
                                        ? 'Catatan petugas tersedia di bawah. Bacalah instruksi berikut untuk melengkapi berkas atau mempercepat proses.'
                                        : '';

                                    $alertText = $isStatusMode && $hasNote
                                        ? $noteText
                                        : ($isStatusMode ? $statusModeText : $submittedText);
                                @endphp

                                <div class="alert {{ $statusAlertClass }} mt-4 mb-0 text-center">
                                    {{ $alertText }}
                                </div>

                                @if(!empty($permohonanSurat->catatan))
                                    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm border rounded-3 mt-4 p-3 bg-light">
                                        <div class="text-dark" style="text-align: justify;">
                                            {!! nl2br(e($permohonanSurat->catatan)) !!}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
