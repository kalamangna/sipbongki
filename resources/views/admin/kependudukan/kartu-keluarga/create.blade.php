@extends('layouts.admin')

@section('title', 'Tambah Kartu Keluarga')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            
            <p class="text-muted mb-0">
                Tambahkan Data Kartu Keluarga baru
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
                action="{{ route('admin.kartu-keluarga.store') }}"
                method="POST">

                @csrf

                @include(
                    'admin.kependudukan.kartu-keluarga.form'
                )

                <div class="mt-4">
                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan
                    </button>

                    <a
                        href="{{ route('admin.kartu-keluarga.index') }}"
                        class="btn btn-light border">

                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection