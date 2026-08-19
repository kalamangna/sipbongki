@extends('layouts.admin')

@section('title', 'Edit Agenda')

@section('content')
<div class="w-full">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight dark:text-slate-100">Edit Agenda</h2>
            <p class="text-sm text-slate-500 mt-1 dark:text-slate-400">Perbarui informasi kegiatan Kelurahan Bongki.</p>
        </div>
        <a href="{{ route('admin.website.agenda.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none active:scale-95 cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white">
            <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.website.agenda.update', $agenda->id) }}" method="POST">
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
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Judul Kegiatan</label>
                    <input type="text" name="judul" value="{{ old('judul', $agenda->judul) }}" placeholder="Contoh: Musyawarah Kelurahan" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" required>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Deskripsi Kegiatan</label>
                    <textarea name="deskripsi" rows="5" placeholder="Jelaskan detail kegiatan agenda..." class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Tanggal --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Tanggal Pelaksanaan</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', $agenda->tanggal?->format('Y-m-d')) }}" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" required>
                    </div>

                    {{-- Waktu --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Waktu Pelaksanaan (WITA)</label>
                        <input type="time" name="waktu" value="{{ old('waktu', $agenda->waktu) }}" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                    </div>

                    {{-- Lokasi --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Lokasi Kegiatan</label>
                        <input type="text" name="lokasi" value="{{ old('lokasi', $agenda->lokasi) }}" placeholder="Contoh: Aula Kelurahan Bongki" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Status Publikasi</label>
                        <select name="status" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                            <option value="aktif" @selected(old('status', $agenda->status) == 'aktif')>Aktif</option>
                            <option value="nonaktif" @selected(old('status', $agenda->status) == 'nonaktif')>Nonaktif</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Footer Actions --}}
            <div class="bg-slate-50/50 border-t border-slate-200 px-4 sm:px-6 md:px-8 py-4 flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-3 dark:bg-slate-800/50 dark:border-slate-800">
                <a href="{{ route('admin.website.agenda.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm focus:outline-none active:scale-95 cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white">
                    Batal
                </a>
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm hover:-translate-y-0.5 shadow-primary-500/20 focus:outline-none focus:ring-2 focus:ring-primary-500 cursor-pointer active:scale-95">
                    <i class="fa-solid fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection