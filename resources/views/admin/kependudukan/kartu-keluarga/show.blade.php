@extends('layouts.admin')

@section('title', 'Detail Kartu Keluarga')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">

        <div>
           
            <p class="text-muted">
                Informasi Detail Kartu Keluarga dan Anggota Keluarga
            </p>
        </div>

        <a
            href="{{ route('admin.kartu-keluarga.index') }}"
            class="btn btn-secondary">

            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>

    </div>

    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <strong>No. Kartu Keluarga :</strong>
                    <br>
                    {{ $kartuKeluarga->no_kk }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Kepala Keluarga :</strong>
                    <br>
                    {{ $kartuKeluarga->kepalaKeluarga->nama_lengkap ?? '-' }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Lingkungan :</strong>
                    <br>
                    {{ $kartuKeluarga->lingkungan->nama ?? '-' }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>RT/RW :</strong>
                    <br>
                    {{ $kartuKeluarga->rt ?? '00' }}/{{ $kartuKeluarga->rw ?? '00' }}
                </div>

                <div class="col-md-12">
                    <strong>Alamat :</strong>
                    <br>
                    {{ $kartuKeluarga->alamat ?? '-' }}
                </div>

            </div>

        </div>
    </div>

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">
            <h6 class="mb-0">
                Anggota Keluarga :
            </h6>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Hubungan</th>
                            <th>Jenis Kelamin</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($kartuKeluarga->anggota as $anggota)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $anggota->nik }}</td>

                                <td>{{ $anggota->nama_lengkap }}</td>

                                <td>
                                    {{ $anggota->hubungan_keluarga ?? '-' }}
                                </td>

                                <td>
                                    {{ $anggota->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    Belum ada anggota keluarga.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection