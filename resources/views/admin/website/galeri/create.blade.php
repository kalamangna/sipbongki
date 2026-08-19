@extends('layouts.admin')

@section('title', 'Tambah Galeri')

@section('content')
<div class="w-full">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight dark:text-slate-100">Tambah Galeri</h2>
            <p class="text-sm text-slate-500 mt-1 dark:text-slate-400">Tambahkan dokumentasi kegiatan Kelurahan Bongki.</p>
        </div>
        <a href="{{ route('admin.website.galeri.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none active:scale-95 cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white">
            <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
        </a>
    </div>

    {{-- VALIDATION ERROR --}}
    @if($errors->any())
    <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 flex gap-3 items-start shadow-sm dark:bg-rose-950/40 dark:border-rose-900/60">
        <i class="fa-solid fa-circle-exclamation text-rose-500 mt-0.5 dark:text-rose-400"></i>
        <div>
            <h4 class="text-sm font-bold text-rose-800 dark:text-rose-300">Terdapat Kesalahan</h4>
            <ul class="text-sm text-rose-700 mt-1 list-disc list-inside dark:text-rose-400">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    {{-- Main Form Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
        <form action="{{ route('admin.website.galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="p-4 sm:p-6 md:p-8 space-y-6">
                {{-- Judul --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2 dark:text-slate-300">Judul Dokumentasi</label>
                    <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Gotong Royong Bersama Warga" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2 dark:text-slate-300">Deskripsi (Opsional)</label>
                    <textarea name="deskripsi" rows="4" placeholder="Keterangan dokumentasi..." class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Gambar --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2 dark:text-slate-300">Foto Dokumentasi</label>
                        <input type="file" name="gambar" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3 py-2 transition-colors shadow-sm cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-primary-light file:text-primary hover:file:bg-primary/20 file:cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:file:bg-primary-950/60 dark:file:text-primary-300" accept="image/*" onchange="previewImage(event)">
                        <p class="text-xs text-slate-500 mt-2 dark:text-slate-400">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
                        <div class="mt-4">
                            <img id="preview" src="#" class="hidden w-full max-w-[250px] h-[160px] object-cover rounded-xl shadow-sm border border-slate-200 dark:border-slate-700">
                        </div>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2 dark:text-slate-300">Status Publikasi</label>
                        <select name="status" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                            <option value="aktif" @selected(old('status') == 'aktif')>Aktif</option>
                            <option value="nonaktif" @selected(old('status') == 'nonaktif')>Nonaktif</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Footer / Actions --}}
            <div class="px-4 sm:px-6 md:px-8 py-4 border-t border-slate-100 bg-slate-50/50 flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-3 dark:bg-slate-800/50 dark:border-slate-800">
                <a href="{{ route('admin.website.galeri.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 shadow-sm transition-all focus:outline-none active:scale-95 cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700">
                    Batal
                </a>
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all focus:outline-none active:scale-95 cursor-pointer">
                    <i class="fa-solid fa-save"></i> Simpan Galeri
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(event) {
        const image = document.getElementById('preview');
        if(event.target.files.length > 0) {
            image.src = URL.createObjectURL(event.target.files[0]);
            image.classList.remove('hidden');
        }
    }
</script>
@endpush