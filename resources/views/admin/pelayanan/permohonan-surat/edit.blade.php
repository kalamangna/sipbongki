@extends('layouts.admin')

@section('title', 'Edit Permohonan Surat')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">
                Edit Permohonan Surat
            </h3>

            <p class="text-muted mb-0">
                Perbarui data permohonan surat.
            </p>

        </div>

    </div>

    <div class="card shadow-sm">

        <div class="card-body">

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