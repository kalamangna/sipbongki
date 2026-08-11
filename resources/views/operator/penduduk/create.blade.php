@extends('layouts.operator')


@section('title','Tambah Penduduk')


@section(
    'subtitle',
    'Input data penduduk baru Kelurahan Bongki'
)


@section('content')


<div class="dashboard-container">


<div class="card dashboard-card">


<div class="card-header">


<h5 class="fw-bold mb-0">

    Tambah Data Penduduk

</h5>


</div>





<div class="card-body">



<form action="{{ route('operator.penduduk.store') }}"
      method="POST"
      enctype="multipart/form-data">


@csrf





<div class="row g-4">



{{-- NIK --}}

<div class="col-md-6">


<label class="form-label fw-semibold">

NIK

</label>


<input type="text"
       name="nik"
       value="{{ old('nik') }}"
       class="form-control @error('nik') is-invalid @enderror"
       maxlength="16">


@error('nik')

<div class="invalid-feedback">

{{ $message }}

</div>

@enderror


</div>







{{-- Nama --}}

<div class="col-md-6">


<label class="form-label fw-semibold">

Nama Lengkap

</label>


<input type="text"
       name="nama_lengkap"
       value="{{ old('nama_lengkap') }}"
       class="form-control @error('nama_lengkap') is-invalid @enderror">


@error('nama_lengkap')

<div class="invalid-feedback">

{{ $message }}

</div>

@enderror


</div>









{{-- Jenis Kelamin --}}

<div class="col-md-4">


<label class="form-label fw-semibold">

Jenis Kelamin

</label>


<select name="jenis_kelamin"
        class="form-select">


<option value="">

Pilih

</option>


<option value="L">

Laki-laki

</option>


<option value="P">

Perempuan

</option>


</select>


</div>







{{-- Tempat Lahir --}}

<div class="col-md-4">


<label class="form-label fw-semibold">

Tempat Lahir

</label>


<input type="text"
       name="tempat_lahir"
       value="{{ old('tempat_lahir') }}"
       class="form-control">


</div>








{{-- Tanggal Lahir --}}

<div class="col-md-4">


<label class="form-label fw-semibold">

Tanggal Lahir

</label>


<input type="date"
       name="tanggal_lahir"
       value="{{ old('tanggal_lahir') }}"
       class="form-control">


</div>









{{-- Agama --}}

<div class="col-md-4">


<label class="form-label fw-semibold">

Agama

</label>


<select name="agama"
        class="form-select">


<option value="">

Pilih Agama

</option>


<option>Islam</option>

<option>Kristen</option>

<option>Katolik</option>

<option>Hindu</option>

<option>Buddha</option>

<option>Konghucu</option>


</select>


</div>








{{-- Pendidikan --}}

<div class="col-md-4">


<label class="form-label fw-semibold">

Pendidikan

</label>


<select name="pendidikan"
        class="form-select">


<option value="">

Pilih Pendidikan

</option>


<option>SD</option>

<option>SMP</option>

<option>SMA</option>

<option>D1</option>

<option>D2</option>

<option>D3</option>

<option>S1</option>

<option>S2</option>

<option>S3</option>


</select>


</div>








{{-- Pekerjaan --}}

<div class="col-md-4">


<label class="form-label fw-semibold">

Pekerjaan

</label>


<input type="text"
       name="pekerjaan"
       value="{{ old('pekerjaan') }}"
       class="form-control">


</div>









{{-- Alamat --}}

<div class="col-md-12">


<label class="form-label fw-semibold">

Alamat

</label>


<textarea name="alamat"
          rows="3"
          class="form-control">{{ old('alamat') }}</textarea>


</div>









{{-- RT --}}

<div class="col-md-3">


<label class="form-label fw-semibold">

RT

</label>


<input type="text"
       name="rt"
       value="{{ old('rt','00') }}"
       class="form-control">


</div>









{{-- RW --}}

<div class="col-md-3">


<label class="form-label fw-semibold">

RW

</label>


<input type="text"
       name="rw"
       value="{{ old('rw','00') }}"
       class="form-control">


</div>









{{-- Lingkungan --}}

<div class="col-md-6">


<label class="form-label fw-semibold">

Lingkungan

</label>


<select name="lingkungan_id"
        class="form-select">


<option value="">

Pilih Lingkungan

</option>



@foreach($lingkungan as $item)


<option value="{{ $item->id }}">

{{ $item->nama }}

</option>


@endforeach



</select>


</div>









{{-- KK --}}

<div class="col-md-6">


<label class="form-label fw-semibold">

Kartu Keluarga

</label>


<select name="kartu_keluarga_id"
        class="form-select">


<option value="">

Belum Terhubung KK

</option>



@foreach($kartuKeluarga as $kk)


<option value="{{ $kk->id }}">


{{ $kk->no_kk }}

-
{{ $kk->kepalaKeluarga->nama_lengkap ?? '' }}


</option>


@endforeach



</select>


</div>








{{-- Foto --}}

<div class="col-md-6">


<label class="form-label fw-semibold">

Foto Penduduk

</label>


<input type="file"
       name="foto"
       class="form-control">


</div>






</div>







<hr class="my-4">






<div class="d-flex justify-content-between">


<a href="{{ route('operator.penduduk.index') }}"
   class="btn btn-light">


    Kembali


</a>





<button type="submit"
        class="btn btn-primary">


<i class="fa-solid fa-save me-2"></i>


Simpan Data Penduduk


</button>



</div>




</form>



</div>


</div>


</div>


@endsection