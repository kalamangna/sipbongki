@extends('layouts.admin')

@section('title', 'Tambah Lingkungan')

@section('content')

<x-ui.page-header
    title="Tambah Lingkungan"
    subtitle="Menambahkan data lingkungan baru">

    <a href="{{ route('admin.lingkungan.index') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i>
        Kembali
    </a>

</x-ui.page-header>

<x-ui.workspace>

<x-ui.card>

<form action="{{ route('admin.lingkungan.store') }}" method="POST">

    @csrf

    @include('admin.referensi.lingkungan.form')

    <button type="submit" class="btn btn-primary">

        <i class="fa-solid fa-floppy-disk"></i>

        Simpan

    </button>

</form>