@extends('layouts.admin')

@section('title', 'Tambah Lingkungan')

@section('content')

<x-ui.page-header
    title="Tambah Lingkungan"
    subtitle="Menambahkan data lingkungan baru">

    <a href="{{ route('admin.lingkungan.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>

</x-ui.page-header>

<x-ui.workspace>

<x-ui.card>

<form action="{{ route('admin.lingkungan.store') }}" method="POST">

    @csrf

    @include('admin.referensi.lingkungan.form')

    <button type="submit" class="btn btn-primary">

        <i class="bi bi-save"></i>

        Simpan

    </button>

</form>