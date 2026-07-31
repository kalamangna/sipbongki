@extends('layouts.operator')


@section('title','Tambah Kartu Keluarga')


@section('content')


<div class="dashboard-container">


<div class="card dashboard-card">


<div class="card-header">

<h5 class="fw-bold mb-0">
Tambah Kartu Keluarga
</h5>

</div>



<div class="card-body">


<form action="{{ route('operator.kartu-keluarga.store') }}"
method="POST">


@csrf


@include(
'operator.kartu-keluarga.form'
)



<div class="mt-4">


<button class="btn btn-primary">

<i class="fa-solid fa-save"></i>

Simpan

</button>



<a href="{{ route('operator.kartu-keluarga.index') }}"
class="btn btn-secondary">

Batal

</a>


</div>


</form>


</div>


</div>


</div>


@endsection