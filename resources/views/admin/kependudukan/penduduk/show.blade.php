@extends('layouts.admin')

@section('title', 'Detail Penduduk')

@section('content')

<div class="container-fluid">

    {{-- ==========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>

           
            <p class="text-muted mb-0">
                Informasi Detail Penduduk
            </p>

        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route('admin.penduduk.index') }}"
                class="btn btn-secondary">

                <i class="bi bi-arrow-left"></i>
                Kembali

            </a>

            <a
                href="{{ route('admin.penduduk.edit', $penduduk) }}"
                class="btn btn-warning">

                <i class="bi bi-pencil-square"></i>
                Edit

            </a>

        </div>

    </div>

    {{-- ==========================================================
        PROFILE CARD
    ========================================================== --}}

    <div class="card shadow-sm border-0 mb-3">

        <div class="card-body">

            <div class="row align-items-center">

                <div class="col-lg-2 text-center">

                    @if($penduduk->foto)

                        <img
                            src="{{ asset('storage/'.$penduduk->foto) }}"
                            class="rounded-circle border shadow-sm"
                            width="140"
                            height="140"
                            style="object-fit:cover;">

                    @else

                        <div
                            class="rounded-circle bg-light d-inline-flex justify-content-center align-items-center border"
                            style="width:140px;height:140px;">

                            <i
                                class="bi bi-person-fill text-secondary"
                                style="font-size:70px;">
                            </i>

                        </div>

                    @endif

                </div>

                <div class="col-lg-6">

                    <h3 class="fw-bold mb-1">

                        {{ $penduduk->nama_lengkap }}

                    </h3>

                    <div class="row">

                        <div class="col-md-6 mb-2">

                            <small class="text-muted d-block">
                                Nomor Induk Kependudukan :
                            </small>

                            <strong>
                                {{ $penduduk->nik }}
                            </strong>

                        </div>

                        <div class="col-md-6 mb-2">

                            <small class="text-muted d-block">
                                Nomor Kartu Keluarga :
                            </small>

                            <strong>

                                {{ $penduduk->kartuKeluarga->no_kk ?? '-' }}

                            </strong>

                        </div>

                        <div class="col-md-6 mb-2">

                            <small class="text-muted d-block">
                                Lingkungan :
                            </small>

                            <strong>

                                {{ $penduduk->lingkungan->nama ?? '-' }}

                            </strong>

                        </div>

                        <div class="col-md-6 mb-2">

                            <small class="text-muted d-block">
                                Hubungan Dalam KK :
                            </small>

                            <strong>

                                {{ $penduduk->hubungan_keluarga ?? '-' }}

                            </strong>

                        </div>

                    </div>

                </div>

                <div class="col-lg-3 text-lg-end mt-2 mt-lg-0">

                    @if($penduduk->aktif)

                        <span class="badge bg-success px-4 py-3 fs-6">
                            Aktif
                        </span>

                    @else

                        <span class="badge bg-danger px-4 py-3 fs-6">
                            Tidak Aktif
                        </span>

                    @endif

                    <div class="mt-2">

                        @if($penduduk->status_validasi_alamat == 'Valid')

                            <span class="badge bg-success">

                                <i class="bi bi-patch-check-fill"></i>

                                Alamat Valid

                            </span>

                        @else

                            <span class="badge bg-warning text-dark">

                                <i class="bi bi-exclamation-circle-fill"></i>

                                Perlu Verifikasi

                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- ==========================================================
        INFORMASI IDENTITAS
    ========================================================== --}}

    <div class="card shadow-sm border-0 mb-2">

        <div class="card-header bg-white">

            <h5 class="fw-bold mb-0">

                <i class="bi bi-person-vcard me-1"></i>

                Informasi Identitas :

            </h5>

        </div>

        <div class="card-body">

            <div class="row">
                        <div class="card-body p-2">

                    <label class="form-label text-muted">
                        Nomor Induk Kependudukan :
                    </label>

                    <div class="fw-semibold">
                        {{ $penduduk->nik }}
                    </div>

                </div>

                <div class="col-md-4 mb-2">

                    <label class="form-label text-muted">
                        Nama Lengkap :
                    </label>

                    <div class="fw-semibold">
                        {{ $penduduk->nama_lengkap }}
                    </div>

                </div>

                <div class="col-md-4 mb-2">

                    <label class="form-label text-muted">
                        Jenis Kelamin :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}

                    </div>

                </div>

                <div class="col-md-4 mb-2">

                    <label class="form-label text-muted">
                        Tempat Lahir :
                    </label>

                    <div class="fw-semibold">
                        {{ $penduduk->tempat_lahir }}
                    </div>

                </div>

                <div class="col-md-4 mb-2">

                    <label class="form-label text-muted">
                        Tanggal Lahir :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->tanggal_lahir->format('d F Y') }}

                    </div>

                </div>

                <div class="col-md-4 mb-2">

                    <label class="form-label text-muted">
                        Agama :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->agama ?: '-' }}

                    </div>

                </div>

                <div class="col-md-4 mb-2">

                    <label class="form-label text-muted">
                        Status Perkawinan :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->status_perkawinan ?: '-' }}

                    </div>

                </div>

                <div class="col-md-4 mb-2">

                    <label class="form-label text-muted">
                        Pendidikan :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->pendidikan ?: '-' }}

                    </div>

                </div>

                <div class="col-md-4 mb-2">

                    <label class="form-label text-muted">
                        Pekerjaan :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->pekerjaan ?: '-' }}

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- ==========================================================
        INFORMASI KELUARGA
    ========================================================== --}}

    <div class="card shadow-sm border-0 mb-2">

        <div class="card-header bg-white">

            <h5 class="fw-bold mb-0">

                <i class="bi bi-people me-2"></i>

                Informasi Keluarga :

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="card-body p-2">

                    <label class="form-label text-muted">
                        Nomor Kartu Keluarga :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->kartuKeluarga->no_kk ?? '-' }}

                    </div>

                </div>

                <div class="col-md-6 mb-2">

                    <label class="form-label text-muted">
                        Hubungan Dalam Keluarga :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->hubungan_keluarga ?: '-' }}

                    </div>

                </div>

                <div class="col-md-6 mb-2">

                    <label class="form-label text-muted">
                        Kepala Keluarga :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->kartuKeluarga->kepalaKeluarga->nama_lengkap ?? '-' }}

                    </div>

                </div>

                <div class="col-md-5 mb-2">

                    <label class="form-label text-muted">
                        Jumlah Anggota Keluarga :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->kartuKeluarga ? $penduduk->kartuKeluarga->penduduks->count() : 0 }} Orang

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- ==========================================================
        INFORMASI ALAMAT
    ========================================================== --}}

    <div class="card shadow-sm border-0 mb-2">

        <div class="card-header bg-white">

            <h5 class="fw-bold mb-0">

                <i class="bi bi-geo-alt me-1"></i>

                Informasi Alamat :

            </h5>

        </div>

        <div class="card-body">

            <div class="row">
                           <div class="card-body p-1">

                    <label class="form-label text-muted">
                        Alamat :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->alamat ?: '-' }}

                    </div>

                </div>

                <div class="col-md-2 mb-2">

                    <label class="form-label text-muted">
                        RT :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->rt ?: '-' }}

                    </div>

                </div>

                <div class="col-md-2 mb-2">

                    <label class="form-label text-muted">
                        RW :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->rw ?: '-' }}

                    </div>

                </div>

                <div class="col-md-5 mb-2">

                    <label class="form-label text-muted">
                        Lingkungan :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->lingkungan->nama ?? '-' }}

                    </div>

                </div>

                <div class="col-md-6 mb-2">

                    <label class="form-label text-muted">
                        Status Validasi Alamat
                    </label>

                    <div>

                        @if($penduduk->status_validasi_alamat == 'Valid')

                            <span class="badge bg-success">

                                Valid

                            </span>

                        @else

                            <span class="badge bg-warning text-dark">

                                Perlu Verifikasi

                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- ==========================================================
        INFORMASI KONTAK
    ========================================================== --}}

    <div class="card shadow-sm border-0 mb-2">

        <div class="card-header bg-white">

            <h5 class="fw-bold mb-0">

                <i class="bi bi-telephone me-1"></i>

                Informasi Kontak :

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="card-body p-2">

                    <label class="form-label text-muted">
                        Nomor Telepon :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->telepon ?: '-' }}

                    </div>

                </div>

                <div class="col-md-6 mb-2">

                    <label class="form-label text-muted">
                        Email
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->email ?: '-' }}

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- ==========================================================
        INFORMASI SISTEM
    ========================================================== --}}

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <h5 class="fw-bold mb-0">

                <i class="bi bi-clock-history me-1"></i>

                Informasi Sistem

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="card-body p-2">

                    <label class="form-label text-muted">
                        Dibuat Pada Tanggal :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->created_at->format('d F Y H:i') }}

                    </div>

                </div>

                <div class="col-md-6 mb-2">

                    <label class="form-label text-muted">
                        Terakhir Diperbarui :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->updated_at->format('d F Y H:i') }}

                    </div>

                </div>

            </div>

        </div>

        <div class="card-footer bg-white d-flex justify-content-between">

            <a
                href="{{ route('admin.penduduk.index') }}"
                class="btn btn-secondary">

                <i class="bi bi-arrow-left"></i>

                Kembali

            </a>

            <div>

                <a
                    href="{{ route('admin.penduduk.edit', $penduduk) }}"
                    class="btn btn-warning">

                    <i class="bi bi-pencil-square"></i>

                    Edit

                </a>

                <form
                    action="{{ route('admin.penduduk.destroy', $penduduk) }}"
                    method="POST"
                    class="d-inline">

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-danger"
                        onclick="return confirm('Yakin ingin menghapus data penduduk ini?')">

                        <i class="bi bi-trash"></i>

                        Hapus

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection