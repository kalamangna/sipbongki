@extends('layouts.admin')


@section('title','Tambah Halaman Website')


@section('content')


<div class="container-fluid">


<div class="d-flex justify-content-between align-items-center mb-4">


    <div>

        <h3 class="fw-bold mb-1">
            Tambah Halaman
        </h3>

        <p class="text-muted mb-0">
            Tambahkan informasi halaman publik SiPBongki.
        </p>

    </div>


</div>





@if($errors->any())

<div class="alert alert-danger">

<ul class="mb-0">

@foreach($errors->all() as $error)

<li>
{{ $error }}
</li>

@endforeach

</ul>

</div>

@endif






<div class="card border-0 shadow-sm">


<div class="card-body">


<form action="{{ route('admin.website.halaman.store') }}"
      method="POST"
      enctype="multipart/form-data">


@csrf





<div class="mb-3">


<label class="form-label fw-semibold">

Judul Halaman

</label>


<input type="text"
       name="judul"
       class="form-control"
       value="{{ old('judul') }}"
       placeholder="Contoh: Profil Kelurahan">


</div>







<div class="mb-3">


<label class="form-label fw-semibold">

Isi Halaman

</label>


<textarea
name="isi"
rows="10"
class="form-control"
placeholder="Masukkan isi halaman...">{{ old('isi') }}</textarea>


</div>







<div class="mb-3">


<label class="form-label fw-semibold">

Gambar Halaman

</label>


<input type="file"
       name="gambar"
       class="form-control">


<small class="text-muted">

Format JPG, PNG maksimal 2MB.

</small>


</div>







<div class="mb-3">


<label class="form-label fw-semibold">

Status

</label>


<select name="status"
        class="form-select">


<option value="aktif">

Aktif

</option>


<option value="draft">

Draft

</option>


</select>


</div>







<div class="mt-4">


<button class="btn btn-primary">


<i class="bi bi-save me-2"></i>

Simpan Halaman


</button>




<a href="{{ route('admin.website.halaman.index') }}"
class="btn btn-secondary">


Kembali


</a>


</div>





</form>


</div>


</div>


</div>


@endsection