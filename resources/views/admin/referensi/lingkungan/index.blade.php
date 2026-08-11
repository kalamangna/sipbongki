@extends('layouts.admin')

@section('title', 'Data Lingkungan')

@section('content')

<div class="w-full">

 <div class="flex justify-between items-center mb-6">

 <div>
 
 <p class="text-slate-500 mb-0">
 Master Data Lingkungan Kelurahan Bongki
 </p>
 </div>

 <a href="{{ route('admin.lingkungan.create') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

 <i class="fa-solid fa-circle-plus"></i>

 Tambah Lingkungan

 </a>

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
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="Cari nama lingkungan...">

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
 href="{{ route('admin.lingkungan.index') }}"
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

 <th width="70" class="px-4 py-3 font-medium text-slate-700">No</th>

 <th class="px-4 py-3 font-medium text-slate-700">Nama Lingkungan</th>

 <th width="170" class=\"text-center px-4 py-3 font-medium text-slate-700\">

 Aksi

 </th>

 </tr>

 </thead>

 <tbody>

 @forelse($lingkungans as $lingkungan)

 <tr>

 <td class="px-4 py-3 border-b border-slate-100">

 {{ $lingkungans->firstItem() + $loop->index }}

 </td>

 <td class="px-4 py-3 border-b border-slate-100">

 {{ $lingkungan->nama }}

 </td>

 <td class=\"text-center px-4 py-3 border-b border-slate-100\">

 <div class="action-buttons">

 <a
 href="{{ route('admin.lingkungan.show',$lingkungan) }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-sky-600 text-white hover:bg-sky-700 shadow-sm !px-3 !py-1.5 !text-xs"
 title="Show">

 <i class="fa-solid fa-eye"></i>

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
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all shadow-sm-close"
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
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600"
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

 <td colspan="3" class=\"text-center py-8 px-4 py-3 border-b border-slate-100\">

 <i class="fa-solid fa-inbox block mb-4"></i>

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