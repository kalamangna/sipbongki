@extends('layouts.admin')

@section('title', 'Edit Permohonan Surat')

@section('content')
<div class="w-full">

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Edit Permohonan</h2>
            <p class="text-sm text-slate-500 mt-1">Perbarui data permohonan surat <span class="font-semibold text-slate-700">#{{ $permohonanSurat->nomor_permohonan }}</span></p>
        </div>
        <a href="{{ route('admin.permohonan-surat.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none active:scale-95 cursor-pointer focus:outline-none active:scale-95 cursor-pointer">
            <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.permohonan-surat.update', $permohonanSurat->id) }}" method="POST" class="space-y-6" id="formPermohonan">
        @csrf
        @method('PUT')
        
        @if ($errors->any())
            <div class="p-4 rounded-xl bg-red-50 border border-red-100 flex gap-3 items-start shadow-sm">
                <i class="fa-solid fa-circle-exclamation text-red-500 mt-0.5"></i>
                <div>
                    <h4 class="text-sm font-bold text-red-800">Mohon periksa kembali input Anda:</h4>
                    <ul class="text-sm text-red-600 mt-1 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {{-- Main Form Container --}}
        @include('admin.pelayanan.permohonan-surat.form')

        {{-- Footer Actions --}}
        <div class="bg-slate-50/50 p-6 rounded-2xl border border-slate-200 shadow-sm flex justify-end gap-3 items-center">
            <a href="{{ route('admin.permohonan-surat.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm focus:outline-none active:scale-95 cursor-pointer focus:outline-none active:scale-95 cursor-pointer">
                Batal
            </a>
            <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm hover:-translate-y-0.5 shadow-primary-500/20 focus:outline-none focus:ring-2 focus:ring-primary-500 active:scale-95 cursor-pointer focus:outline-none active:scale-95 cursor-pointer">
                <i class="fa-solid fa-save"></i> Perbarui Permohonan
            </button>
        </div>
    </form>

</div>
@endsection