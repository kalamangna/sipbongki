@extends('layouts.admin')

@section('title', 'Tambah Permohonan Surat')

@section('content')

<div class="w-full">

 <div class="flex justify-between items-center mb-6">

 <div>


 </div>

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">

 <div class="p-6">

 <form
 action="{{ route('admin.permohonan-surat.store') }}"
 method="POST">

 @csrf

 @include('admin.pelayanan.permohonan-surat.form')

 </form>

 </div>

 </div>

</div>

@endsection