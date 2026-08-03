@extends('layouts.admin')

@section('title', 'Edit Kartu Keluarga')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            
            <p class="text-muted mb-0">
                Perbarui Data Kartu Keluarga
            </p>
        </div>

        <a
            href="{{ route('admin.kartu-keluarga.index') }}"
            class="btn btn-secondary">

            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terdapat kesalahan:</strong>

            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form
                action="{{ route('admin.kartu-keluarga.update', $kartuKeluarga->id) }}"
                method="POST">

                @csrf
                @method('PUT')

                @include(
                    'admin.kependudukan.kartu-keluarga.form'
                )

                <div class="mt-4">
                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="fa-solid fa-floppy-disk"></i>
                        Perbarui
                    </button>

                    <a
                        href="{{ route('admin.kartu-keluarga.index') }}"
                        class="btn btn-light border">

                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection