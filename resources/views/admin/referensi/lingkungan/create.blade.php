@extends('layouts.admin')

@section('title', 'Tambah Lingkungan')

@section('content')

<x-ui.page-header
 title="Tambah Lingkungan"
 subtitle="Menambahkan data lingkungan baru">

 <a href="{{ route('admin.lingkungan.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600">
 <i class="fa-solid fa-arrow-left"></i>
 Kembali
 </a>

</x-ui.page-header>

<x-ui.workspace>

<x-ui.card>

<form action="{{ route('admin.lingkungan.store') }}" method="POST">

 @csrf

 @include('admin.referensi.lingkungan.form')

 <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

 <i class="fa-solid fa-save"></i>

 Simpan

 </button>

</form>