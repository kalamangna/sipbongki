@extends('layouts.admin')

@section('title', 'Edit Penduduk')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            
            <p class="text-muted mb-0">
                Update data penduduk.
            </p>
        </div>

        <a href="{{ route('admin.penduduk.index') }}"
            class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Error Validasi</strong>

        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <form
                action="{{ route('admin.penduduk.update', $penduduk) }}"
                method="POST">

                @csrf
                @method('PUT')

                @include('admin.kependudukan.penduduk.form')

                <div class="mt-3">
                    <button class="btn btn-primary">
                        <i class="bi bi-save"></i>
                        Update
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection