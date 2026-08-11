@extends('layouts.admin')

@section('title', 'Tambah Penduduk')

@section('content')
<div class="container-fluid">

    <div class="flex justify-between items-center mb-6">
        <div>
            <p class="text-slate-500 mb-0">
                Tambahkan data penduduk baru.
            </p>
        </div>

        <a href="{{ route('admin.penduduk.index') }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">
        <div class="p-6">

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
                    <button class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">
                        <i class="bi bi-save"></i>
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection