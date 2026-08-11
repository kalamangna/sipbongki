@extends('layouts.admin')

@section('title', 'Jenis Surat')

@section('content')

<div class="container-fluid">

    <div class="flex justify-between items-center mb-4 gap-3">

        <div>
            
            <p class="page-description">
                Master Data Jenis Surat Kelurahan Bongki
            </p>
        </div>

        <a href="{{ route('admin.jenis-surat.create') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

            <i class="bi bi-plus-circle"></i>
            Tambah Jenis Surat

        </a>

    </div>

    <div class="alert alert-warning border-warning shadow-sm mb-6" role="alert">
        <i class="fa-solid fa-triangle-exclamation mr-2"></i>
        Perhatian: Data jenis surat berperan dalam logika persuratan. Jangan melakukan perubahan sembarangan karena dapat memengaruhi alur pembuatan dan pencetakan surat di website.
    </div>

        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">

        <div class="px-6 py-4 border-b border-slate-200 bg-white">

            <form method="GET">

                <div class="flex flex-wrap -mx-3 g-2">

                    <div class="col-md-8">

                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            class="form-control"
                            placeholder="Cari kode atau nama surat...">

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
                                href="{{ route('admin.jenis-surat.index') }}"
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

                            {{ $jenisSurat->kode }}

                        </td>

                        <td>

                            {{ $jenisSurat->nama }}

                        </td>

                        <td class="text-center">

                            @if($jenisSurat->aktif)

                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">

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

        {{-- Edit --}}
        <a
            href="{{ route('admin.jenis-surat.edit',$jenisSurat) }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-amber-500 text-white hover:bg-amber-600 shadow-sm !px-3 !py-1.5 !text-xs"
            title="Edit">

            <i class="bi bi-pencil"></i>

        </a>

        {{-- Hapus --}}
        <button
            type="button"
            class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm !px-3 !py-1.5 !text-xs"
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
                                        class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary"
                                        data-bs-dismiss="modal">

                                        Batal

                                    </button>

                                    <form
                                        action="{{ route('admin.jenis-surat.destroy',$jenisSurat) }}"
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

                        <td colspan="5" class="text-center py-8">

                            <i class="bi bi-inbox fs-1 d-block mb-4"></i>

                            <span class="text-slate-500">

                                Belum ada data Jenis Surat.

                            </span>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        @if($jenisSurats->hasPages())

            <div class="px-6 py-4 border-t border-slate-200 bg-white">

                {{ $jenisSurats->links() }}

            </div>

        @endif

    </div>

</div>

@endsection