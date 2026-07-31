@extends('layouts.admin')

@section('title', 'Jenis Surat')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-1">

        <div>
            
            <p class="page-description">
                Master Data Jenis Surat Kelurahan Bongki
            </p>
        </div>

        <a href="{{ route('admin.jenis-surat.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>
            Tambah Jenis Surat

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
                            placeholder="Cari kode atau nama surat...">

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
                                href="{{ route('admin.jenis-surat.index') }}"
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

                        <th width="150">Kode</th>

                        <th>Nama Surat</th>

                        <th width="120" class="text-center">
                            Status
                        </th>

                        <th width="170" class="text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($jenisSurats as $jenisSurat)

                    <tr>

                        <td>

                            {{ $jenisSurats->firstItem() + $loop->index }}

                        </td>

                        <td>

                            <strong>

                                {{ $jenisSurat->kode }}

                            </strong>

                        </td>

                        <td>

                            {{ $jenisSurat->nama }}

                        </td>

                        <td class="text-center">

                            @if($jenisSurat->aktif)

                                <span class="badge bg-success">

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

        {{-- Edit --}}
        <a
            href="{{ route('admin.jenis-surat.edit',$jenisSurat) }}"
            class="btn btn-warning btn-sm"
            title="Edit">

            <i class="bi bi-pencil"></i>

        </a>

        {{-- Hapus --}}
        <button
            type="button"
            class="btn btn-danger btn-sm"
            title="Hapus"
            data-bs-toggle="modal"
            data-bs-target="#hapusModal{{ $jenisSurat->id }}">

            <i class="bi bi-trash"></i>

        </button>

    </div>

</td>                        

                    </tr>

                    <div
                        class="modal fade"
                        id="hapusModal{{ $jenisSurat->id }}"
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

                                    Hapus jenis surat

                                    <strong>

                                        {{ $jenisSurat->nama }}

                                    </strong>

                                    ?

                                </div>

                                <div class="modal-footer">

                                    <button
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal">

                                        Batal

                                    </button>

                                    <form
                                        action="{{ route('admin.jenis-surat.destroy',$jenisSurat) }}"
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

                        <td colspan="5" class="text-center py-5">

                            <i class="bi bi-inbox fs-1 d-block mb-3"></i>

                            <span class="text-muted">

                                Belum ada data Jenis Surat.

                            </span>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        @if($jenisSurats->hasPages())

            <div class="card-footer bg-white">

                {{ $jenisSurats->links() }}

            </div>

        @endif

    </div>

</div>

@endsection