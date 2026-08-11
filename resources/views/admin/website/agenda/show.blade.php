@extends('layouts.admin')


@section('title', 'Detail Agenda')


@section('content')


<div class="w-full">


 {{-- HEADER --}}
 <div class="flex justify-between items-center mb-6">


 <div>

 <h3 class="font-bold mb-1">
 Detail Agenda
 </h3>


 <p class="text-slate-500 mb-0">
 Informasi lengkap kegiatan Kelurahan Bongki.
 </p>


 </div>




 <div>


 <a href="{{ route('admin.website.agenda.edit',$agenda->id) }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-amber-500 text-white hover:bg-amber-600 shadow-sm mr-2">


 <i class="fa-solid fa-pen-to-square mr-1"></i>

 Edit


 </a>



 <a href="{{ route('admin.website.agenda.index') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600">


 <i class="fa-solid fa-arrow-left mr-1"></i>

 Kembali


 </a>


 </div>



 </div>








 <div class="flex flex-wrap -mx-3">



 {{-- INFORMASI UTAMA --}}
 <div class="w-full lg:w-2/3 px-3">


 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">


 <div class="p-6">



 <h4 class="font-bold mb-4">

 {{ $agenda->judul }}

 </h4>





 <div class="mb-6">


 @if($agenda->status == 'aktif')


 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">

 Aktif

 </span>


 @else


 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">

 Nonaktif

 </span>


 @endif


 </div>







 <h6 class="font-bold">

 Deskripsi Kegiatan

 </h6>



 <p class="text-slate-500" style="text-align: justify; text-justify: inter-word;">

 {{ $agenda->deskripsi ?: 'Tidak ada deskripsi kegiatan.' }}

 </p>




 </div>


 </div>


 </div>







 {{-- DETAIL WAKTU --}}
 <div class="w-full lg:w-1/3 px-3">


 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">


 <div class="p-6">



 <h5 class="font-bold mb-6">

 Informasi Agenda

 </h5>





 <div class="mb-4">


 <small class="text-slate-500 block">

 <i class="fa-solid fa-calendar-event mr-2"></i>

 Tanggal

 </small>


 <strong>

 {{ 
 $agenda->tanggal
 ? $agenda->tanggal->format('d F Y')
 : '-'
 }}

 </strong>


 </div>








 <div class="mb-4">


 <small class="text-slate-500 block">


 <i class="fa-solid fa-clock mr-2"></i>

 Waktu


 </small>



 <strong>

 {{ $agenda->waktu ?? '-' }}

 WITA

 </strong>


 </div>







 <div class="mb-4">


 <small class="text-slate-500 block">


 <i class="fa-solid fa-geo-alt mr-2"></i>

 Lokasi


 </small>



 <strong>

 {{ $agenda->lokasi ?? '-' }}

 </strong>


 </div>







 <div>


 <small class="text-slate-500 block">


 <i class="fa-solid fa-clock-history mr-2"></i>

 Dibuat


 </small>


 <strong>

 {{ $agenda->created_at->format('d M Y H:i') }}

 </strong>


 </div>




 </div>


 </div>



 </div>




 </div>




</div>


@endsection