@extends('layouts.admin')

@section('title', 'Tambah Jenis Surat')

@section('content')

<div class="container-fluid">

    <div class="mb-6">

        <h3 class="font-bold mb-1">

            Tambah Jenis Surat

        </h3>

        <p class="text-slate-500">

            Tambahkan jenis surat baru.

        </p>

    </div>

    <form
        action="{{ route('admin.jenis-surat.store') }}"
        method="POST">

        @include('admin.referensi.jenis-surat.form')

    </form>

</div>

@endsection