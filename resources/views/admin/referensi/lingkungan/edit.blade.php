@extends('layouts.admin')

@section('title', 'Edit Lingkungan')

@section('content')

<x-ui.page-header
title="Edit Lingkungan"
subtitle="Memperbarui data lingkungan">

<a href="{{ route('admin.lingkungan.show', $lingkungan) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600">

<i class="fa-solid fa-arrow-left"></i>

Kembali

</a>

</x-ui.page-header>

<x-ui.workspace>

<x-ui.card>

<form
 action="{{ route('admin.lingkungan.update', $lingkungan) }}"
 method="POST">

 @csrf
 @method('PUT')

 @include('admin.referensi.lingkungan.form')

 <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

 <i class="fa-solid fa-save"></i>

 Update

 </button>

</form>

</x-ui.card>

</x-ui.workspace>

@endsection