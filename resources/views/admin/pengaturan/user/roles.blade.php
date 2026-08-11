@extends('layouts.admin')

@section('title', 'Hak Akses')

@section('content')
<div class="w-full">

 <div class="flex justify-between items-center mb-6">

 <div>
 
 <p class="text-slate-500 mb-0">Pengaturan peran pengguna dan hak akses sistem.</p>
 </div>

 </div>

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">
 <div class="p-6">
 <p>Halaman ini menampilkan ringkasan peran yang tersedia dalam sistem untuk akses administrasi.</p>

 <div class="flex flex-wrap -mx-3 mt-6">
 <div class="w-full md:w-1/2 px-3 mb-4">
 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 h-100 p-3">
 <h6 class="mb-2">Administrator</h6>
 <p class="mb-0 text-slate-500">Memiliki akses penuh ke seluruh modul admin.</p>
 </div>
 </div>
 <div class="w-full md:w-1/2 px-3 mb-4">
 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 h-100 p-3">
 <h6 class="mb-2">Operator</h6>
 <p class="mb-0 text-slate-500">Dapat mengelola data kependudukan, persuratan, dan laporan.</p>
 </div>
 </div>
 </div>
 </div>
 </div>

</div>
@endsection
