@extends("layouts.admin")

@section("title", "Tambah Perangkat Kelurahan")

@section("content")
<div class="w-full">

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight dark:text-slate-100">Tambah Aparatur</h2>
            <p class="text-sm text-slate-500 mt-1 dark:text-slate-400">Tambahkan data aparatur dan perangkat kelurahan baru.</p>
        </div>
        <a href="{{ route('admin.perangkat.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none active:scale-95 cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white">
            <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.perangkat.store') }}" method="POST" enctype="multipart/form-data" id="formPerangkat">
        @csrf

        {{-- Main Form Card --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
            <div class="p-4 sm:p-6 md:p-8 space-y-8">
                @include("admin.kependudukan.perangkat.form")

            </div>
            
            <div class="bg-slate-50/50 border-t border-slate-200 px-4 sm:px-6 md:px-8 py-4 flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-3 dark:bg-slate-800/50 dark:border-slate-800">
                <a href="{{ route('admin.perangkat.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm focus:outline-none active:scale-95 cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white">
                    Batal
                </a>
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm hover:-translate-y-0.5 shadow-primary-500/20 focus:outline-none focus:ring-2 focus:ring-primary-500 cursor-pointer active:scale-95">
                    <i class="fa-solid fa-save"></i> Simpan Data
                </button>
            </div>
        </div>
    </form>

</div>
@endsection