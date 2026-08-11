@extends('layouts.admin')

@section('title', 'Detail Berita')


@section('content')

<div class="w-full">


 {{-- HEADER --}}
 <div class="flex justify-between items-center mb-6">


 <div>

 <h3 class="font-bold mb-1">
 Detail Berita
 </h3>


 <p class="text-slate-500 mb-0">
 Informasi lengkap berita Kelurahan Bongki.
 </p>

 </div>



 <div class="flex gap-2">


 <a href="{{ route('admin.website.berita.index') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600">


 <i class="fa-solid fa-arrow-left"></i>

 Kembali


 </a>


 <a href="{{ route('admin.website.berita.edit', $berita) }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-amber-500 text-white hover:bg-amber-600 shadow-sm">


 <i class="fa-solid fa-pen-to-square-square"></i>

 Edit


 </a>


 </div>


 </div>







 <div class="flex flex-wrap -mx-3">



 {{-- KONTEN BERITA --}}
 <div class="w-full lg:w-2/3 px-3">


 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">


 <div class="p-6">



 <h2 class="font-bold mb-4" style="text-align: justify; text-justify: inter-word;">

 {{ $berita->judul }}

 </h2>





 <div class="flex gap-3 text-slate-500 mb-6">


 <span>

 <i class="fa-solid fa-calendar-event"></i>

 {{ optional($berita->tanggal_publish)->format('d M Y') ?? '-' }}

 </span>



 <span>

 <i class="fa-solid fa-circle-fill small"></i>

 {{ ucfirst($berita->status) }}

 </span>


 </div>






 @if($berita->gambar)


 <div class="mb-6">


 <img src="{{ asset('storage/'.$berita->gambar) }}"
 class="img-fluid rounded shadow-sm"
 style="width:100%; max-width:100%; max-height:420px; object-fit:cover;"
 alt="{{ $berita->judul }}">


 </div>


 @endif







 <div class="article-content" style="text-align: justify; text-justify: inter-word;">


 {!! nl2br(e($berita->isi)) !!}


 </div>



 </div>


 </div>


 </div>









 {{-- INFORMASI --}}
 <div class="w-full lg:w-1/3 px-3">


 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">


 <div class="px-6 py-4 border-b border-slate-200 bg-white">


 <h5 class="font-bold mb-0">

 Informasi Berita

 </h5>


 </div>





 <div class="p-6">



 <div class="mb-4">


 <small class="text-slate-500 block">
 Judul
 </small>


 <div style="text-align: justify; text-justify: inter-word;">
 {{ $berita->judul }}
 </div>


 </div>






 <div class="mb-4">


 <small class="text-slate-500 block">
 Slug
 </small>


 <div style="text-align: justify; text-justify: inter-word;">
 {{ $berita->slug }}
 </div>


 </div>






 <div class="mb-4">


 <small class="text-slate-500 block">
 Status
 </small>



 @if($berita->status == 'publish')


 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">

 Publish

 </span>


 @else


 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">

 Draft

 </span>


 @endif


 </div>







 <div class="mb-4">


 <small class="text-slate-500 block">
 Dibuat
 </small>


 <span>

 {{ $berita->created_at->format('d M Y H:i') }} WITA

 </span>


 </div>







 <div>


 <small class="text-slate-500 block">
 Terakhir diperbarui
 </small>


 <span>

 {{ $berita->updated_at->format('d M Y H:i') }} WITA

 </span>


 </div>



 </div>


 </div>


 </div>




 </div>


</div>


@endsection