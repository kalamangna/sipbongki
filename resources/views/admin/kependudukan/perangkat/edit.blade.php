@extends("layouts.admin")

@section("title", "Edit Perangkat Kelurahan")

@section("content")
<div class="w-full">

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Edit Perangkat</h2>
            <p class="text-sm text-slate-500 mt-1">Perbarui data perangkat atas nama <span class="font-semibold text-slate-700">{{ $perangkat->nama_lengkap }}</span>.</p>
        </div>
        <a href="{{ route('admin.perangkat.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5">
            <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.perangkat.update', $perangkat->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method("PUT")
        
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

        <div class="bg-white rounded-3xl ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] overflow-hidden">
            <div class="p-6 md:p-8">
                @include("admin.kependudukan.perangkat.form")
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] flex justify-end gap-3 items-center">
            <a href="{{ route('admin.perangkat.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm">
                Batal
            </a>
            <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm hover:-translate-y-0.5 shadow-primary-500/20">
                <i class="fa-solid fa-save"></i> Perbarui Data
            </button>
        </div>
    </form>

</div>
@endsection