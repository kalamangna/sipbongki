@extends('layouts.admin')


@section('title', 'Edit Galeri')


@section('content')


<div class="w-full">


 {{-- HEADER --}}
 <div class="flex justify-between items-center mb-6">


 <div>

 <h3 class="font-bold mb-1">
 Edit Galeri
 </h3>

 <p class="text-slate-500 mb-0">
 Perbarui dokumentasi kegiatan Kelurahan Bongki.
 </p>

 </div>



 <a href="{{ route('admin.website.galeri.index') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600">


 <i class="fa-solid fa-arrow-left mr-2"></i>

 Kembali


 </a>


 </div>







 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">


 <div class="p-6">



 <form action="{{ route('admin.website.galeri.update',$galeri->id) }}"
 method="POST"
 enctype="multipart/form-data">


 @csrf

 @method('PUT')







 {{-- JUDUL --}}

 <div class="mb-4">


 <label class="form-label font-semibold">
 Judul Dokumentasi
 </label>


 <input type="text"
 name="judul"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error('judul') is-invalid @enderror"
 value="{{ old('judul',$galeri->judul) }}">



 @error('judul')

 <div class="invalid-feedback">
 {{ $message }}
 </div>

 @enderror


 </div>










 {{-- DESKRIPSI --}}

 <div class="mb-4">


 <label class="form-label font-semibold">
 Deskripsi
 </label>


 <textarea name="deskripsi"
 rows="4"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error('deskripsi') is-invalid @enderror">{{ old('deskripsi',$galeri->deskripsi) }}</textarea>



 @error('deskripsi')

 <div class="invalid-feedback">
 {{ $message }}
 </div>

 @enderror


 </div>










 {{-- GAMBAR LAMA --}}

 <div class="mb-4">


 <label class="form-label font-semibold">
 Foto Saat Ini
 </label>


 <br>


 <img src="{{ asset('storage/'.$galeri->gambar) }}"
 width="250"
 height="160"
 class="rounded mb-4"
 style="object-fit:cover;">


 </div>









 {{-- UPLOAD GAMBAR BARU --}}

 <div class="mb-4">


 <label class="form-label font-semibold">
 Ganti Foto (Opsional)
 </label>



 <input type="file"
 name="gambar"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error('gambar') is-invalid @enderror"
 accept="image/*"
 onchange="previewImage(event)">



 @error('gambar')

 <div class="invalid-feedback">
 {{ $message }}
 </div>

 @enderror





 <div class="mt-3">


 <img id="preview"
 src="#"
 class="rounded hidden"
 width="250"
 height="160"
 style="object-fit:cover;">


 </div>



 </div>









 {{-- STATUS --}}

 <div class="mb-6">


 <label class="form-label font-semibold">
 Status
 </label>


 <select name="status"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">


 <option value="aktif"
 {{ $galeri->status == 'aktif' ? 'selected' : '' }}>

 Aktif

 </option>



 <option value="nonaktif"
 {{ $galeri->status == 'nonaktif' ? 'selected' : '' }}>

 Nonaktif

 </option>


 </select>


 </div>








 <button type="submit"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">


 <i class="fa-solid fa-save mr-2"></i>

 Update Galeri


 </button>




 </form>



 </div>


 </div>


</div>









<script>

function previewImage(event)
{

 const image = document.getElementById('preview');


 image.src = URL.createObjectURL(
 event.target.files[0]
 );


 image.classList.remove('hidden');

}

</script>




@endsection