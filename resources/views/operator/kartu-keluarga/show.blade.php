@extends('layouts.operator')


@section('title','Detail Kartu Keluarga')


@section('subtitle','Informasi kartu keluarga dan anggota keluarga')


@section('content')


<div class="dashboard-container">


{{-- HEADER --}}

<div class="d-flex justify-content-between align-items-center mb-4">


<div>

<h4 class="fw-bold mb-1">
Detail Kartu Keluarga
</h4>


<p class="text-muted mb-0">
Informasi data keluarga masyarakat Kelurahan Bongki
</p>


</div>



<a href="{{ route('operator.kartu-keluarga.index') }}"
class="btn btn-secondary">

<i class="fa-solid fa-arrow-left me-2"></i>

Kembali

</a>


</div>





{{-- DATA KK --}}


<div class="card dashboard-card mb-4">


<div class="card-header">


<h5 class="fw-bold mb-0">

Data Kartu Keluarga

</h5>


</div>



<div class="card-body">


<div class="row g-4">



<div class="col-md-6">

<label class="text-muted">
Nomor KK
</label>

<h6 class="fw-bold">

{{ $kartuKeluarga->no_kk }}

</h6>

</div>




<div class="col-md-6">

<label class="text-muted">
Kepala Keluarga
</label>


<h6 class="fw-bold">

{{ optional($kartuKeluarga->kepalaKeluarga)->nama_lengkap ?? '-' }}

</h6>


</div>




<div class="col-md-6">

<label class="text-muted">
Lingkungan
</label>


<h6>

{{ optional($kartuKeluarga->lingkungan)->nama ?? '-' }}

</h6>


</div>





<div class="col-md-6">

<label class="text-muted">
RT / RW
</label>


<h6>

{{ $kartuKeluarga->rt ?? '00' }}
/
{{ $kartuKeluarga->rw ?? '00' }}

</h6>


</div>





<div class="col-md-12">

<label class="text-muted">
Alamat
</label>


<p>

{{ $kartuKeluarga->alamat ?? '-' }}

</p>


</div>



</div>


</div>


</div>







{{-- ANGGOTA KELUARGA --}}


<div class="card dashboard-card">


<div class="card-header d-flex justify-content-between">


<h5 class="fw-bold mb-0">

Anggota Keluarga

</h5>


<span class="badge bg-primary">

{{ $kartuKeluarga->anggota->count() }} Orang

</span>


</div>





<div class="table-responsive">


<table class="table table-hover align-middle mb-0">


<thead>


<tr>

<th>No</th>

<th>NIK</th>

<th>Nama</th>

<th>L/P</th>

<th>Hubungan</th>

<th>Status</th>


</tr>


</thead>




<tbody>


@forelse($kartuKeluarga->anggota as $anggota)



<tr>


<td>

{{ $loop->iteration }}

</td>


<td>

{{ $anggota->nik }}

</td>


<td>

<strong>

{{ $anggota->nama_lengkap }}

</strong>

</td>



<td>

@gender($anggota->jenis_kelamin)

</td>



<td>

{{ $anggota->hubungan_keluarga ?? '-' }}

</td>



<td>


@if($anggota->aktif)

<span class="badge bg-success">

Aktif

</span>

@else

<span class="badge bg-danger">

Tidak Aktif

</span>

@endif


</td>



</tr>



@empty


<tr>

<td colspan="6"
class="text-center py-4">


Belum ada anggota keluarga.


</td>

</tr>


@endforelse


</tbody>


</table>


</div>


</div>


</div>

@endsection