@extends('layouts.admin')

@section('title', 'Edit Berita')


@section('content')

<div class="w-full">


 {{-- HEADER --}}
 <div class="flex justify-between items-center mb-6">


 <div>

 <h3 class="font-bold mb-1">
 Edit Berita
 </h3>


 <p class="text-slate-500 mb-0">
 Perbarui informasi berita Kelurahan Bongki.
 </p>

 </div>



 <a href="{{ route('admin.website.berita.index') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all shadow-sm-outline-secondary">

 <i class="fa-solid fa-arrow-left"></i>

 Kembali

 </a>


 </div>





 {{-- FORM --}}

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">


 <div class="p-6">


 <form action="{{ route('admin.website.berita.update', $berita->id) }}"
 method="POST"
 enctype="multipart/form-data">


 @csrf

 @method('PUT')



 {{-- JUDUL --}}

 <div class="mb-4">

 <label class="form-label font-semibold">
 Judul Berita
 </label>


 <input type="text"
 name="judul"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error('judul') is-invalid @enderror"
 value="{{ old('judul', $berita->judul) }}">


 @error('judul')

 <div class="invalid-feedback">
 {{ $message }}
 </div>

 @enderror


 </div>





 {{-- ISI --}}

 <div class="mb-4">

 <label class="form-label font-semibold">
 Isi Berita
 </label>


 <textarea
 name="isi"
 rows="8"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error('isi') is-invalid @enderror">{{ old('isi', $berita->isi) }}</textarea>



 @error('isi')

 <div class="invalid-feedback">
 {{ $message }}
 </div>

 @enderror


 </div>





 {{-- GAMBAR LAMA --}}

 @if($berita->gambar)

 <div class="mb-4">

 <label class="form-label font-semibold">
 Gambar Saat Ini
 </label>


 <br>


 <img src="{{ asset('storage/'.$berita->gambar) }}"
 width="220"
 class="rounded shadow-sm">


 </div>

 @endif






 {{-- GAMBAR BARU --}}

 <div class="mb-4">

 <label class="form-label font-semibold">
 Ganti Gambar
 </label>


 <input type="file"
 name="gambar"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error('gambar') is-invalid @enderror">


 <small class="text-slate-500">
 Kosongkan jika tidak ingin mengganti gambar.
 </small>



 @error('gambar')

 <div class="invalid-feedback">
 {{ $message }}
 </div>

 @enderror


 </div>







 {{-- STATUS --}}

 <div class="mb-4">

 <label class="form-label font-semibold">
 Status Publikasi
 </label>


 <select name="status"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">


 <option value="draft"
 {{ $berita->status == 'draft' ? 'selected' : '' }}>
 Draft
 </option>


 <option value="publish"
 {{ $berita->status == 'publish' ? 'selected' : '' }}>
 Publish
 </option>


 </select>


 </div>







 {{-- TANGGAL --}}

 <div class="mb-6">

 <label class="form-label font-semibold">
 Tanggal Publish
 </label>


 <input type="date"
 name="tanggal_publish"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 value="{{ old(
 'tanggal_publish',
 optional($berita->tanggal_publish)->format('Y-m-d')
 ) }}">


 </div>







 <button type="submit"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">


 <i class="fa-solid fa-save"></i>

 Simpan Perubahan


 </button>



 </form>


 </div>


 </div>


</div>


@endsection