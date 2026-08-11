@extends('layouts.admin')

@section('title', 'Data Lingkungan')

@section('content')

<div class="container-fluid">

    <div class="flex justify-between items-center mb-6">

        <div>
            
            <p class="text-slate-500 mb-0">
                Master Data Lingkungan Kelurahan Bongki
            </p>
        </div>

        <a href="{{ route('admin.lingkungan.create') }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

            <i class="bi bi-plus-circle"></i>

            Tambah Lingkungan

        </a>

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
                            placeholder="Cari nama lingkungan...">

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
                            href="{{ route('admin.lingkungan.index') }}"
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
            href="{{ route('admin.lingkungan.show',$lingkungan) }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-sky-600 text-white hover:bg-sky-700 shadow-sm !px-3 !py-1.5 !text-xs"
            title="Show">

            <i class="bi bi-eye"></i>

        </a>

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
                                        class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary"
                                        data-bs-dismiss="modal">

                                        Batal

                                    </button>

                                    <form
                                        action="{{ route('admin.lingkungan.destroy',$lingkungan) }}"
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

                        <td colspan="3" class="text-center py-8">

                            <i class="bi bi-inbox fs-1 d-block mb-4"></i>

                            <span class="text-slate-500">

                                Tidak ada data lingkungan.

                            </span>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        @if($lingkungans->hasPages())

            <div class="px-6 py-4 border-t border-slate-200 bg-white">

                {{ $lingkungans->links() }}

            </div>

        @endif

    </div>

</div>

@endsection