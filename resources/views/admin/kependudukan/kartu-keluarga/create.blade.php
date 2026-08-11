@extends('layouts.admin')

@section('title', 'Tambah Kartu Keluarga')

@section('content')

<div class="container-fluid">

    <div class="flex justify-between items-center mb-6">
        <div>
            
            <p class="text-slate-500 mb-0">
                Tambahkan Data Kartu Keluarga baru
            </p>
        </div>

        <a
            href="{{ route('admin.kartu-keluarga.index') }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary">

            <i class="bi bi-arrow-left"></i>
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

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">
        <div class="p-6">

            <form
                action="{{ route('admin.kartu-keluarga.store') }}"
                method="POST">

                @csrf

                @include(
                    'admin.kependudukan.kartu-keluarga.form'
                )

                <div class="mt-6">
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

                        <i class="bi bi-save"></i>
                        Simpan
                    </button>

                    <a
                        href="{{ route('admin.kartu-keluarga.index') }}"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-white text-slate-700 border border-slate-300 hover:bg-slate-50 shadow-sm">

                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection