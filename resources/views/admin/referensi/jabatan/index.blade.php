@extends('layouts.admin')

@section('title', 'Data Jabatan')

@section('content')

<div class="w-full">

 <div class="flex justify-between items-center mb-6">

 <div>

 <p class="text-slate-500 mb-0">
 Master Data Jabatan Kelurahan Bongki
 </p>

 </div>

 <a
 href="{{ route('admin.jabatan.create') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

 <i class="fa-solid fa-circle-plus"></i>

 Tambah Jabatan

 </a>
 </div>

 <div class="p-4 mb-4 text-sm text-amber-800 rounded-xl bg-amber-50 border border-amber-200 border-warning shadow-sm mb-6" role="p-4 mb-4 text-sm rounded-xl border" style="text-align: justify; text-justify: inter-word;">
 <i class="fa-solid fa-triangle-exclamation mr-2"></i>
 Perhatian: perubahan data jabatan memengaruhi struktur organisasi website. Ubah hanya jika sudah dipastikan jabatan, urutan, dan parent benar, karena perubahan<br>
 sembarangan dapat mengganggu tampilan dan logika struktur jabatan.
 </div>

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">

 <div class="px-6 py-4 border-b border-slate-200 bg-white">

 <form method="GET">

 <div class="flex flex-col md:flex-flex flex-wrap -mx-3 gap-3">

 <div class="flex-1">

 <input
 type="text"
 name="search"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="Cari nama jabatan..."
 value="{{ $search }}">

 </div>

 <div class="shrink-0">

 <button class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

 <i class="fa-solid fa-magnifying-glass"></i>

 Cari

 </button>

 </div>

 @if($search)

 <div class="shrink-0">

 <a
 href="{{ route('admin.jabatan.index') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600">

 Reset

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

 <th class="px-4 py-3 font-medium text-slate-700">
 Nama Jabatan
 </th>

 <th class="px-4 py-3 font-medium text-slate-700">
 Parent Jabatan
 </th>

 <th width="80" class=\"text-center px-4 py-3 font-medium text-slate-700\">
 Urutan
 </th>

 <th width="150" class=\"text-center px-4 py-3 font-medium text-slate-700\">
 Penandatangan
 </th>

 <th width="110" class=\"text-center px-4 py-3 font-medium text-slate-700\">
 Status
 </th>

 <th width="160" class=\"text-center px-4 py-3 font-medium text-slate-700\">
 Aksi
 </th>

 </tr>

 </thead>

 <tbody>

 @forelse($jabatans as $jabatan)

 <tr>

 <td class="px-4 py-3 border-b border-slate-100">

 <div class="font-semibold">

 {{ $jabatan->nama }}

 </div>

 @if($jabatan->slug)

 <small class="text-slate-500">

 {{ $jabatan->slug }}

 </small>

 @endif

 </td>

 <td class="px-4 py-3 border-b border-slate-100">

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

 <td class=\"text-center px-4 py-3 border-b border-slate-100\">

 {{ $jabatan->urutan }}

 </td>

 <td class=\"text-center px-4 py-3 border-b border-slate-100\">

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

 <td class=\"text-center px-4 py-3 border-b border-slate-100\">

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

 <td class=\"text-center px-4 py-3 border-b border-slate-100\">

 <div class="action-buttons">

 <a
 href="{{ route('admin.jabatan.edit', $jabatan) }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-amber-500 text-white hover:bg-amber-600 shadow-sm !px-3 !py-1.5 !text-xs"
 title="Edit">

 <i class="fa-solid fa-pen-to-square"></i>

 </a>

 <button
 type="button"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm !px-3 !py-1.5 !text-xs"
 title="Hapus"
 data-bs-toggle="modal"
 data-bs-target="#hapusModal{{ $jabatan->id }}">

 <i class="fa-solid fa-trash"></i>

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
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all shadow-sm-close"
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
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600"
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

 <td
 colspan="6"
 class=\"text-center py-8 px-4 py-3 border-b border-slate-100\">

 <i class="fa-solid fa-inbox block mb-4"></i>

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