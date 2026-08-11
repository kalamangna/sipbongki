@extends('layouts.admin')


@section('title', 'Pengaturan Website')


@section('content')


<div class="w-full">


 {{-- HEADER --}}
 <div class="flex justify-between items-center mb-6">


 <div>

 <p class="text-slate-500 mb-0">
 Kelola identitas dan informasi utama website
 </p>


 </div>





 <a href="{{ route('admin.website.pengaturan.edit') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">


 <i class="fa-solid fa-pen-to-square-square mr-2"></i>

 Edit Pengaturan


 </a>


 </div>







 



 <div class="flex flex-wrap -mx-3">







 {{-- LOGO --}}
<div class="w-full lg:w-1/3 px-3">
 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 h-100">
 <div class="p-6 flex flex-column">

 <h5 class="font-bold text-center mb-6">
 Logo Website
 </h5>

 <div class="flex-grow-1 flex justify-center items-center">
 @if($setting && $setting->logo)

 <img
 src="{{ asset('storage/'.$setting->logo) }}"
 alt="Logo Website"
 class="img-fluid"
 style="
 max-width:220px;
 max-height:220px;
 object-fit:contain;
 display:block;
 ">

 @else

 <div class="text-center text-slate-500">
 <i class="fa-solid fa-image "></i>
 <p class="mt-2 mb-0">
 Logo belum tersedia
 </p>
 </div>

 @endif
 </div>

 </div>
 </div>
</div>



 {{-- INFORMASI WEBSITE --}}

 <div class="w-full lg:w-2/3 px-3">


 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">


 <div class="p-6">



 <h5 class="font-bold mb-6">

 Informasi Website

 </h5>






 <table class="w-full text-sm text-left text-slate-600">



 <tr>

 <th width="220" class="px-4 py-3 font-medium text-slate-700">
 Nama Website
 </th>


 <td class="px-4 py-3 border-b border-slate-100">

 {{ $setting->nama_website ?? '-' }}

 </td>


 </tr>







 <tr>

 <th class="px-4 py-3 font-medium text-slate-700">
 Nama Kelurahan
 </th>


 <td class="px-4 py-3 border-b border-slate-100">

 {{ $setting->nama_kelurahan ?? '-' }}

 </td>


 </tr>







 <tr>

 <th class="px-4 py-3 font-medium text-slate-700">
 Telepon
 </th>


 <td class="px-4 py-3 border-b border-slate-100">

 {{ $setting->telepon ?? '-' }}

 </td>


 </tr>







 <tr>

 <th class="px-4 py-3 font-medium text-slate-700">
 Email
 </th>


 <td class="px-4 py-3 border-b border-slate-100">

 {{ $setting->email ?? '-' }}

 </td>


 </tr>







 <tr>

 <th class="px-4 py-3 font-medium text-slate-700">
 Alamat
 </th>


 <td class="px-4 py-3 border-b border-slate-100">

 {{ $setting->alamat ?? '-' }}

 </td>


 </tr>





 </table>




 </div>


 </div>



 </div>









 {{-- SOSIAL MEDIA --}}

 <div class="w-full px-3">


 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">


 <div class="p-6">



 <h5 class="font-bold mb-6">

 Sosial Media

 </h5>






 <div class="flex flex-wrap -mx-3">



 <div class="w-full md:w-1/3 px-3 mb-4">


 <strong>
 Facebook
 </strong>


 <p class="text-slate-500 mb-0">

 {{ $setting->facebook ?? '-' }}

 </p>


 </div>






 <div class="w-full md:w-1/3 px-3 mb-4">


 <strong>
 Instagram
 </strong>


 <p class="text-slate-500 mb-0">

 {{ $setting->instagram ?? '-' }}

 </p>


 </div>







 <div class="w-full md:w-1/3 px-3 mb-4">


 <strong>
 Youtube
 </strong>


 <p class="text-slate-500 mb-0">

 {{ $setting->youtube ?? '-' }}

 </p>


 </div>




 </div>




 </div>


 </div>


 </div>









 {{-- DESKRIPSI --}}

 <div class="w-full px-3">


 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">


 <div class="p-6">


 <h5 class="font-bold mb-4">

 Deskripsi Website

 </h5>



 <p class="text-slate-500">

 {{ $setting->deskripsi ?? 'Belum ada deskripsi.' }}

 </p>



 </div>


 </div>


 </div>






 </div>


</div>


@endsection