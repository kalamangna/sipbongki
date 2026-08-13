@extends('layouts.admin')

@section('title', 'Edit Galeri')

@section('content')
<div class="w-full">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Edit Galeri</h2>
            <p class="text-sm text-slate-500 mt-1">Perbarui dokumentasi kegiatan Kelurahan Bongki.</p>
        </div>
        <a href="{{ route('admin.website.galeri.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none">
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
        <form action="{{ route('admin.website.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="p-6 md:p-8 space-y-6">
                {{-- Judul --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Dokumentasi</label>
                    <input type="text" name="judul" value="{{ old('judul', $galeri->judul) }}" placeholder="Contoh: Gotong Royong Bersama Warga" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi (Opsional)</label>
                    <textarea name="deskripsi" rows="4" placeholder="Keterangan dokumentasi..." class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Gambar --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Ganti Foto (Opsional)</label>
                        <div class="flex flex-col gap-4">
                            <input type="file" name="gambar" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-2.5 transition-colors shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100" accept="image/*" onchange="previewImage(event)">
                            <p class="text-xs text-slate-500">Format: JPG, JPEG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.</p>
                            
                            <div class="flex flex-wrap gap-4 mt-2">
                                @if($galeri->gambar)
                                    <div>
                                        <p class="text-xs font-semibold text-slate-500 mb-2 uppercase tracking-wider">Foto Saat Ini</p>
                                        <img src="{{ asset('storage/'.$galeri->gambar) }}" class="w-[200px] h-[130px] object-cover rounded-xl shadow-sm border border-slate-200" alt="Current Image">
                                    </div>
                                @endif
                                <div>
                                    <p id="preview-label" class="text-xs font-semibold text-slate-500 mb-2 uppercase tracking-wider hidden">Foto Baru</p>
                                    <img id="preview" src="#" class="hidden w-[200px] h-[130px] object-cover rounded-xl shadow-sm border border-emerald-200">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Status Publikasi</label>
                        <select name="status" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">
                            <option value="aktif" @selected(old('status', $galeri->status) == 'aktif')>Aktif</option>
                            <option value="nonaktif" @selected(old('status', $galeri->status) == 'nonaktif')>Nonaktif</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Footer / Actions --}}
            <div class="px-6 py-5 border-t border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row justify-end gap-3">
                <a href="{{ route('admin.website.galeri.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 shadow-sm transition-all focus:outline-none">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all focus:outline-none">
                    <i class="fa-solid fa-save"></i> Update Galeri
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
        const label = document.getElementById('preview-label');
        if(event.target.files.length > 0) {
            image.src = URL.createObjectURL(event.target.files[0]);
            image.classList.remove('hidden');
            if(label) label.classList.remove('hidden');
        }
    }
</script>
@endpush