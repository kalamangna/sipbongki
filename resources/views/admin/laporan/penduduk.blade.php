@extends('layouts.admin')

@section('title', 'Laporan Penduduk')

@section('content')

<div class="container-fluid">

    {{-- ==========================================================
        HEADER
    =========================================================== --}}

    <div class="flex justify-between items-center mb-6">

        <div>

            
            <p class="text-slate-500 mb-0">
                Statistik dan rekapitulasi data penduduk Kelurahan Bongki.
            </p>

        </div>

        <div class="flex gap-2 mt-3 mt-lg-0">

            <a href="{{ url()->previous() }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>

            <a
                href="{{ route('admin.laporan.print-penduduk', array_merge(request()->query(), ['from' => 'penduduk'])) }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm">

                <i class="bi bi-printer mr-1"></i>

                Cetak

            </a>

            <a
                href="{{ route('admin.laporan.export-penduduk') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm">

                <i class="bi bi-file-earmark-excel mr-1"></i>

                Export Excel

            </a>

        </div>

    </div>



    {{-- ==========================================================
        STATISTIK
    =========================================================== --}}

    <div class="flex flex-wrap -mx-3 mb-4">

        <div class="w-full lg:w-1/3 px-3">

            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

                <div class="p-6 text-center">

                    <small class="text-slate-500 d-block">
                        Total Penduduk
                    </small>

                    <h2 class="font-bold mt-2">
                        {{ number_format($statistik['total']) }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="w-full lg:w-1/3 px-3">

            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

                <div class="p-6 text-center">

                    <small class="text-slate-500 d-block">
                        Laki-laki
                    </small>

                    <h2 class="font-bold text-primary mt-2">
                        {{ number_format($statistik['laki']) }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="w-full lg:w-1/3 px-3">

            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

                <div class="p-6 text-center">

                    <small class="text-slate-500 d-block">
                        Perempuan
                    </small>

                    <h2 class="font-bold text-danger mt-2">
                        {{ number_format($statistik['perempuan']) }}
                    </h2>

                </div>

            </div>

        </div>

    </div>



{{-- ==========================================================
    FILTER DATA
========================================================== --}}

<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-4">

    <div class="px-6 py-4 border-b border-slate-200 bg-white">

            <h6 class="font-bold mb-0 fs-5">

                Filter Data Penduduk

            </h6>

    </div>

    <div class="p-6">

        <form method="GET"
              action="{{ route('admin.laporan.penduduk') }}">

            <div class="flex flex-wrap -mx-3 g-3">

                {{-- Nama / NIK --}}
                <div class="w-full lg:w-1/3 px-3 text-center">

                    <label class="form-label d-block">

                        Nama / NIK

                    </label>

                    <input
                        type="text"
                        name="keyword"
                        class="form-control text-center"
                        placeholder="Cari Nama atau NIK"
                        value="{{ request('keyword') }}">

                </div>



                {{-- Lingkungan --}}
                <div class="w-full lg:w-1/4 px-3 text-center">

                    <label class="form-label d-block">

                        Lingkungan

                    </label>

                    <select
                        name="lingkungan"
                        class="form-select text-center">

                        <option value="">

                            Semua Lingkungan

                        </option>

                        @foreach($lingkungans as $lingkungan)

                            <option
                                value="{{ $lingkungan->id }}"
                                @selected(request('lingkungan') == $lingkungan->id)>

                                {{ $lingkungan->nama }}

                            </option>

                        @endforeach

                    </select>

                </div>



                {{-- Jenis Kelamin --}}
                <div class="col-lg-2 text-center">

                    <label class="form-label d-block">

                        Jenis Kelamin

                    </label>

                    <select
                        name="jk"
                        class="form-select text-center">

                        <option value="">

                            Semua

                        </option>

                        <option
                            value="L"
                            @selected(request('jk')=='L')>

                            Laki-laki

                        </option>

                        <option
                            value="P"
                            @selected(request('jk')=='P')>

                            Perempuan

                        </option>

                    </select>

                </div>



                {{-- Agama --}}
                <div class="w-full lg:w-1/4 px-3 text-center">

                    <label class="form-label d-block">

                        Agama

                    </label>

                    <select
                        name="agama"
                        class="form-select text-center">

                        <option value="">

                            Semua Agama

                        </option>

                        @foreach($agamaList as $agama)

                            <option
                                value="{{ $agama }}"
                                @selected(request('agama') == $agama)>

                                {{ $agama }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>



            <div class="mt-6 flex gap-2">

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

                    <i class="bi bi-search"></i>

                    Tampilkan

                </button>



                <a href="{{ route('admin.laporan.penduduk') }}"
                   class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-outline-secondary">

                    <i class="bi bi-arrow-clockwise"></i>

                    Reset

                </a>

            </div>

        </form>

    </div>

</div> 

    {{-- ==========================================================
        REKAP LINGKUNGAN
    =========================================================== --}}

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-4">

        <div class="px-6 py-4 border-b border-slate-200 bg-white">

            <h6 class="mb-0 font-bold fs-5">

                Rekap Penduduk per Lingkungan

            </h6>

        </div>

        <div class="p-6">

            <div class="flex flex-wrap -mx-3 g-3">

                @foreach($rekapLingkungan as $item)

                    <div class="w-full lg:w-1/4 px-3 md:w-1/2">

                        <div class="border rounded-3 p-3 h-100 text-center">

                            <div class="small text-slate-500 mb-1">

                                {{ $item->nama }}

                            </div>

                            <h2 class="font-bold text-primary mt-2">

                                {{ number_format($item->penduduk_count) }}

                            </h2>

                            <small class="text-slate-500">

                                Penduduk

                            </small>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

{{-- ==========================================================
    ANALISIS DATA
========================================================== --}}

<div class="flex flex-wrap -mx-3 mb-4">

    {{-- Agama --}}
    <div class="w-full lg:w-1/3 px-3">

        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 h-100">

            <div class="px-6 py-4 border-b border-slate-200 bg-white justify-center text-center">

                <h6 class="font-bold mb-0">
                    Berdasarkan Agama
                </h6>

            </div>

            <div class="p-6">

                @forelse($rekapAgama as $item)

                    <div class="flex justify-between mb-2">

                        <span>{{ $item->agama ?: '-' }}</span>

                        <strong>{{ $item->total }}</strong>

                    </div>

                @empty

                    <p class="text-slate-500 mb-0">
                        Tidak ada data.
                    </p>

                @endforelse

            </div>

        </div>

    </div>



    {{-- Pendidikan --}}
    <div class="w-full lg:w-1/3 px-3">

        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 h-100">

            <div class="px-6 py-4 border-b border-slate-200 bg-white justify-center text-center">

                <h6 class="font-bold mb-0">
                    Berdasarkan Pendidikan
                </h6>

            </div>

            <div class="p-6">

                @forelse($rekapPendidikan as $item)

                    <div class="flex justify-between mb-2">

                        <span>{{ $item->pendidikan ?: '-' }}</span>

                        <strong>{{ $item->total }}</strong>

                    </div>

                @empty

                    <p class="text-slate-500 mb-0">
                        Tidak ada data.
                    </p>

                @endforelse

            </div>

        </div>

    </div>



    {{-- Pekerjaan --}}
    <div class="w-full lg:w-1/3 px-3">

        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 h-100">

            <div class="px-6 py-4 border-b border-slate-200 bg-white justify-center text-center">

                <h6 class="font-bold mb-0">
                    Berdasarkan Pekerjaan
                </h6>

            </div>

            <div class="p-6">

                @forelse($rekapPekerjaan as $item)

                    <div class="flex justify-between mb-2">

                        <span>{{ $item->pekerjaan ?: '-' }}</span>

                        <strong>{{ $item->total }}</strong>

                    </div>

                @empty

                    <p class="text-slate-500 mb-0">
                        Tidak ada data.
                    </p>

                @endforelse

            </div>

        </div>

    </div>

</div>

    {{-- ==========================================================
        TABEL DATA PENDUDUK
    =========================================================== --}}

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

        <div class="px-6 py-4 border-b border-slate-200 bg-white flex justify-start items-center gap-3">

            <h6 class="mb-0 font-bold fs-5">

                Data Penduduk

            </h6>

            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-primary-100 text-primary-700">

                {{ $penduduks->total() }} Data

            </span>

        </div>

        <div class="p-6 p-0">

            <div class="overflow-x-auto w-full">

                <table class="w-full text-left border-collapse text-sm table-hover align-middle mb-0 text-center table-soft-border">

                    <thead class="table-light text-center">

                        <tr>

                            <th width="60" class="text-center">
                                No
                            </th>

                            <th class="text-center">
                                NIK
                            </th>

                            <th class="text-center">
                                Nama Lengkap
                            </th>

                            <th class="text-center">
                                Jenis Kelamin
                            </th>

                            

                            <th class="text-center">
                                Lingkungan
                            </th>

                            <th class="text-center">
                                Alamat
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($penduduks as $penduduk)

                            <tr>

                                <td>

                                    {{ $loop->iteration + (($penduduks->currentPage()-1) * $penduduks->perPage()) }}

                                </td>

                                <td>

                                    {{ $penduduk->nik }}

                                </td>

                                <td class="name-cell">

                                    <span class="name-tooltip" title="No. KK: {{ optional($penduduk->kartuKeluarga)->nomor_kk ?? '-' }}">

                                        {{ $penduduk->nama_lengkap }}

                                    </span>

                                </td>

                                <td>

                                    @if($penduduk->jenis_kelamin == 'L')

                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-primary-100 text-primary-700">

                                            Laki-laki

                                        </span>

                                    @else

                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">

                                            Perempuan

                                        </span>

                                    @endif

                                </td>

                                

                                <td>

                                    {{ optional($penduduk->lingkungan)->nama ?? '-' }}

                                </td>

                                <td>

                                    {{ $penduduk->alamat }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center py-8 text-slate-500">

                                    Belum ada data penduduk.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="px-6 py-4 border-t border-slate-200 bg-white">

            {{ $penduduks->withQueryString()->links() }}

        </div>

    </div>

</div>

@endsection
