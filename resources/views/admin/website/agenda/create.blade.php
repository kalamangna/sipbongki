@extends('layouts.admin')

@section('title', 'Tambah Agenda')

@section('content')
<div class="w-full">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Tambah Agenda</h2>
            <p class="text-sm text-slate-500 mt-1">Tambahkan jadwal kegiatan Kelurahan Bongki.</p>
        </div>
        <a href="{{ route('admin.website.agenda.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none">
            <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
        </a>
    </div>

    {{-- VALIDATION ERROR --}}
    @if($errors->any())
    <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 flex gap-3 items-start shadow-sm">
        <i class="fa-solid fa-circle-exclamation text-rose-500 mt-0.5"></i>
        <div>
            <h4 class="text-sm font-bold text-rose-800">Terdapat Kesalahan</h4>
            <ul class="text-sm text-rose-700 mt-1 list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    {{-- Main Form Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <form action="{{ route('admin.website.agenda.store') }}" method="POST">
            @csrf
            
            <div class="p-6 md:p-8 space-y-6">
                {{-- Judul --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Kegiatan</label>
                    <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Musyawarah Kelurahan" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm" required>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Kegiatan</label>
                    <textarea name="deskripsi" rows="5" placeholder="Jelaskan detail kegiatan agenda..." class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Tanggal --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Pelaksanaan</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm" required>
                    </div>

                    {{-- Waktu --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Waktu Pelaksanaan (WITA)</label>
                        <input type="time" name="waktu" value="{{ old('waktu') }}" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">
                    </div>

                    {{-- Lokasi --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Lokasi Kegiatan</label>
                        <input type="text" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Aula Kelurahan Bongki" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Status Publikasi</label>
                        <select name="status" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">
                            <option value="aktif" @selected(old('status') == 'aktif')>Aktif</option>
                            <option value="nonaktif" @selected(old('status') == 'nonaktif')>Nonaktif</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Footer / Actions --}}
            <div class="px-6 py-5 border-t border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row justify-end gap-3">
                <a href="{{ route('admin.website.agenda.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 shadow-sm transition-all focus:outline-none">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all focus:outline-none">
                    <i class="fa-solid fa-save"></i> Simpan Agenda
                </button>
            </div>
        </form>
    </div>
</div>
@endsection