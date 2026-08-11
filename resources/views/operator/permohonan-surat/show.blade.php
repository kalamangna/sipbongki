@extends('layouts.operator')


@section('title','Detail Permohonan Surat')


@section(
    'subtitle',
    'Informasi permohonan pelayanan surat'
)



@section('content')


<div class="dashboard-container">



{{-- HEADER --}}

<div class="d-flex justify-content-between align-items-center mb-4">


<div>

<h4 class="fw-bold mb-1">

Detail Permohonan Surat

</h4>


<p class="text-muted mb-0">

Informasi pelayanan masyarakat Kelurahan Bongki

</p>


</div>




<a href="{{ route('operator.permohonan-surat.index') }}"
class="btn btn-secondary">


<i class="fa-solid fa-arrow-left me-2"></i>

Kembali


</a>


</div>







<div class="row g-4">



{{-- DATA PEMOHON --}}


<div class="col-xl-8">



<div class="card dashboard-card mb-4">


<div class="card-header">


<h5 class="fw-bold mb-0">

Data Pemohon

</h5>


</div>



<div class="card-body">


<div class="row g-4">



<div class="col-md-6">


<label class="text-muted">

Nama

</label>


<h6 class="fw-bold">

{{ optional($permohonanSurat->penduduk)->nama_lengkap ?? '-' }}

</h6>


</div>





<div class="col-md-6">


<label class="text-muted">

NIK

</label>


<h6>

{{ optional($permohonanSurat->penduduk)->nik ?? '-' }}

</h6>


</div>





<div class="col-md-12">


<label class="text-muted">

Alamat

</label>


<p>

{{ optional($permohonanSurat->penduduk)->alamat ?? '-' }}

</p>


</div>



</div>


</div>


</div>







{{-- INFORMASI SURAT --}}


<div class="card dashboard-card mb-4">


<div class="card-header">


<h5 class="fw-bold mb-0">

Informasi Surat

</h5>


</div>



<div class="card-body">



<div class="row g-4">


<div class="col-md-6">


<label class="text-muted">

Jenis Surat

</label>


<h6 class="fw-bold">

{{ optional($permohonanSurat->jenisSurat)->nama ?? '-' }}

</h6>


</div>





<div class="col-md-6">


<label class="text-muted">

Tanggal Permohonan

</label>


<h6>

{{ $permohonanSurat->created_at->format('d-m-Y') }}

</h6>


</div>




<div class="col-md-12">


<label class="text-muted">

Keperluan

</label>


<p>

{{ $permohonanSurat->keperluan ?? '-' }}

</p>


</div>


</div>


</div>


</div>



</div>









{{-- SIDEBAR --}}


<div class="col-xl-4">



<div class="card dashboard-card">


<div class="card-header">


<h5 class="fw-bold mb-0">

Status Pelayanan

</h5>


</div>



<div class="card-body text-center">



@if($permohonanSurat->status == 'Selesai')


<span class="badge bg-success fs-6">

Selesai

</span>


@elseif($permohonanSurat->status == 'Diproses')


<span class="badge bg-warning fs-6">

Diproses

</span>


@else


<span class="badge bg-secondary fs-6">

{{ $permohonanSurat->status }}

</span>


@endif





<hr>



<a href="{{ route('operator.permohonan-surat.preview',$permohonanSurat) }}"
class="btn btn-success w-100 mb-2">


<i class="fa-solid fa-file-lines me-2"></i>

Preview Surat


</a>




<a href="{{ route('operator.permohonan-surat.print',$permohonanSurat) }}"
target="_blank"
class="btn btn-primary w-100">


<i class="fa-solid fa-print me-2"></i>

Cetak Surat


</a>



</div>


</div>


</div>



</div>



</div>


@endsection