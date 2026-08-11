@extends('layouts.admin')


@section('title','Detail Halaman')


@section('content')


<div class="container-fluid">



<div class="flex justify-between items-center mb-6">


<div>

<h3 class="font-bold mb-1">

{{ $halaman->judul }}

</h3>


<p class="text-slate-500">

Detail informasi halaman website.

</p>


</div>



<a href="{{ route('admin.website.halaman.edit',$halaman->id) }}"
class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-amber-500 text-white hover:bg-amber-600 shadow-sm">


<i class="bi bi-pencil mr-2"></i>

Edit


</a>


</div>






<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">


<div class="p-6">





<div class="mb-4">


<h6 class="font-bold">

Slug

</h6>


<p>

{{ $halaman->slug }}

</p>


</div>







<div class="mb-4">


<h6 class="font-bold">

Status

</h6>


@if($halaman->status == 'aktif')


<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">

Aktif

</span>


@else


<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">

Draft

</span>


@endif


</div>







<hr>





<h5 class="font-bold mb-4">

Isi Halaman

</h5>




<div class="content-page">


{!! nl2br(e($halaman->isi)) !!}


</div>




</div>


</div>


</div>



@endsection