@extends('layouts.admin')

@section('title', 'Detail Kartu Keluarga')

@section('content')

<div class="container-fluid">

    <div class="flex justify-between mb-4">

        <div>
           
            <p class="text-slate-500">
                Informasi Detail Kartu Keluarga dan Anggota Keluarga
            </p>
        </div>

        <div class="flex gap-2">
            <a
                href="{{ route('admin.kartu-keluarga.index') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary">

                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

            <a
                href="{{ route('admin.kartu-keluarga.edit', $kartuKeluarga) }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-amber-500 text-white hover:bg-amber-600 shadow-sm">

                <i class="bi bi-pencil-square"></i>
                Edit
            </a>

            <form
                action="{{ route('admin.kartu-keluarga.destroy', $kartuKeluarga) }}"
                method="POST"
                class="d-inline">

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm"
                    onclick="return confirm('Yakin ingin menghapus data kartu keluarga ini?')">

                    <i class="bi bi-trash"></i>
                    Hapus
                </button>

            </form>
        </div>

    </div>

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-4">
        <div class="p-6">

            <div class="flex flex-wrap -mx-3">

                <div class="w-full md:w-1/2 px-3 mb-4">
                    <strong>No. Kartu Keluarga :</strong>
                    <br>
                    {{ $kartuKeluarga->no_kk }}
                </div>

                <div class="w-full md:w-1/2 px-3 mb-4">
    <strong>Kepala Keluarga :</strong>
    <br>

    <div>{{ $kartuKeluarga->kepalaKeluarga->nama_lengkap ?? '-' }}</div>

    <small class="text-slate-500">
        {{ $kartuKeluarga->kepalaKeluarga->tempat_lahir ?? '-' }},
        {{ $kartuKeluarga->kepalaKeluarga?->tanggal_lahir
            ? \Carbon\Carbon::parse($kartuKeluarga->kepalaKeluarga->tanggal_lahir)->translatedFormat('d F Y')
            : '-' }}
    </small>
</div>
        

                <div class="w-full md:w-1/2 px-3 mb-4">
                    <strong>Lingkungan :</strong>
                    <br>
                    {{ $kartuKeluarga->lingkungan->nama ?? '-' }}
                </div>

                <div class="w-full md:w-1/2 px-3 mb-4">
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

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

        <div class="px-6 py-4 border-b border-slate-200 bg-white">
            <h6 class="mb-0">
                Anggota Keluarga :
            </h6>
        </div>

        <div class="p-6 p-0">

            <div class="overflow-x-auto w-full">

                <table class="w-full text-left border-collapse text-sm table-hover mb-0">

                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tempat, Tanggal Lahir</th>
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
        {{ $anggota->tempat_lahir ?? '-' }},
        {{ $anggota->tanggal_lahir
            ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->translatedFormat('d F Y')
            : '-' }}
    </td>

    <td>{{ $anggota->hubungan_keluarga ?? '-' }}</td>

    <td>
        @gender($anggota->jenis_kelamin)
    </td>

</tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center py-4">
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