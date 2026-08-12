@extends('layouts.admin')


@section('title', 'Pengaturan Website')


@section('content')


<div class="w-full">


 {{-- HEADER --}}
 <div class="flex justify-between items-center mb-6">


 <div>
 <h3 class="text-2xl font-bold text-slate-800 mb-1">Pengaturan Website</h3>
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







 



 <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">







 {{-- LOGO --}}
<div class="lg:col-span-1 flex flex-col">
 <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex-1">
 <div class="p-6 flex flex-col h-full">

 <h3 class="font-bold text-slate-800 text-base mb-6 text-center">Logo Website</h3>

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

 <div class="lg:col-span-2 flex flex-col">


 <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex-1">


 <div class="p-6">



 <h3 class="font-bold text-slate-800 text-base mb-6">Informasi Website</h3>






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

 <div class="lg:col-span-3 flex flex-col">


 <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex-1">


 <div class="p-6">



 <h3 class="font-bold text-slate-800 text-base mb-6">Sosial Media</h3>






 <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">



 <div class="flex flex-col">


 <strong>
 Facebook
 </strong>


 <p class="text-slate-500 mb-0">

 {{ $setting->facebook ?? '-' }}

 </p>


 </div>






 <div class="flex flex-col">


 <strong>
 Instagram
 </strong>


 <p class="text-slate-500 mb-0">

 {{ $setting->instagram ?? '-' }}

 </p>


 </div>







 <div class="flex flex-col">


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

 <div class="lg:col-span-3 flex flex-col">


 <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex-1">


 <div class="p-6">


 <h3 class="font-bold text-slate-800 text-base mb-4">Deskripsi Website</h3>



 <p class="text-slate-500">

 {{ $setting->deskripsi ?? 'Belum ada deskripsi.' }}

 </p>



 </div>


 </div>


 </div>






 </div>


</div>


@endsection