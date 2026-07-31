@extends('layouts.operator')


@section('title','Tambah Permohonan Surat')


@section(
    'subtitle',
    'Pembuatan pelayanan surat masyarakat'
)



@section('content')


<div class="dashboard-container">


<div class="card dashboard-card">


<div class="card-header">


<h5 class="fw-bold mb-0">

Tambah Permohonan Surat

</h5>


</div>



<div class="card-body">


<form
action="{{ route('operator.permohonan-surat.store') }}"
method="POST">


@csrf


@include(
    'operator.permohonan-surat.form'
)



<div class="mt-4">


<button type="submit"
class="btn btn-primary">


<i class="fa-solid fa-save me-2"></i>

Simpan Permohonan


</button>




<a href="{{ route('operator.permohonan-surat.index') }}"
class="btn btn-secondary">


Kembali


</a>


</div>



</form>


</div>


</div>


</div>


@endsection