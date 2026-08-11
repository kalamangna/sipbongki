@extends('layouts.admin')

@section('title','Laporan Persuratan')

@section('content')

<div class="w-full">

 {{-- ==========================================================
 HEADER
 ========================================================== --}}

 <div class="flex flex-wrap justify-between items-center mb-6">

 <div>

 <h3 class="font-bold mb-1">

 <i class="fa-solid fa-file-lines-fill text-primary mr-2"></i>

 Laporan Persuratan

 </h3>

 <p class="text-slate-500 mb-0">

 Rekapitulasi seluruh pelayanan persuratan Kelurahan Bongki.

 </p>

 </div>

 <div class="flex gap-2 mt-3 mt-lg-0">
 
 <a href="{{ url()->previous() }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600">
 <i class="fa-solid fa-arrow-left"></i> Kembali
 </a>
 <a
 href="{{ route('admin.laporan.print-persuratan', request()->query()) }}"
 target="_blank"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm">

 <i class="fa-solid fa-print mr-1"></i>

 Cetak

 </a>

 <a
 href="{{ route('admin.laporan.export-persuratan') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm">

 <i class="fa-solid fa-file-earmark-excel mr-1"></i>

 Export Excel

 </a>

 
 </div>

 </div>
 {{-- ==========================================================
 STATISTIK
 ========================================================== --}}

 <div class="flex flex-wrap -mx-3 mb-4">

 <div class="w-full xl:w-1/4 px-3 md:w-1/2">

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 h-100 stat-card-centered">

 <div class="p-6">

 <div class="action-buttons">

 <div>

 <div class="text-slate-500 small mb-1">

 Total Permohonan

 </div>

 <h3 class="font-bold mb-0">

 {{ number_format($statistik['total']) }}

 </h3>

 </div>

 <div class="rounded-circle bg-primary-100 text-primary-700 bg-opacity-10 flex items-center justify-center"
 style="width:60px;height:60px;">

 <i class="fa-solid fa-file-lines-fill text-primary"></i>

 </div>

 </div>

 </div>

 </div>

 </div>



 <div class="w-full xl:w-1/4 px-3 md:w-1/2">

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 h-100 stat-card-centered">

 <div class="p-6">

 <div class="action-buttons">

 <div>

 <div class="text-slate-500 small mb-0">

 Menunggu

 </div>

 <h3 class="font-bold text-warning mb-0">

 {{ number_format($statistik['menunggu']) }}

 </h3>

 </div>

 <div class="rounded-circle bg-amber-100 text-amber-700 bg-opacity-10 flex items-center justify-center"
 style="width:60px;height:60px;">

 <i class="fa-solid fa-hourglass-split text-warning"></i>

 </div>

 </div>

 </div>

 </div>

 </div>



 <div class="w-full xl:w-1/4 px-3 md:w-1/2">

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 h-100 stat-card-centered">

 <div class="p-6">

 <div class="action-buttons">

 <div>

 <div class="text-slate-500 small mb-1">

 Diproses

 </div>

 <h3 class="font-bold text-info mb-0">

 {{ number_format($statistik['diproses']) }}

 </h3>

 </div>

 <div class="rounded-circle bg-sky-100 text-sky-700 bg-opacity-10 flex items-center justify-center"
 style="width:60px;height:60px;">

 <i class="fa-solid fa-gear-fill text-info"></i>

 </div>

 </div>

 </div>

 </div>

 </div>



 <div class="w-full xl:w-1/4 px-3 md:w-1/2">

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 h-100 stat-card-centered">

 <div class="p-6">

 <div class="action-buttons">

 <div>

 <div class="text-slate-500 small mb-1">

 Selesai

 </div>

 <h3 class="font-bold text-success mb-0">

 {{ number_format($statistik['selesai']) }}

 </h3>

 </div>

 <div class="rounded-circle bg-emerald-100 text-emerald-700 bg-opacity-10 flex items-center justify-center"
 style="width:60px;height:60px;">

 <i class="fa-solid fa-circle-check-fill text-success"></i>

 </div>

 </div>

 </div>

 </div>

 </div>

 </div>

 {{-- ==========================================================
 FILTER
 ========================================================== --}}

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-4">

 <div class="px-6 py-4 border-b border-slate-200 bg-white">

 <h6 class="font-bold mb-0">

 <i class="fa-solid fa-funnel mr-2"></i>

 Filter Laporan Persuratan

 </h6>

 </div>

 <div class="p-6">

 <form
 method="GET"
 action="{{ route('admin.laporan.persuratan') }}">

 <div class="flex flex-wrap -mx-3 gap-4">

 {{-- Keyword --}}
 <div class="w-full lg:w-1/4 px-3">

 <label class="form-label block text-center">

 Nomor / Nama / NIK

 </label>

 <input
 type="text"
 name="keyword"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 text-center"
 value="{{ request('keyword') }}"
 placeholder="Nomor surat, nama atau NIK">

 </div>



 {{-- Jenis Surat --}}
 <div class="w-full lg:w-1/4 px-3">

 <label class="form-label block text-center">

 Jenis Surat

 </label>

 <select
 name="jenis_surat"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 text-center">

 <option value="">

 Semua Jenis Surat

 </option>

 @foreach($jenisSurats as $jenis)

 <option
 value="{{ $jenis->id }}"
 @selected(request('jenis_surat') == $jenis->id)>

 {{ $jenis->nama }}

 </option>

 @endforeach

 </select>

 </div>



 {{-- Status --}}
 <div class="w-full lg:w-1/6 px-3">

 <label class="form-label block text-center">

 Status

 </label>

 <select
 name="status"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 text-center">

 <option value="">

 Semua

 </option>

 <option value="Menunggu"
 @selected(request('status')=='Menunggu')>

 Menunggu

 </option>

 <option value="Diproses"
 @selected(request('status')=='Diproses')>

 Diproses

 </option>

 <option value="Selesai"
 @selected(request('status')=='Selesai')>

 Selesai

 </option>

 <option value="Ditolak"
 @selected(request('status')=='Ditolak')>

 Ditolak

 </option>

 </select>

 </div>



 {{-- Tanggal Awal --}}
 <div class="w-full lg:w-1/6 px-3">

 <label class="form-label block text-center">

 Dari

 </label>

 <input
 type="date"
 name="tanggal_awal"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 text-center"
 value="{{ request('tanggal_awal') }}">

 </div>



 {{-- Tanggal Akhir --}}
 <div class="w-full lg:w-1/6 px-3">

 <label class="form-label block text-center">

 Sampai

 </label>

 <input
 type="date"
 name="tanggal_akhir"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 text-center"
 value="{{ request('tanggal_akhir') }}">

 </div>

 </div>



 <div class="mt-6 flex gap-2">

 <button
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

 <i class="fa-solid fa-magnifying-glass"></i>

 Tampilkan

 </button>

 <a
 href="{{ route('admin.laporan.persuratan') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all shadow-sm-outline-secondary">

 <i class="fa-solid fa-arrow-clockwise"></i>

 Reset

 </a>

 </div>

 </form>

 </div>

 </div>
 {{-- ==========================================================
 REKAP JENIS SURAT
 ========================================================== --}}

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-4">

 <div class="px-6 py-4 border-b border-slate-200 bg-white">

 <h6 class="font-bold mb-0">

 <i class="fa-solid fa-bar-chart-line mr-1"></i>

 Rekap Permohonan Berdasarkan Jenis Surat

 </h6>

 </div>

 <div class="p-6">

 <div class="flex flex-wrap -mx-3 gap-1">

 @forelse($rekapJenis as $index => $item)

 <div class="w-full xl:w-1/4 px-3 lg:w-1/3 col-md-0">

 <div class="border rounded-0 p-1 h-100 text-center">

 <div class="small text-slate-500 mb-0">

 {{ $item->nama }}

 </div>

 <div class="font-bold" style="font-size: 1.25rem; color: {{ ['#2563EB', '#10B981', '#F59E0B', '#EF4444'][$index % 4] }};">

 {{ number_format($item->permohonan_surats_count) }}

 </div>

 <small class="text-slate-500">

 Permohonan

 </small>

 </div>

 </div>

 @empty

 <div class="col-10">

 <div class="p-4 mb-4 text-sm rounded-xl border p-4 mb-4 text-sm rounded-xl border-light mb-0">

 Belum ada data jenis surat.

 </div>

 </div>

 @endforelse

 </div>

 </div>

 </div>
 {{-- ==========================================================
 TABEL LAPORAN PERSURATAN
 ========================================================== --}}

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

 <div class="px-6 py-4 border-b border-slate-200 bg-white flex justify-start items-center gap-3">

 <h6 class="font-bold mb-0">

 <i class="w-full text-sm text-left text-slate-600"></i>

 Data Permohonan Surat

 </h6>

 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-primary-100 text-primary-700">

 {{ $permohonans->total() }} Data

 </span>

 </div>

 <div class="overflow-x-auto w-full">

 <table class="w-full text-sm text-left text-slate-600" style="font-size:0.9rem; line-height:1.35;">

 <thead class="px-4 py-3 font-medium text-slate-700">

 <tr>

 <th width="40" class=\"text-center px-4 py-3 font-medium text-slate-700\">No</th>

 <th style="min-width:190px; white-space: normal; text-align:center;" class="px-4 py-3 font-medium text-slate-700">No. Permohonan</th>

 <th style="min-width:140px; white-space: normal; text-align:center;" class="px-4 py-3 font-medium text-slate-700">No. Surat</th>

 <th style="min-width:180px; white-space: normal; text-align:center;" class="px-4 py-3 font-medium text-slate-700">Pemohon</th>

 <th style="min-width:220px; white-space: normal; text-align:center;" class="px-4 py-3 font-medium text-slate-700">Jenis Surat</th>

 <th style="min-width:120px; white-space: normal; text-align:center;" class="px-4 py-3 font-medium text-slate-700">Tanggal</th>

 <th style="min-width:240px; white-space: normal; text-align:center;" class="px-4 py-3 font-medium text-slate-700">Penandatangan</th>

 <th class=\"text-center px-4 py-3 font-medium text-slate-700\">Status</th>

 <th width="100" class=\"text-center px-4 py-3 font-medium text-slate-700\">

 Aksi

 </th>

 </tr>

 </thead>

 <tbody>

 @forelse($permohonans as $item)

 <tr>

 <td class=\"text-center px-4 py-3 border-b border-slate-100\">

 {{ $permohonans->firstItem() + $loop->index }}

 </td>

 <td style="min-width:190px; white-space: normal; word-break: break-word; text-align:center;" class="px-4 py-3 border-b border-slate-100">

 {{ $item->nomor_permohonan }}

 </td>

 <td style="min-width:140px; white-space: normal; word-break: break-word; text-align:center;" class="px-4 py-3 border-b border-slate-100">

 {{ $item->nomor_surat ?: '-' }}

 </td>

 <td style="min-width:180px; white-space: normal; word-break: break-word; text-align:center;" class="px-4 py-3 border-b border-slate-100">

 {{ optional($item->penduduk)->nama_lengkap ?? data_get($item->data_surat, 'nama_lengkap') ?? '-' }}

 <br>

 <small class="text-slate-500">

 {{ optional($item->penduduk)->nik ?? data_get($item->data_surat, 'nik') ?? '-' }}

 </small>

 </td>

 <td style="min-width:220px; white-space: normal; word-break: break-word; text-align:center;" class="px-4 py-3 border-b border-slate-100">

 {{ optional($item->jenisSurat)->nama }}

 </td>

 <td style="min-width:120px; white-space: normal; word-break: break-word; text-align:center;" class="px-4 py-3 border-b border-slate-100">

 {{ optional($item->tanggal_permohonan)->format('d-m-Y') }}

 </td>

 <td style="min-width:240px; white-space: normal; word-break: break-word; text-align:center;" class="px-4 py-3 border-b border-slate-100">

 {{ optional($item->penandatangan)->nama_lengkap }}

 <br>

 <small class="text-slate-500" style="display:block; white-space: normal; word-break: break-word;">

 {{ optional(optional($item->penandatangan)->jabatan)->nama }}

 </small>

 </td>

 <td class=\"text-center px-4 py-3 border-b border-slate-100\">

 @switch($item->status)

 @case('Menunggu')

 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">

 Menunggu

 </span>

 @break

 @case('Diproses')

 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-sky-100 text-sky-700">

 Diproses

 </span>

 @break

 @case('Selesai')

 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">

 Selesai

 </span>

 @break

 @default

 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">

 Ditolak

 </span>

 @endswitch

 </td>

 <td class="px-4 py-3 border-b border-slate-100">

 <div class="action-buttons">

 <a
 href="{{ route('admin.laporan.persuratan.show',$item->id) }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-sky-600 text-white hover:bg-sky-700 shadow-sm !px-3 !py-1.5 !text-xs"
 title="Detail">

 <i class="fa-solid fa-eye"></i>

 </a>

 </div>

 </td>

 </tr>

 @empty

 <tr>

 <td colspan="9" class=\"text-center py-8 px-4 py-3 border-b border-slate-100\">

 <div class="text-slate-500">

 <i class="fa-solid fa-inbox block mb-4"></i>

 <h6>

 Belum ada data permohonan surat.

 </h6>

 <p class="mb-0">

 Data akan muncul setelah pelayanan persuratan dibuat.

 </p>

 </div>

 </td>

 </tr>

 @endforelse

 </tbody>

 </table>

 </div>

 @if($permohonans->hasPages())

 <div class="px-6 py-4 border-t border-slate-200 bg-white">

 {{ $permohonans->links() }}

 </div>

 @endif

 </div>

</div>

@endsection