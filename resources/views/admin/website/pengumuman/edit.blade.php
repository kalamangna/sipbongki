@extends('layouts.admin')

@section('title', 'Edit Pengumuman')

@section('content')
<div class="w-full">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight dark:text-slate-100">Edit Pengumuman</h2>
            <p class="text-sm text-slate-500 mt-1 dark:text-slate-400">Perbarui informasi pengumuman Kelurahan Bongki.</p>
        </div>
        <a href="{{ route('admin.website.pengumuman.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none active:scale-95 cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white">
            <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.website.pengumuman.update', $pengumuman) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Main Form Card --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
            <div class="p-4 sm:p-6 md:p-8 space-y-6">

                @if($errors->any())
                <div class="p-4 rounded-xl bg-red-50 border border-red-100 flex gap-3 items-start dark:bg-rose-950/40 dark:border-rose-900/60">
                    <i class="fa-solid fa-circle-exclamation text-red-500 mt-0.5 dark:text-rose-400"></i>
                    <div>
                        <h4 class="text-sm font-bold text-red-800 dark:text-rose-300">Mohon periksa kembali input Anda:</h4>
                        <ul class="text-sm text-red-600 mt-1 list-disc list-inside dark:text-rose-400">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                {{-- Judul --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Judul Pengumuman</label>
                    <input type="text" name="judul" value="{{ old('judul', $pengumuman->judul) }}" placeholder="Masukkan judul pengumuman" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                </div>

                {{-- Isi --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Isi Pengumuman</label>
                    <textarea name="isi" rows="8" placeholder="Tuliskan isi pengumuman..." class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">{{ old('isi', $pengumuman->isi) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    {{-- Gambar --}}
                    <div class="md:col-span-2 lg:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Gambar Baru (Opsional)</label>
                        <div class="flex items-start gap-4">
                            @if($pengumuman->gambar)
                                <img src="{{ asset('storage/'.$pengumuman->gambar) }}" class="w-24 h-24 object-cover rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 shrink-0" alt="Gambar Saat Ini">
                            @endif
                            <div class="flex-1 w-full">
                                <input type="file" name="gambar" accept="image/*" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3 py-2 transition-colors shadow-sm cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-primary-light file:text-primary hover:file:bg-primary/20 file:cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:file:bg-primary-950/60 dark:file:text-primary-300">
                                <p class="text-xs text-slate-500 mt-2 dark:text-slate-400">Format: JPG, JPEG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Status</label>
                        <select name="status" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                            <option value="draft" @selected(old('status', $pengumuman->status) == 'draft')>Draft</option>
                            <option value="publish" @selected(old('status', $pengumuman->status) == 'publish')>Publish</option>
                        </select>
                    </div>

                    {{-- Tanggal --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Tanggal Publish</label>
                        <input type="date" name="tanggal_publish" value="{{ old('tanggal_publish', optional($pengumuman->tanggal_publish)->format('Y-m-d')) }}" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                    </div>
                </div>
            </div>

            {{-- Footer Actions --}}
            <div class="bg-slate-50/50 border-t border-slate-200 px-4 sm:px-6 md:px-8 py-4 flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-3 dark:bg-slate-800/50 dark:border-slate-800">
                <a href="{{ route('admin.website.pengumuman.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm focus:outline-none active:scale-95 cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white">
                    Batal
                </a>
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm hover:-translate-y-0.5 shadow-primary-500/20 focus:outline-none focus:ring-2 focus:ring-primary cursor-pointer active:scale-95">
                    <i class="fa-solid fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection