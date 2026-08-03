@extends('layouts.admin')

@section('title', 'Tambah Penduduk')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-muted mb-0">
                Tambahkan data penduduk baru.
            </p>
        </div>

        <a href="{{ route('admin.penduduk.index') }}"
            class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form
                action="{{ route('admin.penduduk.store') }}"
                method="POST">

                @csrf
                @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Terjadi kesalahan:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                @include('admin.kependudukan.penduduk.form')

                <div class="mt-3">
                    <button class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection