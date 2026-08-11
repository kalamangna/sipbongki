@extends('layouts.admin')

@section('title', 'Data Jabatan')

@section('content')

<div class="container-fluid">

    <div class="flex justify-between items-center mb-6">

        <div>

            <p class="text-slate-500 mb-0">
                Master Data Jabatan Kelurahan Bongki
            </p>

        </div>

        <a
            href="{{ route('admin.jabatan.create') }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

            <i class="bi bi-plus-circle"></i>

            Tambah Jabatan

        </a>
    </div>

    <div class="alert alert-warning border-warning shadow-sm mb-6" role="alert" style="text-align: justify; text-justify: inter-word;">
        <i class="fa-solid fa-triangle-exclamation mr-2"></i>
        Perhatian: perubahan data jabatan memengaruhi struktur organisasi website. Ubah hanya jika sudah dipastikan jabatan, urutan, dan parent benar, karena perubahan<br>
        sembarangan dapat mengganggu tampilan dan logika struktur jabatan.
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">

        <div class="px-6 py-4 border-b border-slate-200 bg-white">

            <form method="GET">

                <div class="flex flex-wrap -mx-3 g-2">

                    <div class="col-md-8">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Cari nama jabatan..."
                            value="{{ $search }}">

                    </div>

                    <div class="col-auto">

                        <button class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

                            <i class="bi bi-search"></i>

                            Cari

                        </button>

                    </div>

                    @if($search)

                        <div class="col-auto">

                            <a
                                href="{{ route('admin.jabatan.index') }}"
                                class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary">

                                Reset

                            </a>

                        </div>

                    @endif

                </div>

            </form>

        </div>

        <div class="p-6 p-0">

            <table class="w-full text-left border-collapse text-sm table-hover align-middle mb-0">

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

                                <small class="text-slate-500">

                                    {{ $jabatan->slug }}

                                </small>

                            @endif

                        </td>

                        <td>

                            @if($jabatan->parent)

                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-light text-dark border">

                                    {{ $jabatan->parent->nama }}

                                </span>

                            @else

                                <span class="text-slate-500">

                                    -

                                </span>

                            @endif

                        </td>

                        <td class="text-center">

                            {{ $jabatan->urutan }}

                        </td>

                        <td class="text-center">

                            @if($jabatan->is_penandatangan)

                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">

                                    Ya

                                </span>

                            @else

                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">

                                    Tidak

                                </span>

                            @endif

                        </td>

                        <td class="text-center">

                            @if($jabatan->aktif)

                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-primary-100 text-primary-700">

                                    Aktif

                                </span>

                            @else

                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">

                                    Nonaktif

                                </span>

                            @endif

                        </td>

                        <td class="text-center">

                            <div class="action-buttons">

                                <a
                                    href="{{ route('admin.jabatan.edit', $jabatan) }}"
                                    class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-amber-500 text-white hover:bg-amber-600 shadow-sm !px-3 !py-1.5 !text-xs"
                                    title="Edit">

                                    <i class="bi bi-pencil"></i>

                                </a>

                                <button
                                    type="button"
                                    class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm !px-3 !py-1.5 !text-xs"
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
                                        class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary"
                                        data-bs-dismiss="modal">

                                        Batal

                                    </button>

                                    <form
                                        action="{{ route('admin.jabatan.destroy', $jabatan) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm">

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
                            class="text-center py-8">

                            <i class="bi bi-inbox fs-1 d-block mb-4"></i>

                            <span class="text-slate-500">

                                Tidak ada data jabatan.

                            </span>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        @if($jabatans->hasPages())

            <div class="px-6 py-4 border-t border-slate-200 bg-white">

                {{ $jabatans->links() }}

            </div>

        @endif

    </div>

</div>

@endsection