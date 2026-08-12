@extends('layouts.admin')

@section('title','Laporan Kartu Keluarga')

@section('content')

<div class="w-full">

 {{-- ==========================================================
 PAGE HEADER
 ========================================================== --}}

 <div class="flex flex-wrap justify-between items-center mb-6">

 <div>

 <h3 class="font-bold mb-1">

 <i class="fa-solid fa-users-fill text-primary mr-2"></i>

 Laporan Kartu Keluarga

 </h3>

 <p class="text-slate-500 mb-0">
 Rekapitulasi data Kartu Keluarga Kelurahan Bongki.
 </p>

 </div>

 <div class="flex gap-2 mt-3 mt-lg-0">
 
 <a href="{{ route('admin.laporan.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600">
 <i class="fa-solid fa-arrow-left"></i> Kembali
 </a>
 <a
 href="{{ route('admin.laporan.print-kartu-keluarga', request()->query()) }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm">

 <i class="fa-solid fa-print mr-1"></i>

 Cetak

 </a>
 <a
 href="{{ route('admin.laporan.export-kartu-keluarga') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm">

 <i class="fa-solid fa-file-earmark-excel mr-1"></i>

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
 class="mx-auto rounded-circle bg-primary-100 text-primary-700 bg-opacity-10 inline-flex items-center justify-center"
 style="width:60px;height:60px;">

 <i class="fa-solid fa-users-fill text-primary"></i>

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
 class="mx-auto rounded-circle bg-emerald-100 text-emerald-700 bg-opacity-10 inline-flex items-center justify-center"
 style="width:60px;height:60px;">

 <i class="fa-solid fa-user-vcard text-success"></i>

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
 class="mx-auto rounded-circle bg-amber-100 text-amber-700 bg-opacity-10 inline-flex items-center justify-center"
 style="width:60px;height:60px;">

 <i class="fa-solid fa-patch-check-fill text-warning"></i>

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
 class="mx-auto rounded-circle bg-sky-100 text-sky-700 bg-opacity-10 inline-flex items-center justify-center"
 style="width:60px;height:60px;">

 <i class="fa-solid fa-bar-chart-fill text-info"></i>

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

 <i class="fa-solid fa-funnel mr-2"></i>

 Filter Laporan

 </h6>

 </div>

 <div class="p-6">

 <form method="GET"
 action="{{ route('admin.laporan.kartu-keluarga') }}">

 <div class="flex flex-wrap -mx-3 gap-4">

 <div class="w-full lg:w-1/3 px-3 text-center">

 <label class="form-label block text-center">

 Nomor KK / Kepala Keluarga

 </label>

 <input
 type="text"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 text-center"
 name="keyword"
 value="{{ request('keyword') }}"
 placeholder="Cari Nomor KK atau Kepala Keluarga">

 </div>

 <div class="w-full lg:w-1/4 px-3 text-center">

 <label class="form-label block text-center">

 Lingkungan

 </label>

 <select
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 text-center"
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

 <div class="w-full lg:w-1/12 px-3 text-center">

 <label class="form-label block text-center">
 RT
 </label>

 <input
 type="text"
 name="rt"
 value="{{ request('rt') }}"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 text-center">

 </div>

 <div class="w-full lg:w-1/12 px-3 text-center">

 <label class="form-label block text-center">
 RW
 </label>

 <input
 type="text"
 name="rw"
 value="{{ request('rw') }}"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 text-center">

 </div>

 <div class="w-full lg:w-1/6 px-3 text-center">

 <label class="form-label block text-center">

 Status

 </label>

 <select
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 text-center"
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

 <div class="w-full lg:w-1/12 px-3 d-grid">

 <label class="form-label">&nbsp;</label>

 <button
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

 <i class="fa-solid fa-magnifying-glass"></i>

 </button>

 </div>

 </div>

 <div class="mt-3">

 <a href="{{ route('admin.laporan.kartu-keluarga') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all focus:outline-none cursor-pointer active:scale-95" title="Reset Filter">
    <i class="fa-solid fa-rotate-left"></i>
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

 <i class="fa-solid fa-bar-chart-line mr-2"></i>

 Rekap Kartu Keluarga Per Lingkungan

 </h6>

 </div>

 <div class="p-6 p-0">

 <div class="overflow-x-auto w-full">

 <table class="w-full text-sm text-left text-slate-500">

 <thead class=\"text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-200 px-4 py-3 font-medium text-slate-700\">

 <tr>

 <th width="60" class="px-4 py-3 font-medium text-slate-700">No</th>

 <th class="px-4 py-3 font-medium text-slate-700">Lingkungan</th>

 <th class=\"text-center px-4 py-3 font-medium text-slate-700\">Jumlah KK</th>

 <th class=\"text-center px-4 py-3 font-medium text-slate-700\">Jumlah Penduduk</th>

 </tr>

 </thead>

 <tbody>

 @forelse($rekapLingkungan as $item)

 <tr>

 <td class="px-4 py-3 border-b border-slate-100">
 {{ $loop->iteration }}
 </td>

 <td class="px-4 py-3 border-b border-slate-100">

 {{ $item->nama }}

 </td>

 <td class=\"text-center px-4 py-3 border-b border-slate-100\">

 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-primary-100 text-primary-700">

 {{ number_format($item->kartu_keluargas_count) }} KK

 </span>

 </td>

 <td class=\"text-center px-4 py-3 border-b border-slate-100\">

 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">

 {{ number_format($item->penduduk_count) }} Jiwa

 </span>

 </td>

 </tr>

 @empty

 <tr>

 <td colspan="4"
 class=\"text-center text-slate-500 py-4 px-4 py-3 border-b border-slate-100\">

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

 <i class="w-full text-sm text-left text-slate-600"></i>

 Data Kartu Keluarga

 </h6>

 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-primary-100 text-primary-700">

 {{ $kartuKeluargas->total() }} Data

 </span>

 </div>

 <div class="overflow-x-auto w-full">

 <table class="w-full text-sm text-left text-slate-500">

 <thead class=\"text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-200 px-4 py-3 font-medium text-slate-700\">

 <tr class="text-center">

 <th width="60" class="px-4 py-3 font-medium text-slate-700">No</th>

 <th class="px-4 py-3 font-medium text-slate-700">No. Kartu Keluarga</th>

 <th class="px-4 py-3 font-medium text-slate-700">Kepala Keluarga</th>

 <th class=\"text-center px-4 py-3 font-medium text-slate-700\">Anggota</th>

 <th class="px-4 py-3 font-medium text-slate-700">Lingkungan</th>

 <th class=\"text-center px-4 py-3 font-medium text-slate-700\">RT/RW</th>

 <th class=\"text-center px-4 py-3 font-medium text-slate-700\">Status</th>

 <th width="150" class=\"text-center px-4 py-3 font-medium text-slate-700\">

 Aksi

 </th>

 </tr>

 </thead>

 <tbody>

 @forelse($kartuKeluargas as $kk)

 <tr>

 <td class="px-4 py-3 border-b border-slate-100">

 {{ $kartuKeluargas->firstItem() + $loop->index }}

 </td>

 <td class="px-4 py-3 border-b border-slate-100">

 {{ $kk->no_kk }}

 </td>

 <td class="px-4 py-3 border-b border-slate-100">

 {{ optional($kk->kepalaKeluarga)->nama_lengkap ?? '-' }}

 </td>

 <td class=\"text-center px-4 py-3 border-b border-slate-100\">

 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-sky-100 text-sky-700">

 {{ $kk->anggota_count }} Orang

 </span>

 </td>

 <td class="px-4 py-3 border-b border-slate-100">

 {{ optional($kk->lingkungan)->nama ?? '-' }}

 </td>

 <td class=\"text-center px-4 py-3 border-b border-slate-100\">

 {{ $kk->rt }}

 /

 {{ $kk->rw }}

 </td>

 <td class=\"text-center px-4 py-3 border-b border-slate-100\">

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

 <td class="px-4 py-3 border-b border-slate-100">

 <div class="action-buttons">

 <a href="{{ route('admin.laporan.kartu-keluarga.show',$kk->id) }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-sky-600 text-white hover:bg-sky-700 shadow-sm"
 title="Detail">
 <i class="fa-solid fa-eye"></i>
 </a>

 </div>

 </td>

 </tr>

 @empty

 <tr>

 <td colspan="8" class=\"text-center py-8 px-4 py-3 border-b border-slate-100\">

 <div class="text-slate-500">

 <i class="fa-solid fa-inbox block mb-4"></i>

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