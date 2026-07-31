@extends('layouts.admin')


@section('title','Detail Halaman')


@section('content')


<div class="container-fluid">



<div class="d-flex justify-content-between align-items-center mb-4">


<div>

<h3 class="fw-bold mb-1">

{{ $halaman->judul }}

</h3>


<p class="text-muted">

Detail informasi halaman website.

</p>


</div>



<a href="{{ route('admin.website.halaman.edit',$halaman->id) }}"
class="btn btn-warning">


<i class="bi bi-pencil me-2"></i>

Edit


</a>


</div>






<div class="card border-0 shadow-sm">


<div class="card-body">





<div class="mb-3">


<h6 class="fw-bold">

Slug

</h6>


<p>

{{ $halaman->slug }}

</p>


</div>







<div class="mb-3">


<h6 class="fw-bold">

Status

</h6>


@if($halaman->status == 'aktif')


<span class="badge bg-success">

Aktif

</span>


@else


<span class="badge bg-secondary">

Draft

</span>


@endif


</div>







<hr>





<h5 class="fw-bold mb-3">

Isi Halaman

</h5>




<div class="content-page">


{!! nl2br(e($halaman->isi)) !!}


</div>




</div>


</div>


</div>



@endsection