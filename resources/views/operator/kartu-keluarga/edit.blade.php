@extends('layouts.operator')


@section('title','Edit Kartu Keluarga')


@section('content')


<div class="dashboard-container">


<div class="card dashboard-card">


<div class="card-header">

<h5 class="fw-bold">
Edit Kartu Keluarga
</h5>

</div>



<div class="card-body">


<form action="{{ route('operator.kartu-keluarga.update',$kartuKeluarga->id) }}"
method="POST">


@csrf

@method('PUT')


@include(
'operator.kartu-keluarga.form'
)



<button class="btn btn-primary">

Update

</button>


<a href="{{ route('operator.kartu-keluarga.index') }}"
class="btn btn-secondary">

Kembali

</a>


</form>


</div>


</div>


</div>


@endsection