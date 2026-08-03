@extends('layouts.admin')

@section('title', 'Detail Pengaduan')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="fw-bold mb-1">
                Detail Pengaduan
            </h4>

            <p class="text-muted mb-0">
                Informasi lengkap laporan masyarakat.
            </p>

        </div>

        <a href="{{ route('admin.pengaduan.index') }}"
           class="btn btn-secondary">

            <i class="fa-solid fa-arrow-left"></i>
            Kembali

        </a>

    </div>

    <div class="row">

        {{-- Informasi Pengaduan --}}
        <div class="col-lg-8">

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Informasi Pengaduan
                    </h5>

                </div>

                <div class="card-body">

                    <table class="table table-borderless">

                        <tr>
                            <th width="220">Kode Pengaduan</th>
                            <td>{{ $pengaduan->kode }}</td>
                        </tr>

                        <tr>
                            <th>Nama Pelapor</th>
                            <td>{{ $pengaduan->nama }}</td>
                        </tr>

                        <tr>
                            <th>No. WhatsApp</th>
                            <td>{{ $pengaduan->telepon }}</td>
                        </tr>

                        <tr>
                            <th>Alamat</th>
                            <td>{{ $pengaduan->alamat }}</td>
                        </tr>

                        <tr>
                            <th>Kategori</th>
                            <td>{{ $pengaduan->kategori }}</td>
                        </tr>

                        <tr>
                            <th>Lokasi Kejadian</th>
                            <td>{{ $pengaduan->lokasi }}</td>
                        </tr>

                        <tr>
                            <th>Tanggal Laporan</th>
                            <td>

                                {{ $pengaduan->created_at->timezone('Asia/Makassar')->format('d F Y H:i') }} WITA

                                <br>

                                <small class="text-muted">

                                    {{ $pengaduan->created_at->format('H:i') }} WITA

                                </small>

                            </td>
                        </tr>

                    </table>

                </div>

            </div>

            {{-- Uraian --}}
            <div class="card shadow-sm border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        Uraian Pengaduan

                    </h5>

                </div>

                <div class="card-body">

                    {!! nl2br(e($pengaduan->uraian)) !!}

                </div>

            </div>

        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4">

            {{-- Foto --}}
            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        Foto Bukti

                    </h5>

                </div>

                <div class="card-body text-center">

                    @if($pengaduan->foto)

                        <img
                            src="{{ asset('storage/'.$pengaduan->foto) }}"
                            class="img-fluid rounded shadow-sm">

                    @else

                        <div class="text-muted py-5">

                            <i class="fa-solid fa-image fs-1 d-block mb-3"></i>

                            Tidak ada foto.

                        </div>

                    @endif

                </div>

            </div>

            {{-- Status --}}
            <div class="card shadow-sm border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        Status Penanganan

                    </h5>

                </div>

                <div class="card-body">

                    <form
                        action="{{ route('admin.pengaduan.update',$pengaduan) }}"
                        method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">

                            <label class="form-label">

                                Status

                            </label>

                            <select
                                name="status"
                                class="form-select">

                                <option
                                    value="Baru"
                                    @selected($pengaduan->status=='Baru')>

                                    Baru

                                </option>

                                <option
                                    value="Diproses"
                                    @selected($pengaduan->status=='Diproses')>

                                    Diproses

                                </option>

                                <option
                                    value="Selesai"
                                    @selected($pengaduan->status=='Selesai')>

                                    Selesai

                                </option>

                            </select>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Catatan Petugas

                            </label>

                            <textarea
                                name="catatan"
                                rows="5"
                                class="form-control">{{ old('catatan',$pengaduan->catatan) }}</textarea>

                        </div>

                        <button
                            class="btn btn-success w-100">

                            <i class="fa-solid fa-circle-check"></i>

                            Simpan Perubahan

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection