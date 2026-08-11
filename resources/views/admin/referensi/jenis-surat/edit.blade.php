@extends('layouts.admin')

@section('title', 'Edit Jenis Surat')

@section('content')

<div class="container-fluid">

    <div class="mb-6">

        <h3 class="font-bold mb-1">

            Edit Jenis Surat

        </h3>

        <p class="text-slate-500">

            Perbarui data jenis surat.

        </p>

    </div>

    <form
        action="{{ route('admin.jenis-surat.update',$jenisSurat) }}"
        method="POST">

        @method('PUT')

        @include('admin.referensi.jenis-surat.form')

    </form>

</div>

@endsection