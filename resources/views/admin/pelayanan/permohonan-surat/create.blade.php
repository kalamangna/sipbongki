@extends('layouts.admin')

@section('title', 'Tambah Permohonan Surat')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>


    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <form
                action="{{ route('admin.permohonan-surat.store') }}"
                method="POST">

                @include('admin.pelayanan.permohonan-surat.form')

            </form>

        </div>

    </div>

</div>

@endsection