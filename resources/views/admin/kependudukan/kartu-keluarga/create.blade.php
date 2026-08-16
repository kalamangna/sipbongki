@extends('layouts.admin')

@section('title', 'Tambah Kartu Keluarga')

@section('content')
<div class="w-full">

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Tambah Kartu Keluarga</h2>
            <p class="text-sm text-slate-500 mt-1">Buat data Kartu Keluarga (KK) baru di dalam sistem.</p>
        </div>
        <a href="{{ route('admin.kartu-keluarga.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none">
            <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.kartu-keluarga.store') }}" method="POST" enctype="multipart/form-data" id="formKartuKeluarga">
        @csrf

        {{-- Main Form Card --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 md:p-8 space-y-8">
                @include('admin.kependudukan.kartu-keluarga.form')

            </div>
            
            <div class="bg-slate-50/50 border-t border-slate-200 px-6 md:px-8 py-4 flex items-center justify-end gap-3">
                <a href="{{ route('admin.kartu-keluarga.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm focus:outline-none">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm hover:-translate-y-0.5 shadow-primary-500/20 focus:outline-none focus:ring-2 focus:ring-primary-500 cursor-pointer">
                    <i class="fa-solid fa-save"></i> Simpan Data KK
                </button>
            </div>
        </div>
    </form>

</div>
@endsection
