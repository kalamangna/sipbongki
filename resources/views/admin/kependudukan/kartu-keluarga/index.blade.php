@extends('layouts.admin')

@section('title', 'Data Kartu Keluarga')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <p class="text-muted mb-0">
                Kelola Data Kartu Keluarga
            </p>
        </div>

        <a href="{{ route('admin.kartu-keluarga.create') }}"
           class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Kartu Keluarga
        </a>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
    <tr>
        <th style="width:5%">No</th>
        <th style="width:20%">No. KK</th>
        <th style="width:18%">Kepala Keluarga</th>
        <th style="width:15%">Lingkungan</th>
        <th style="width:10%">RT/RW</th>
        <th style="width:12%">Jumlah Anggota</th>
        <th style="width:10%">Status</th>
        <th style="width:10%" class="text-center">Aksi</th>
    </tr>
</thead>

                    <tbody>

                    @forelse($kartuKeluargas as $kk)

                        <tr>

                            <td>
                                {{ ($kartuKeluargas->firstItem() ?? 0) + $loop->index }}
                            </td>

                            <td class="text-nowrap">
                                <strong>{{ $kk->no_kk }}</strong>
                            </td>

                            <td>
                                {{ $kk->kepalaKeluarga->nama_lengkap ?? '-' }}
                            </td>

                            <td>
                                {{ $kk->lingkungan->nama ?? '-' }}
                            </td>

                            <td class="text-nowrap">
                                {{ $kk->rt ?? '00' }}/{{ $kk->rw ?? '00' }}
                            </td>

                            <td>
                                <span class="badge bg-info">
                                    {{ $kk->anggota->count() }} Orang
                                </span>
                            </td>

                            <td>

                                @if($kk->aktif)

                                    <span class="badge bg-success">
                                        Aktif
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Tidak Aktif
                                    </span>

                                @endif

                            </td>

                            <td class="text-center">

                                <div class="action-buttons">

                                    <a href="{{ route('admin.kartu-keluarga.show',$kk->id) }}"
                                       class="btn btn-info"
                                       title="Detail">

                                        <i class="bi bi-eye"></i>

                                    </a>

                                    <a href="{{ route('admin.kartu-keluarga.edit',$kk->id) }}"
                                       class="btn btn-warning"
                                       title="Edit">

                                        <i class="bi bi-pencil"></i>

                                    </a>

                                    <form action="{{ route('admin.kartu-keluarga.destroy',$kk->id) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger"
                                            onclick="return confirm('Hapus data kartu keluarga?')">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8" class="text-center py-5 text-muted">

                                Belum ada data kartu keluarga.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    @if($kartuKeluargas->hasPages())

        <div class="mt-3">

            {{ $kartuKeluargas->links() }}

        </div>

    @endif

</div>

@endsection