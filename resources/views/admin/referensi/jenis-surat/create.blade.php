@extends('layouts.admin')

@section('title', 'Tambah Jenis Surat')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h3 class="fw-bold mb-1">

            Tambah Jenis Surat

        </h3>

        <p class="text-muted">

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