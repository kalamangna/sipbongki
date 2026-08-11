@extends('layouts.admin')

@section('title', 'Edit Permohonan Surat')

@section('content')

<div class="w-full">

 <div class="flex justify-between items-center mb-6">

 <div>

 <h3 class="font-bold mb-1">
 Edit Permohonan Surat
 </h3>

 <p class="text-slate-500 mb-0">
 Perbarui data permohonan surat.
 </p>

 </div>

 </div>

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">

 <div class="p-6">

 <form
 action="{{ route('admin.permohonan-surat.update', $permohonanSurat) }}"
 method="POST">

 @csrf
 @method('PUT')

 @include('admin.pelayanan.permohonan-surat.form')

 </form>

 </div>

 </div>

</div>

@endsection