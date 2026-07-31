@extends('layouts.admin')

@section('title', 'Data Jabatan')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-1">

        <div>

            <p class="text-muted mb-0">
                Master Data Jabatan Kelurahan Bongki
            </p>

        </div>

        <a
            href="{{ route('admin.jabatan.create') }}"
            class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>

            Tambah Jabatan

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
                            class="form-control"
                            placeholder="Cari nama jabatan..."
                            value="{{ $search }}">

                    </div>

                    <div class="col-auto">

                        <button class="btn btn-primary">

                            <i class="bi bi-search"></i>

                            Cari

                        </button>

                    </div>

                    @if($search)

                        <div class="col-auto">

                            <a
                                href="{{ route('admin.jabatan.index') }}"
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

                        <th>
                            Nama Jabatan
                        </th>

                        <th>
                            Parent Jabatan
                        </th>

                        <th width="80" class="text-center">
                            Urutan
                        </th>

                        <th width="150" class="text-center">
                            Penandatangan
                        </th>

                        <th width="110" class="text-center">
                            Status
                        </th>

                        <th width="160" class="text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($jabatans as $jabatan)

                    <tr>

                        <td>

                            <div class="fw-semibold">

                                {{ $jabatan->nama }}

                            </div>

                            @if($jabatan->slug)

                                <small class="text-muted">

                                    {{ $jabatan->slug }}

                                </small>

                            @endif

                        </td>

                        <td>

                            @if($jabatan->parent)

                                <span class="badge bg-light text-dark border">

                                    {{ $jabatan->parent->nama }}

                                </span>

                            @else

                                <span class="text-muted">

                                    -

                                </span>

                            @endif

                        </td>

                        <td class="text-center">

                            {{ $jabatan->urutan }}

                        </td>

                        <td class="text-center">

                            @if($jabatan->is_penandatangan)

                                <span class="badge bg-success">

                                    Ya

                                </span>

                            @else

                                <span class="badge bg-secondary">

                                    Tidak

                                </span>

                            @endif

                        </td>

                        <td class="text-center">

                            @if($jabatan->aktif)

                                <span class="badge bg-primary">

                                    Aktif

                                </span>

                            @else

                                <span class="badge bg-danger">

                                    Nonaktif

                                </span>

                            @endif

                        </td>

                        <td class="text-center">

                            <div class="action-buttons">

                                <a
                                    href="{{ route('admin.jabatan.edit', $jabatan) }}"
                                    class="btn btn-warning btn-sm"
                                    title="Edit">

                                    <i class="bi bi-pencil"></i>

                                </a>

                                <button
                                    type="button"
                                    class="btn btn-danger btn-sm"
                                    title="Hapus"
                                    data-bs-toggle="modal"
                                    data-bs-target="#hapusModal{{ $jabatan->id }}">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </div>

                        </td>

                    </tr>

                    <div
                        class="modal fade"
                        id="hapusModal{{ $jabatan->id }}"
                        tabindex="-1">

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

                                    Apakah Anda yakin ingin menghapus jabatan

                                    <strong>

                                        {{ $jabatan->nama }}

                                    </strong> ?

                                </div>

                                <div class="modal-footer">

                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal">

                                        Batal

                                    </button>

                                    <form
                                        action="{{ route('admin.jabatan.destroy', $jabatan) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="btn btn-danger">

                                            <i class="bi bi-trash"></i>

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="text-center py-5">

                            <i class="bi bi-inbox fs-1 d-block mb-3"></i>

                            <span class="text-muted">

                                Tidak ada data jabatan.

                            </span>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        @if($jabatans->hasPages())

            <div class="card-footer bg-white">

                {{ $jabatans->links() }}

            </div>

        @endif

    </div>

</div>

@endsection