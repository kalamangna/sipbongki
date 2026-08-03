@extends('layouts.public')

@section('title', 'Pengaduan Masyarakat')

@section('content')

{{-- HERO PENGADUAN --}}
<section class="pt-32 pb-16 bg-gradient-to-b from-slate-50 via-emerald-50/20 to-white">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 space-y-6">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold tracking-wide">
                    <i class="fa-solid fa-bullhorn text-emerald-600"></i>
                    Layanan Pengaduan & Aspirasi
                </span>

                <h1 class="text-4xl sm:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                    Sampaikan Pengaduan & Aspirasi Anda
                </h1>

                <p class="text-slate-600 text-base sm:text-lg leading-relaxed">
                    Pemerintah Kelurahan Bongki berkomitmen memberikan pelayanan yang cepat, transparan, dan responsif terhadap setiap pengaduan masyarakat demi kenyamanan bersama.
                </p>

                <div class="pt-2">
                    <a href="#form-pengaduan" class="inline-flex items-center gap-2.5 px-6 py-3.5 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold text-sm rounded-2xl shadow-lg shadow-emerald-600/25 hover:shadow-xl hover:from-emerald-700 hover:to-teal-700 transition duration-300">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span>Isi Formulir Pengaduan</span>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5 text-center">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white bg-emerald-50 p-6">
                    <img src="{{ asset('images/ilustrations/pengaduan.png') }}" class="w-full max-h-80 object-contain mx-auto" alt="Ilustrasi Pengaduan">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- JENIS PENGADUAN --}}
<section class="py-16 bg-slate-50">
    <div class="container mx-auto px-4 max-w-7xl space-y-12">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Kategori Pengaduan Umum</h2>
            <p class="text-slate-500 text-sm">Berbagai kategori masalah lingkungan dan pelayanan yang dapat Anda laporkan.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @php
                $items = [
                    ['fa-solid fa-road', 'Jalan Rusak'],
                    ['fa-solid fa-lightbulb', 'Lampu Jalan'],
                    ['fa-solid fa-trash', 'Kebersihan/Sampah'],
                    ['fa-solid fa-droplet', 'Drainase/Banjir'],
                    ['fa-solid fa-tree', 'Pohon Tumbang'],
                    ['fa-solid fa-building', 'Fasilitas Umum'],
                    ['fa-solid fa-file-lines', 'Layanan Publik'],
                    ['fa-solid fa-comments', 'Saran & Masukan'],
                ];
            @endphp

            @foreach($items as $item)
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm text-center space-y-2 hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl mx-auto">
                        <i class="{{ $item[0] }}"></i>
                    </div>
                    <h5 class="font-bold text-sm text-slate-800">{{ $item[1] }}</h5>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- FORM PENGADUAN --}}
<section id="form-pengaduan" class="py-20 bg-white">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="bg-white rounded-3xl p-8 sm:p-12 border border-slate-100 shadow-xl space-y-8">
            <div class="space-y-2 border-b border-slate-100 pb-6">
                <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">Formulir Pengaduan Masyarakat</h3>
                <p class="text-slate-500 text-sm">Lengkapi data laporan Anda di bawah ini dengan jelas dan benar.</p>
            </div>

            @if(session('success'))
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-xl text-emerald-600"></i>
                    <div>
                        <strong class="font-bold block">Pengaduan Terkirim!</strong>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Nama Pelapor <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" required value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm">
                        @error('nama')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">No. WhatsApp/Telepon <span class="text-red-500">*</span></label>
                        <input type="text" name="telepon" required value="{{ old('telepon') }}" placeholder="08xxxxxxxxxx" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm">
                        @error('telepon')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Kategori Laporan <span class="text-red-500">*</span></label>
                        <select name="kategori" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm bg-white">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Jalan Rusak">Jalan Rusak</option>
                            <option value="Lampu Jalan">Lampu Jalan Mati</option>
                            <option value="Kebersihan">Kebersihan/Sampah</option>
                            <option value="Drainase">Drainase/Banjir</option>
                            <option value="Fasilitas Umum">Fasilitas Umum</option>
                            <option value="Pelayanan">Layanan Publik</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        @error('kategori')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Lokasi Kejadian <span class="text-red-500">*</span></label>
                        <input type="text" name="lokasi" required value="{{ old('lokasi') }}" placeholder="Contoh: Jl. Ahmad Yani RT 02" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm">
                        @error('lokasi')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Alamat Pelapor <span class="text-red-500">*</span></label>
                    <input type="text" name="alamat" required value="{{ old('alamat') }}" placeholder="Alamat rumah pelapor" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm">
                    @error('alamat')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Isi / Uraian Laporan <span class="text-red-500">*</span></label>
                    <textarea name="uraian" rows="4" required placeholder="Jelaskan detail pengaduan atau keluhan Anda secara rinci" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm">{{ old('uraian') }}</textarea>
                    @error('uraian')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Lampiran Foto (Opsional)</label>
                    <input type="file" name="foto" accept="image/*" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    <p class="text-[11px] text-slate-400">Format: JPG, PNG, WEBP (Maksimal 2MB)</p>
                    @error('foto')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-4">
                    <button type="submit" class="inline-flex items-center gap-2 px-8 py-3.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-emerald-600/20 transition">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>Kirim Pengaduan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection