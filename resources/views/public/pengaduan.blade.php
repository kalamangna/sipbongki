@extends('layouts.public')

@section('title', 'Pengaduan Masyarakat')

@section('content')

{{-- ==========================================================
    HERO
========================================================== --}}
<section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden bg-slate-50">
    <div class="absolute inset-0 bg-gradient-to-b from-primary/5 to-transparent"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <div class="grid lg:grid-cols-2 gap-12 items-center">
            
            <div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-primary-light text-primary mb-6">
                    Layanan Pengaduan
                </span>
                
                <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-800 leading-tight mb-6">
                    Sampaikan Pengaduan, Keluhan, dan Aspirasi Anda
                </h1>
                
                <p class="text-lg text-slate-600 mb-8 leading-relaxed">
                    Pemerintah Kelurahan Bongki berkomitmen memberikan pelayanan yang cepat, transparan, dan responsif terhadap setiap pengaduan masyarakat.
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="#kirim-pengaduan"
                       class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-semibold shadow-lg shadow-primary/30 transition-all duration-200 hover:-translate-y-0.5">
                        <i class="fa-solid fa-comment-dots"></i>
                        Formulir Pengaduan
                    </a>
                    
                    <a href="{{ route('pengaduan.status') }}"
                       class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl border-2 border-primary text-primary font-semibold hover:bg-primary hover:text-white shadow-sm transition-all duration-200 hover:-translate-y-0.5">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Cek Status Pengaduan
                    </a>
                </div>
            </div>

            <div class="relative hidden lg:block">
                <div class="absolute inset-0 bg-gradient-to-tr from-primary/20 to-transparent rounded-full blur-3xl transform -translate-x-10 translate-y-10"></div>
                <img src="{{ asset('images/ilustrations/pengaduan.png') }}"
                     class="relative z-10 w-full max-w-lg mx-auto transform hover:-translate-y-2 transition-transform duration-500"
                     alt="Ilustrasi Pengaduan Masyarakat">
            </div>

        </div>

    </div>
</section>

{{-- ==========================================================
    JENIS PENGADUAN
========================================================== --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="text-3xl font-bold text-slate-800 mb-4">Jenis Pengaduan</h2>
            <p class="text-slate-600">Beberapa laporan yang dapat disampaikan masyarakat.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @php
                $items = [
                    ['icon' => 'fa-solid fa-map', 'label' => 'Jalan Rusak'],
                    ['icon' => 'fa-solid fa-lightbulb', 'label' => 'Lampu Jalan Mati'],
                    ['icon' => 'fa-solid fa-trash', 'label' => 'Sampah'],
                    ['icon' => 'fa-solid fa-flask', 'label' => 'Drainase'],
                    ['icon' => 'fa-solid fa-bug', 'label' => 'Hama / Pohon Tumbang'],
                    ['icon' => 'fa-solid fa-building', 'label' => 'Fasilitas Umum'],
                    ['icon' => 'fa-solid fa-file-lines', 'label' => 'Pelayanan'],
                    ['icon' => 'fa-solid fa-comments', 'label' => 'Saran & Masukan'],
                ];
            @endphp

            @foreach($items as $item)
                <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 text-center hover:shadow-md hover:border-primary-light transition-all duration-300 group">
                    <div class="w-16 h-16 mx-auto bg-white rounded-xl shadow-sm flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i class="{{ $item['icon'] }} w-8 h-8 text-primary"></i>
                    </div>
                    <h5 class="font-semibold text-slate-700">{{ $item['label'] }}</h5>
                </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ==========================================================
    CARA MELAPOR
========================================================== --}}
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="text-3xl font-bold text-slate-800">Cara Menyampaikan Pengaduan</h2>
        </div>

        <div class="grid md:grid-cols-4 gap-8 text-center relative">
            <div class="hidden md:block absolute top-12 left-[10%] right-[10%] h-0.5 bg-slate-200 z-0"></div>

            <div class="relative z-10 flex flex-col items-center">
                <div class="w-24 h-24 bg-white rounded-full border-4 border-primary shadow-lg flex items-center justify-center text-3xl font-bold text-primary mb-6">1</div>
                <p class="text-slate-600 font-medium">Siapkan informasi dan lokasi kejadian.</p>
            </div>
            
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-24 h-24 bg-white rounded-full border-4 border-primary shadow-lg flex items-center justify-center text-3xl font-bold text-primary mb-6">2</div>
                <p class="text-slate-600 font-medium">Jelaskan kronologi secara singkat dan jelas.</p>
            </div>
            
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-24 h-24 bg-white rounded-full border-4 border-primary shadow-lg flex items-center justify-center text-3xl font-bold text-primary mb-6">3</div>
                <p class="text-slate-600 font-medium">Lampirkan foto apabila memungkinkan.</p>
            </div>
            
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-24 h-24 bg-white rounded-full border-4 border-primary shadow-lg flex items-center justify-center text-3xl font-bold text-primary mb-6">4</div>
                <p class="text-slate-600 font-medium">Kirim laporan melalui Website ini.</p>
            </div>
        </div>

    </div>
</section>

{{-- ==========================================================
    FORM PENGADUAN
========================================================== --}}
<section id="kirim-pengaduan" class="py-24 bg-primary relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-white opacity-5 rounded-full blur-3xl transform -translate-x-1/2 translate-y-1/2"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <div class="text-center mb-12 text-white">
            <h2 class="text-3xl font-bold text-white mb-4">Formulir Pengaduan</h2>
            <p class="text-white/80">Isi formulir berikut untuk menyampaikan laporan kepada Kelurahan Bongki.</p>
        </div>

        @if(session('success'))
            <div class="mb-8 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden p-6 md:p-10">
            <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" required
                               class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">NIK Pelapor</label>
                        <input type="text" name="nik_pelapor" required
                               class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nomor Telepon</label>
                        <input type="text" name="telepon" required
                               class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Alamat Lengkap</label>
                    <textarea name="alamat" rows="2" required
                              class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Kategori Pengaduan</label>
                        <select name="kategori" required
                                class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow">
                            <option value="">Pilih kategori...</option>
                            <option>Jalan Rusak</option>
                            <option>Lampu Jalan Mati</option>
                            <option>Sampah</option>
                            <option>Drainase</option>
                            <option>Fasilitas Umum</option>
                            <option>Pelayanan</option>
                            <option>Saran & Masukan</option>
                            <option>Lainnya</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Lokasi Kejadian</label>
                        <input type="text" name="lokasi" required
                               class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Uraian Pengaduan</label>
                    <textarea name="uraian" rows="4" required
                              class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Foto Bukti (Opsional)</label>
                    <input type="file" name="foto" accept="image/*"
                           class="w-full file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-light file:text-primary hover:file:bg-primary/20 transition-colors border border-slate-200 rounded-xl cursor-pointer">
                </div>

                <div class="pt-4 border-t border-slate-100 text-center">
                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl bg-primary hover:bg-primary-dark text-white font-bold text-lg shadow-lg shadow-primary/30 transition-all duration-200 hover:-translate-y-1 w-full sm:w-auto">
                        <i class="fa-solid fa-paper-plane"></i>
                        Kirim Pengaduan Sekarang
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>
@endsection