@extends('layouts.admin')

@section('title', 'Edit Lingkungan')

@section('content')

<x-ui.page-header
title="Edit Lingkungan"
subtitle="Memperbarui data lingkungan">

<a href="{{ route('admin.lingkungan.index') }}" class="btn btn-secondary">

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

    <button type="submit" class="btn btn-primary">

        <i class="fa-solid fa-floppy-disk"></i>

        Update

    </button>

</form>