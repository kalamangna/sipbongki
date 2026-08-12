@extends('layouts.admin')

@section('title', 'Jenis Surat')

@section('content')

<div class="w-full">

 <div class="flex justify-between items-center mb-4 gap-3">

 <div>
 
 <p class="text-sm text-slate-500 mb-4">
 Master Data Jenis Surat Kelurahan Bongki
 </p>
 </div>

 <a href="{{ route('admin.jenis-surat.create') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

 <i class="fa-solid fa-circle-plus"></i>
 Tambah Jenis Surat

 </a>

 </div>

 <div class="p-4 mb-4 text-sm text-amber-800 rounded-xl bg-amber-50 border border-amber-200 border-warning shadow-sm mb-6" role="p-4 mb-4 text-sm rounded-xl border">
 <i class="fa-solid fa-triangle-exclamation mr-2"></i>
 Perhatian: Data jenis surat berperan dalam logika persuratan. Jangan melakukan perubahan sembarangan karena dapat memengaruhi alur pembuatan dan pencetakan surat di website.
 </div>

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">

 <div class="px-6 py-4 border-b border-slate-200 bg-white">

 <form method="GET">

 <div class="flex flex-col md:flex-flex flex-wrap -mx-3 gap-3">

 <div class="flex-1">

 <input
 type="text"
 name="search"
 value="{{ $search }}"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="Cari kode atau nama surat...">

 </div>

 <div class="shrink-0">

 <button class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

 <i class="fa-solid fa-magnifying-glass"></i>

 Cari

 </button>

 </div>

 @if($search)

 <div class="shrink-0">

 <a href="{{ route('admin.jenis-surat.index') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all focus:outline-none cursor-pointer active:scale-95" title="Reset Filter">
    <i class="fa-solid fa-rotate-left"></i>
</a>

 </div>

 @endif

 </div>

 </form>

 </div>

 <div class="p-6 p-0">

 <table class="w-full text-sm text-left text-slate-500">

 <thead class=\"text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-200 px-4 py-3 font-medium text-slate-700\">

 <tr>

 <th width="70" class="px-4 py-3 font-medium text-slate-700">No</th>

 <th width="150" class="px-4 py-3 font-medium text-slate-700">Kode</th>

 <th class="px-4 py-3 font-medium text-slate-700">Nama Surat</th>

 <th width="120" class=\"text-center px-4 py-3 font-medium text-slate-700\">
 Status
 </th>

 <th width="170" class=\"text-center px-4 py-3 font-medium text-slate-700\">
 Aksi
 </th>

 </tr>

 </thead>

 <tbody>

 @forelse($jenisSurats as $jenisSurat)

 <tr>

 <td class="px-4 py-3 border-b border-slate-100">

 {{ $jenisSurats->firstItem() + $loop->index }}

 </td>

 <td class="px-4 py-3 border-b border-slate-100">

 {{ $jenisSurat->kode }}

 </td>

 <td class="px-4 py-3 border-b border-slate-100">

 {{ $jenisSurat->nama }}

 </td>

 <td class=\"text-center px-4 py-3 border-b border-slate-100\">

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

<td class=\"text-center px-4 py-3 border-b border-slate-100\">

 <div class="action-buttons">

 {{-- Edit --}}
 <a
 href="{{ route('admin.jenis-surat.edit',$jenisSurat) }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-amber-500 text-white hover:bg-amber-600 shadow-sm !px-3 !py-1.5 !text-xs"
 title="Edit">

 <i class="fa-solid fa-pen-to-square"></i>

 </a>

 {{-- Hapus --}}
 <button
 type="button"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm !px-3 !py-1.5 !text-xs"
 title="Hapus"
 
 data-modal-target="hapusModal{{ $jenisSurat->id }}" data-modal-toggle="hapusModal{{ $jenisSurat->id }}">

 <i class="fa-solid fa-trash"></i>

 </button>

 </div>

</td> 

 </tr>

 <div id="hapusModal{{ $jenisSurat->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-2xl shadow-sm border border-slate-200">


 <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50 text-slate-800 rounded-t-2xl">
                <h5 class="font-bold text-lg mb-0">

 Konfirmasi Hapus

 </h5>
                <button type="button" class="text-slate-400 hover:text-slate-600 transition-colors" data-modal-hide="hapusModal{{ $jenisSurat->id }}">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

 <div class="p-6">

 Hapus jenis surat

 <strong>

 {{ $jenisSurat->nama }}

 </strong>

 ?

 </div>

 <div class="px-6 py-4 border-t border-slate-100 flex justify-end gap-3 bg-slate-50 rounded-b-2xl">

 <button
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600"
 data-modal-hide="hapusModal{{ $jenisSurat->id }}">

 Batal

 </button>

 <form
 action="{{ route('admin.jenis-surat.destroy',$jenisSurat) }}"
 method="POST">

 @csrf

 @method('DELETE')

 <button
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm">

 <i class="fa-solid fa-trash"></i>

 Hapus

 </button>

 </form>
        </div>
    </div>
</div>

 </div>

 @empty

 <tr>

 <td colspan="5" class=\"text-center py-8 px-4 py-3 border-b border-slate-100\">

 <i class="fa-solid fa-inbox block mb-4"></i>

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