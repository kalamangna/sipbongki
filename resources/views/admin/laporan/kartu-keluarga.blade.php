@extends('layouts.admin')

@section('title','Laporan Kartu Keluarga')

@section('content')

<div class="container-fluid">

    {{-- ==========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="flex flex-wrap justify-between items-center mb-6">

        <div>

            <h3 class="font-bold mb-1">

                <i class="bi bi-people-fill text-primary mr-2"></i>

                Laporan Kartu Keluarga

            </h3>

            <p class="text-slate-500 mb-0">
                Rekapitulasi data Kartu Keluarga Kelurahan Bongki.
            </p>

        </div>

        <div class="flex gap-2 mt-3 mt-lg-0">
      
        <a href="{{ route('admin.laporan.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
        </a>
            <a
                href="{{ route('admin.laporan.print-kartu-keluarga', request()->query()) }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm">

                <i class="bi bi-printer mr-1"></i>

                Cetak

            </a>
            <a
                href="{{ route('admin.laporan.export-kartu-keluarga') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm">

                <i class="bi bi-file-earmark-excel mr-1"></i>

                Export Excel

            </a>
          
        </div>

    </div>



    {{-- ==========================================================
        STATISTIK
    ========================================================== --}}

    <div class="flex flex-wrap -mx-3 mb-6">

        <div class="w-full xl:w-1/4 px-3 md:w-1/2">

            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 h-100">

                <div class="p-6 text-center">

                    <div>

                        <div class="text-slate-500 small mb-1">

                            Total Kartu Keluarga

                        </div>

                        <h3 class="font-bold mb-2">

                            {{ number_format($statistik['total_kk']) }}

                        </h3>

                        <div
                            class="mx-auto rounded-circle bg-primary-100 text-primary-700 bg-opacity-10 d-inline-flex items-center justify-center"
                            style="width:60px;height:60px;">

                            <i class="bi bi-people-fill fs-3 text-primary"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="w-full xl:w-1/4 px-3 md:w-1/2">

            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 h-100">

                <div class="p-6 text-center">

                    <div>

                        <div class="text-slate-500 small mb-1">

                            Total Anggota

                        </div>

                        <h3 class="font-bold mb-2">

                            {{ number_format($statistik['total_anggota']) }}

                        </h3>

                        <div
                            class="mx-auto rounded-circle bg-emerald-100 text-emerald-700 bg-opacity-10 d-inline-flex items-center justify-center"
                            style="width:60px;height:60px;">

                            <i class="bi bi-person-vcard fs-3 text-success"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="w-full xl:w-1/4 px-3 md:w-1/2">

            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 h-100">

                <div class="p-6 text-center">

                    <div>

                        <div class="text-slate-500 small mb-1">

                            KK Aktif

                        </div>

                        <h3 class="font-bold mb-2">

                            {{ number_format($statistik['kk_aktif']) }}

                        </h3>

                        <div
                            class="mx-auto rounded-circle bg-amber-100 text-amber-700 bg-opacity-10 d-inline-flex items-center justify-center"
                            style="width:60px;height:60px;">

                            <i class="bi bi-patch-check-fill fs-3 text-warning"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="w-full xl:w-1/4 px-3 md:w-1/2">

            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 h-100">

                <div class="p-6 text-center">

                    <div>

                        <div class="text-slate-500 small mb-1">

                            Rata-rata Anggota / KK

                        </div>

                        <h3 class="font-bold mb-2">

                            {{ $statistik['rata_anggota'] }}

                        </h3>

                        <div
                            class="mx-auto rounded-circle bg-sky-100 text-sky-700 bg-opacity-10 d-inline-flex items-center justify-center"
                            style="width:60px;height:60px;">

                            <i class="bi bi-bar-chart-fill fs-3 text-info"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- ==========================================================
        FILTER
    ========================================================== --}}

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

        <div class="px-6 py-4 border-b border-slate-200 bg-white">

            <h6 class="font-bold mb-0">

                <i class="bi bi-funnel mr-2"></i>

                Filter Laporan

            </h6>

        </div>

        <div class="p-6">

            <form method="GET"
                  action="{{ route('admin.laporan.kartu-keluarga') }}">

                <div class="flex flex-wrap -mx-3 g-3">

                    <div class="w-full lg:w-1/3 px-3 text-center">

                        <label class="form-label d-block text-center">

                            Nomor KK / Kepala Keluarga

                        </label>

                        <input
                            type="text"
                            class="form-control text-center"
                            name="keyword"
                            value="{{ request('keyword') }}"
                            placeholder="Cari Nomor KK atau Kepala Keluarga">

                    </div>

                    <div class="w-full lg:w-1/4 px-3 text-center">

                        <label class="form-label d-block text-center">

                            Lingkungan

                        </label>

                        <select
                            class="form-select text-center"
                            name="lingkungan">

                            <option value="">
                                Semua Lingkungan
                            </option>

                            @foreach($lingkungans as $lingkungan)

                                <option
                                    value="{{ $lingkungan->id }}"
                                    @selected(request('lingkungan')==$lingkungan->id)>

                                    {{ $lingkungan->nama }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-lg-1 text-center">

                        <label class="form-label d-block text-center">
                            RT
                        </label>

                        <input
                            type="text"
                            name="rt"
                            value="{{ request('rt') }}"
                            class="form-control text-center">

                    </div>

                    <div class="col-lg-1 text-center">

                        <label class="form-label d-block text-center">
                            RW
                        </label>

                        <input
                            type="text"
                            name="rw"
                            value="{{ request('rw') }}"
                            class="form-control text-center">

                    </div>

                    <div class="col-lg-2 text-center">

                        <label class="form-label d-block text-center">

                            Status

                        </label>

                        <select
                            class="form-select text-center"
                            name="status">

                            <option value="">
                                Semua
                            </option>

                            <option
                                value="1"
                                @selected(request('status')==='1')>

                                Aktif

                            </option>

                            <option
                                value="0"
                                @selected(request('status')==='0')>

                                Tidak Aktif

                            </option>

                        </select>

                    </div>

                    <div class="col-lg-1 d-grid">

                        <label class="form-label">&nbsp;</label>

                        <button
                            class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

                            <i class="bi bi-search"></i>

                        </button>

                    </div>

                </div>

                <div class="mt-3">

                    <a
                        href="{{ route('admin.laporan.kartu-keluarga') }}"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-outline-secondary">

                        Reset Filter

                    </a>

                </div>

            </form>

        </div>

    </div>
    {{-- ==========================================================
        REKAP PER LINGKUNGAN
    ========================================================== --}}

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

        <div class="px-6 py-4 border-b border-slate-200 bg-white">

            <h6 class="font-bold mb-0">

                <i class="bi bi-bar-chart-line mr-2"></i>

                Rekap Kartu Keluarga Per Lingkungan

            </h6>

        </div>

        <div class="p-6 p-0">

            <div class="overflow-x-auto w-full">

                <table class="w-full text-left border-collapse text-sm table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th width="60">No</th>

                            <th>Lingkungan</th>

                            <th class="text-center">Jumlah KK</th>

                            <th class="text-center">Jumlah Penduduk</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($rekapLingkungan as $item)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>

                                    {{ $item->nama }}

                                </td>

                                <td class="text-center">

                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-primary-100 text-primary-700">

                                        {{ number_format($item->kartu_keluargas_count) }} KK

                                    </span>

                                </td>

                                <td class="text-center">

                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">

                                        {{ number_format($item->penduduk_count) }} Jiwa

                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4"
                                    class="text-center text-slate-500 py-4">

                                    Belum ada data.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>



    {{-- ==========================================================
        TABEL LAPORAN
    ========================================================== --}}

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

        <div class="px-6 py-4 border-b border-slate-200 bg-white flex justify-start items-center gap-3">

            <h6 class="font-bold mb-0">

                <i class="bi bi-table mr-2"></i>

                Data Kartu Keluarga

            </h6>

            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-primary-100 text-primary-700">

                {{ $kartuKeluargas->total() }} Data

            </span>

        </div>

        <div class="overflow-x-auto w-full">

            <table class="w-full text-left border-collapse text-sm table-hover align-middle mb-0 text-center">

                <thead class="table-light">

                    <tr class="text-center">

                        <th width="60">No</th>

                        <th>No. Kartu Keluarga</th>

                        <th>Kepala Keluarga</th>

                        <th class="text-center">Anggota</th>

                        <th>Lingkungan</th>

                        <th class="text-center">RT/RW</th>

                        <th class="text-center">Status</th>

                        <th width="150" class="text-center">

                            Aksi

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($kartuKeluargas as $kk)

                        <tr>

                            <td>

                                {{ $kartuKeluargas->firstItem() + $loop->index }}

                            </td>

                            <td>

                                {{ $kk->no_kk }}

                            </td>

                            <td>

                                {{ optional($kk->kepalaKeluarga)->nama_lengkap ?? '-' }}

                            </td>

                            <td class="text-center">

                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-sky-100 text-sky-700">

                                    {{ $kk->anggota_count }} Orang

                                </span>

                            </td>

                            <td>

                                {{ optional($kk->lingkungan)->nama ?? '-' }}

                            </td>

                            <td class="text-center">

                                {{ $kk->rt }}

                                /

                                {{ $kk->rw }}

                            </td>

                            <td class="text-center">

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

                            <td>

                                <div class="action-buttons">

                                    <a href="{{ route('admin.laporan.kartu-keluarga.show',$kk->id) }}"
                                       class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-sky-600 text-white hover:bg-sky-700 shadow-sm"
                                       title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8" class="text-center py-8">

                                <div class="text-slate-500">

                                    <i class="bi bi-inbox fs-1 d-block mb-4"></i>

                                    <h6>

                                        Tidak ada data Kartu Keluarga.

                                    </h6>

                                    <p class="mb-0">

                                        Silakan ubah filter atau tambahkan data terlebih dahulu.

                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        @if($kartuKeluargas->hasPages())

            <div class="px-6 py-4 border-t border-slate-200 bg-white">

                {{ $kartuKeluargas->links() }}

            </div>

        @endif

    </div>

</div>

@endsection