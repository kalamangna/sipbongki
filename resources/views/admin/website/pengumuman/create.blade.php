@extends('layouts.admin')

@section('title', 'Tambah Pengumuman')

@section('content')

<div class="w-full">

 {{-- HEADER --}}
 <div class="flex justify-between items-center mb-6">

 <div>

 <h3 class="font-bold mb-1">
 Tambah Pengumuman
 </h3>

 <p class="text-slate-500 mb-0">
 Tambahkan pengumuman terbaru Kelurahan Bongki.
 </p>

 </div>

 <a href="{{ route('admin.website.pengumuman.index') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600">

 <i class="fa-solid fa-arrow-left mr-2"></i>

 Kembali

 </a>

 </div>

 {{-- VALIDATION ERROR --}}
 @if($errors->any())

 <div class="p-4 mb-4 text-sm text-red-800 rounded-xl bg-red-50 border border-red-200">

 <ul class="mb-0">

 @foreach($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach

 </ul>

 </div>

 @endif

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

 <div class="p-6">

 <form action="{{ route('admin.website.pengumuman.store') }}"
 method="POST"
 enctype="multipart/form-data">

 @csrf

 {{-- JUDUL --}}
 <div class="mb-4">

 <label class="form-label font-semibold">
 Judul Pengumuman
 </label>

 <input type="text"
 name="judul"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 value="{{ old('judul') }}"
 placeholder="Masukkan judul pengumuman">

 </div>

 {{-- ISI --}}
 <div class="mb-4">

 <label class="form-label font-semibold">
 Isi Pengumuman
 </label>

 <textarea
 name="isi"
 rows="8"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="Tuliskan isi pengumuman">{{ old('isi') }}</textarea>

 </div>

 <div class="flex flex-wrap -mx-3">

 {{-- GAMBAR --}}
 <div class="w-full md:w-1/2 px-3 mb-4">

 <label class="form-label font-semibold">
 Gambar Pengumuman
 </label>

 <input type="file"
 name="gambar"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">

 <small class="text-slate-500">
 Format JPG, PNG maksimal 2MB.
 </small>

 </div>

 {{-- STATUS --}}
 <div class="w-full md:w-1/4 px-3 mb-4">

 <label class="form-label font-semibold">
 Status
 </label>

 <select name="status"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">

 <option value="draft">
 Draft
 </option>

 <option value="publish">
 Publish
 </option>

 </select>

 </div>

 {{-- TANGGAL --}}
 <div class="w-full md:w-1/4 px-3 mb-4">

 <label class="form-label font-semibold">
 Tanggal Publish
 </label>

 <input type="date"
 name="tanggal_publish"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 value="{{ old('tanggal_publish') }}">

 </div>

 </div>

 {{-- BUTTON --}}
 <div class="mt-6">

 <button type="submit"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

 <i class="fa-solid fa-save mr-2"></i>

 Simpan Pengumuman

 </button>

 <a href="{{ route('admin.website.pengumuman.index') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-white text-slate-700 border border-slate-300 hover:bg-slate-50 shadow-sm">

 Batal

 </a>

 </div>

 </form>

 </div>

 </div>

</div>

@endsection