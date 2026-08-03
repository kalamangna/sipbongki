@extends('layouts.admin')

@section('title', 'Data Lingkungan')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-1">

        <div>
            
            <p class="text-muted mb-0">
                Master Data Lingkungan Kelurahan Bongki
            </p>
        </div>

        <a href="{{ route('admin.lingkungan.create') }}"
            class="btn btn-primary">

            <i class="fa-solid fa-circle-plus"></i>

            Tambah Lingkungan

        </a>

    </div>

    
    <div class="card shadow-sm">

        <div class="card-header bg-white">

            <form method="GET">

                <div class="row g-2">

                    <div class="col-md-8">

                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            class="form-control"
                            placeholder="Cari nama lingkungan...">

                    </div>

                    <div class="col-auto">

                        <button class="btn btn-primary">

                            <i class="fa-solid fa-magnifying-glass"></i>

                            Cari

                        </button>

                    </div>

                    @if($search)

                    <div class="col-auto">

                        <a
                            href="{{ route('admin.lingkungan.index') }}"
                            class="btn btn-secondary">

                            Reset

                        </a>

                    </div>

                    @endif

                </div>

            </form>

        </div>

        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th width="70">No</th>

                        <th>Nama Lingkungan</th>

                        <th width="170" class="text-center">

                            Aksi

                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($lingkungans as $lingkungan)

                    <tr>

                        <td>

                            {{ $lingkungans->firstItem() + $loop->index }}

                        </td>

                        <td>

                            {{ $lingkungan->nama }}

                        </td>

                   <td class="text-center">

    <div class="action-buttons">

        <a
            href="{{ route('admin.lingkungan.edit',$lingkungan) }}"
            class="btn btn-warning btn-sm"
            title="Edit">

            <i class="fa-solid fa-pen"></i>

        </a>

        <button
            type="button"
            class="btn btn-danger btn-sm"
            title="Hapus"
            data-bs-toggle="modal"
            data-bs-target="#hapusModal{{ $lingkungan->id }}">

            <i class="fa-solid fa-trash"></i>

        </button>

    </div>

</td>  

                    </tr>

                    {{-- Modal Hapus --}}
                    <div
                        class="modal fade"
                        id="hapusModal{{ $lingkungan->id }}"
                        tabindex="-1"
                        aria-hidden="true">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title">

                                        Konfirmasi Hapus

                                    </h5>

                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal">
                                    </button>

                                </div>

                                <div class="modal-body">

                                    Apakah Anda yakin ingin menghapus
                                    <strong>{{ $lingkungan->nama }}</strong> ?

                                </div>

                                <div class="modal-footer">

                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal">

                                        Batal

                                    </button>

                                    <form
                                        action="{{ route('admin.lingkungan.destroy',$lingkungan) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="btn btn-danger">

                                            <i class="fa-solid fa-trash"></i>

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <tr>

                        <td colspan="3" class="text-center py-5">

                            <i class="fa-solid fa-inbox fs-1 d-block mb-3"></i>

                            <span class="text-muted">

                                Tidak ada data lingkungan.

                            </span>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        @if($lingkungans->hasPages())

            <div class="card-footer bg-white">

                {{ $lingkungans->links() }}

            </div>

        @endif

    </div>

</div>

@endsection