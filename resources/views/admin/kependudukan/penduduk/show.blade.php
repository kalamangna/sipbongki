@extends('layouts.admin')

@section('title', 'Detail Penduduk')

@push('styles')
<style>
.penduduk-detail .fw-bold,
.penduduk-detail .fw-semibold,
.penduduk-detail strong,
.penduduk-detail h3,
.penduduk-detail h5 {
    font-weight:600 !important;
}

.penduduk-detail .card-header h5,
.penduduk-detail .card-body h5.fw-bold {
    font-size: 0.9rem;
    margin-bottom: 0;
}

.penduduk-detail .card-header i,
.penduduk-detail .card-body h5.fw-bold .bi {
    font-size: 0.9rem;
}

.penduduk-detail .card-header .bi,
.penduduk-detail .card-body h5.fw-bold .bi {
    vertical-align: -0.15em;
}

.penduduk-detail .card-body .row > * {
    display: block;
}

.penduduk-detail .card-body .row > * > label,
.penduduk-detail .card-body .row > * > .form-label {
    display: block;
    width: 100%;
    margin-bottom: 0.25rem;
    white-space: normal;
    font-size: 0.95rem;
    color: #212529;
}

.penduduk-detail .card-body .row > * .fw-semibold,
.penduduk-detail .card-body .row > * .text-muted,
.penduduk-detail .card-body .row > * .badge {
    display: block;
    color: #212529;
    font-weight: 600 !important;
    margin-bottom: 1rem;
}

.penduduk-detail .btn,
.penduduk-detail .btn.btn-secondary,
.penduduk-detail .btn.btn-warning,
.penduduk-detail .btn.btn-danger {
    font-size: 0.8rem;
    padding: 0.35rem 0.75rem;
}

.penduduk-detail .btn i {
    margin-right: 0.25rem;
    font-size: 0.85rem;
}

@media (max-width: 767.98px) {
    .penduduk-detail .card-body .row > [class*="col-"] {
        display: block;
    }

    .penduduk-detail .card-body label {
        display: block;
        width: 100%;
        white-space: normal;
        margin-bottom: 0.25rem;
    }
}
</style>
@endpush

@section('content')

