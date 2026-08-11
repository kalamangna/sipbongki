@extends('layouts.admin')

@section('title', 'Tambah Jabatan')

@section('content')

<div class="w-full">

 <div class="flex flex-wrap -mx-3 justify-center">

 <div class="w-full lg:w-1/2 px-3">

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">

 <div class="px-6 py-4 border-b border-slate-200">

 <h5 class="mb-0">

 Tambah Jabatan

 </h5>

 </div>

 <div class="p-6">

 <form
 action="{{ route('admin.jabatan.store') }}"
 method="POST">

 @csrf

 @include('admin.referensi.jabatan.form')

 </form>

 </div>

 </div>

 </div>

 </div>

</div>

@endsection