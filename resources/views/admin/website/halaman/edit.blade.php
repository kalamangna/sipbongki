@extends('layouts.admin')


@section('title','Edit Halaman Website')


@section('content')


<div class="w-full">


<div class="flex justify-between items-center mb-6">


<div>

<h3 class="font-bold mb-1">

Edit Halaman

</h3>


<p class="text-slate-500 mb-0">

Perbarui informasi halaman SIP Bongki.

</p>


</div>


</div>







@if($errors->any())

<div class="p-4 mb-4 text-sm text-red-800 rounded-xl bg-red-50 border border-red-200">

<ul class="mb-0">

@foreach($errors->all() as $error)

<li>
{{ $error }}
</li>

@endforeach

</ul>

</div>

@endif







<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">


<div class="p-6">



<form action="{{ route('admin.website.halaman.update',$halaman->id) }}"
method="POST"
enctype="multipart/form-data">


@csrf

@method('PUT')







<div class="mb-4">


<label class="form-label font-semibold">

Judul Halaman

</label>


<input type="text"
name="judul"
class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
value="{{ old('judul',$halaman->judul) }}">


</div>







<div class="mb-4">


<label class="form-label font-semibold">

Isi Halaman

</label>


<textarea
name="isi"
rows="10"
class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">{{ old('isi',$halaman->isi) }}</textarea>


</div>







<div class="mb-4">


<label class="form-label font-semibold">

Gambar Saat Ini

</label>



@if($halaman->gambar)


<div class="mb-2">

<img src="{{ asset('storage/'.$halaman->gambar) }}"
width="180"
class="rounded shadow-sm">


</div>


@else


<p class="text-slate-500">

Belum ada gambar.

</p>


@endif



<label class="form-label">

Ganti Gambar

</label>


<input type="file"
name="gambar"
class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">


</div>







<div class="mb-4">


<label class="form-label font-semibold">

Status

</label>


<select name="status"
class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">


<option value="aktif"
{{ $halaman->status=='aktif'?'selected':'' }}>

Aktif

</option>


<option value="draft"
{{ $halaman->status=='draft'?'selected':'' }}>

Draft

</option>


</select>


</div>







<button class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

<i class="fa-solid fa-save mr-2"></i>

Update Halaman

</button>




<a href="{{ route('admin.website.halaman.index') }}"
class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600">

Kembali

</a>




</form>


</div>


</div>


</div>


@endsection