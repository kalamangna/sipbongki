@extends('layouts.admin')

@section('title', 'Data Kartu Keluarga')

@section('content')

<div class="container-fluid">

    <div class="flex justify-between items-center mb-6">

        <div>
            <p class="text-slate-500 mb-0">
                Kelola Data Kartu Keluarga
            </p>
        </div>

        <a href="{{ route('admin.kartu-keluarga.create') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">
            <i class="bi bi-plus-circle"></i>
            Kartu Keluarga
        </a>

    </div>

    {{-- Pencarian --}}
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-4">
        <div class="p-6">

            <form
                action="{{ route('admin.kartu-keluarga.index') }}"
                method="GET">

                <div class="flex flex-wrap -mx-3 g-2 items-center">

                    <div class="col-md-9">

                        <input
                            type="text"
                            name="keyword"
                            class="form-control"
                            value="{{ request('keyword') }}"
                            placeholder="Cari Nomor KK / NIK / Nama Kepala Keluarga / Nama Anggota">

                    </div>

                    <div class="col-md-3 col-lg-2">

                        <button
                            class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm w-100">

                            <i class="bi bi-search"></i>
                            Cari

                        </button>

                    </div>

                </div>

            </form>

        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

        <div class="p-6 p-0">

            <div class="overflow-x-auto w-full">

                <table class="w-full text-left border-collapse text-sm table-hover align-middle mb-0">

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
                                {{ $kk->no_kk }}
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

                       @php
    $jumlahAnggota = $kk->anggota
        ->where('id', '!=', $kk->kepala_keluarga_id)
        ->count();
@endphp

<td>
    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-sky-100 text-sky-700">
        {{ $jumlahAnggota }} Orang
    </span>
</td>     

                            <td>

                                @if($kk->aktif)

                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                                        Aktif
                                    </span>

                                @else

                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">
                                        Tidak Aktif
                                    </span>

                                @endif

                            </td>

                            <td class="text-center">

                                <div class="action-buttons">

                                    <a href="{{ route('admin.kartu-keluarga.show',$kk->id) }}"
                                       class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-sky-600 text-white hover:bg-sky-700 shadow-sm"
                                       title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8"
                                class="text-center py-8 text-slate-500">

                                Data tidak ditemukan.

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

            {{ $kartuKeluargas->appends(request()->query())->links() }}

        </div>

    @endif

</div>

@endsection