<div class="container-fluid penduduk-detail">

    {{-- ==========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="flex justify-between items-center mb-4">

        <div>

            <p class="text-slate-500 mb-0">
                Informasi Detail Penduduk
            </p>

        </div>

        <div class="flex gap-2">

            <a
                href="{{ route('admin.penduduk.index') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary">

                <i class="bi bi-arrow-left"></i>
                Kembali

            </a>

            <a
                href="{{ route('admin.penduduk.edit', $penduduk) }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-amber-500 text-white hover:bg-amber-600 shadow-sm">

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
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm"
                    onclick="return confirm('Yakin ingin menghapus data penduduk ini?')">

                    <i class="bi bi-trash"></i>
                    Hapus

                </button>

            </form>

        </div>

    </div>

    {{-- ==========================================================
        IDENTITAS
    ========================================================== --}}

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-2">

        <div class="px-6 py-4 border-b border-slate-200 bg-white">

            <h5 class="font-bold mb-0">

Identitas Penduduk :

        <div class="p-6">

            <div class="flex flex-wrap -mx-3">

                <div class="col-md-12 mb-2">

                    <label class="form-label text-slate-500">
                        Nomor Induk Kependudukan :
                    </label>

                    <div class="fw-semibold">
                        {{ $penduduk->nik }}
                    </div>

                </div>

                <div class="col-md-4 mb-2">

                    <label class="form-label text-slate-500">
                        Nama Lengkap :
                    </label>

                    <div class="fw-semibold">
                        {{ $penduduk->nama_lengkap }}
                    </div>

                </div>

                <div class="col-md-4 mb-2">

                    <label class="form-label text-slate-500">
                        Jenis Kelamin :
                    </label>

                    <div class="fw-semibold">

                        @gender($penduduk->jenis_kelamin)

                    </div>

                </div>

                <div class="col-md-4 mb-2">

                    <label class="form-label text-slate-500">
                        Tempat Lahir :
                    </label>

                    <div class="fw-semibold">
                        {{ $penduduk->tempat_lahir }}
                    </div>

                </div>

                <div class="col-md-4 mb-2">

                    <label class="form-label text-slate-500">
                        Tanggal Lahir :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->tanggal_lahir->locale('id')->translatedFormat('d F Y') }}

                    </div>

                </div>

                <div class="col-md-4 mb-2">

                    <label class="form-label text-slate-500">
                        Agama :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->agama ?: '-' }}

                    </div>

                </div>

                <div class="col-md-4 mb-2">

                    <label class="form-label text-slate-500">
                        Status Perkawinan :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->status_perkawinan ?: '-' }}

                    </div>

                </div>

                <div class="col-md-4 mb-2">

                    <label class="form-label text-slate-500">
                        Pendidikan :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->pendidikan ?: '-' }}

                    </div>

                </div>

                <div class="col-md-4 mb-2">

                    <label class="form-label text-slate-500">
                        Pekerjaan :
                    </label>

                    <div class="fw-semibold">

                        {{ $penduduk->pekerjaan ?: '-' }}

                    </div>

                </div>

            </div>

            <hr class="my-4">

            <div class="mb-6">
                <div class="flex flex-wrap -mx-3">

                    <div class="col-md-4 mb-2">

                        <label class="form-label text-slate-500">
                            Nomor Kartu Keluarga :
                        </label>

                        <div class="fw-semibold">
                            {{ $penduduk->kartuKeluarga->no_kk ?? '-' }}
                        </div>

                    </div>

                    <div class="col-md-4 mb-2">

                        <label class="form-label text-slate-500">
                            Kepala Keluarga :
                        </label>

                        <div class="fw-semibold">
                            {{ $penduduk->kartuKeluarga->kepalaKeluarga->nama_lengkap ?? '-' }}
                        </div>

                    </div>

                    <div class="col-md-4 mb-2">

                        <label class="form-label text-slate-500">
                            Hubungan Dalam Keluarga :
                        </label>

                        <div class="fw-semibold">
                            {{ $penduduk->hubungan_keluarga ?: '-' }}
                        </div>

                    </div>

                    <div class="col-md-12 mb-2">

                        <label class="form-label text-slate-500">
                            Anggota Keluarga :
                        </label>

                        <div class="fw-semibold">

                            @if($penduduk->kartuKeluarga)

                                @php
                                    $anggota = $penduduk->kartuKeluarga->penduduks
                                        ->reject(fn ($item) => $item->id == $penduduk->id);
                                @endphp

                                @if($anggota->count())

                                    <ul class="list-unstyled mb-0 ps-0">

                                        @foreach($anggota as $item)

                                            <li>
                                                {{ $item->nama_lengkap }}
                                                <small class="text-slate-500">
                                                    ({{ $item->hubungan_keluarga }})
                                                </small>
                                            </li>

                                        @endforeach

                                    </ul>

                                @else

                                    <span class="text-slate-500">
                                        Belum ada anggota keluarga.
                                    </span>

                                @endif

                            @else

                                -

                            @endif

                        </div>

                    </div>

                </div>
            </div>

            <hr class="my-4">

            <div class="mb-6">
                <div class="flex flex-wrap -mx-3 justify-end">

                    <div class="col-md-3 mb-2">

                        <label class="form-label text-slate-500">
                            Alamat :
                        </label>

                        <div class="fw-semibold">
                            {{ $penduduk->alamat ?: '-' }}
                        </div>

                    </div>

                    <div class="col-md-3 mb-2">

                        <label class="form-label text-slate-500">
                            Lingkungan :
                        </label>

                        <div class="fw-semibold">
                            {{ $penduduk->lingkungan->nama ?? '-' }}
                        </div>

                    </div>

                    <div class="col-md-3 mb-2">

                        <label class="form-label text-slate-500">
                            RT :
                        </label>

                        <div class="fw-semibold">
                            {{ $penduduk->rt ?: '-' }}
                        </div>

                    </div>

                    <div class="col-md-3 mb-2">

                        <label class="form-label text-slate-500">
                            RW :
                        </label>

                        <div class="fw-semibold">
                            {{ $penduduk->rw ?: '-' }}
                        </div>

                    </div>

                    <div class="col-md-12 mb-2">

                        <label class="form-label text-slate-500">
                            Status Validasi Alamat
                        </label>

                        <div>

                            @if($penduduk->status_validasi_alamat == 'Valid')

                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                                    Valid
                                </span>

                            @else

                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700 text-dark">
                                    Perlu Verifikasi
                                </span>

                            @endif

                        </div>

                    </div>

                </div>
            </div>

            <hr class="my-4">

            <div class="mb-0">
                <div class="flex flex-wrap -mx-3">

                    <div class="col-md-4 mb-2">

                        <label class="form-label text-slate-500">
                            Nomor Telepon :
                        </label>

                        <div class="fw-semibold">
                            {{ $penduduk->telepon ?: '-' }}
                        </div>

                    </div>

                    <div class="col-md-4 mb-2">

                        <label class="form-label text-slate-500">
                            Email
                        </label>

                        <div class="fw-semibold">
                            {{ $penduduk->email ?: '-' }}
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>


</div>

@endsection