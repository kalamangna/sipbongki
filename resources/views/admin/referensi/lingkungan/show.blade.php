@extends('layouts.admin')

@section('title', 'Detail Lingkungan')

@section('content')

<div class="w-full">

 <div class="flex justify-between items-center mb-6">

 <div>

 <h3 class="font-bold mb-1">
 Detail Lingkungan
 </h3>

 <p class="text-slate-500 mb-0">
 Informasi lengkap data lingkungan Kelurahan Bongki.
 </p>

 </div>

 <div>

 <a href="{{ route('admin.lingkungan.index') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600 mr-2">

 <i class="fa-solid fa-arrow-left mr-1"></i>
 Kembali

 </a>

 <a href="{{ route('admin.lingkungan.edit', $lingkungan) }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-amber-500 text-white hover:bg-amber-600 shadow-sm mr-2">

 <i class="fa-solid fa-pen-to-square mr-1"></i>
 Edit

 </a>

 <form
 action="{{ route('admin.lingkungan.destroy', $lingkungan) }}"
 method="POST"
 class="inline"
 onsubmit="return confirm('Yakin ingin menghapus lingkungan ini?');">

 @csrf
 @method('DELETE')

 <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm">
 <i class="fa-solid fa-trash mr-1"></i>
 Hapus
 </button>

 </form>

 </div>

 </div>

 <div class="flex flex-wrap -mx-3 align-items-stretch">

 <div class="w-full lg:w-2/3 px-3">

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 h-100">

 <div class="p-6">

 <div class="mb-6">
 <h4 class="font-bold mb-2">{{ $lingkungan->nama }}</h4>
 <span class="text-slate-500">
 Kode: {{ $lingkungan->kode ?? '-' }}
 </span>
 </div>

 <div class="flex flex-wrap -mx-3 gy-3">

 <div class="w-full md:w-1/2 px-3">
 <h6 class="mb-1">Kepala Lingkungan</h6>
 <p class="mb-0">{{ $lingkungan->ketua_lingkungan ?? '-' }}</p>
 </div>

 <div class="w-full md:w-1/2 px-3">
 <h6 class="mb-1">Telepon</h6>
 <p class="mb-0">{{ $lingkungan->telepon ?? '-' }}</p>
 </div>

 <div class="w-full md:w-1/2 px-3">
 <h6 class="mb-1">Status</h6>
 @if($lingkungan->status)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Aktif</span>
 @else
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">Nonaktif</span>
 @endif
 </div>

 <div class="w-full px-3">
 <h6 class="mb-1">Keterangan</h6>
 <p class="mb-0">{{ $lingkungan->keterangan ?? '-' }}</p>
 </div>

 </div>

 </div>

 </div>

 </div>

 <div class="w-full lg:w-1/3 px-3">

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 h-100">

 <div class="p-6 flex flex-column justify-center items-center text-center py-8">

 @if($kepalaLingkungan && $kepalaLingkungan->foto)
 <img src="{{ asset('storage/' . $kepalaLingkungan->foto) }}"
 alt="Foto Kepala Lingkungan"
 class="img-fluid rounded-circle mb-6"
 style="width: 160px; height: 160px; object-fit: cover;">
 @else
 <div class="bg-light rounded-circle mb-6"
 style="width: 160px; height: 160px; display: inline-flex; align-items: center; justify-content: center; font-size: 2rem; color: #6c757d;">
 <i class="fa-solid fa-user-circle"></i>
 </div>
 @endif

 <h5 class="font-bold mb-1">{{ $lingkungan->ketua_lingkungan ?? '-' }}</h5>
 <p class="text-slate-500 mb-0">Kepala Lingkungan</p>

 </div>

 </div>

 </div>

 </div>

</div>

@endsection