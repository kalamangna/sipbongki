@extends('layouts.public')

@section('title', 'Pengaduan Masyarakat')
@section('seo_title', 'Pengaduan Masyarakat')
@section('seo_description', 'Sampaikan aspirasi, laporan, dan pengaduan pelayanan publik Kelurahan Bongki secara online, cepat, dan transparan.')

@push('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "GovernmentService",
    "name": "Layanan Pengaduan & Aspirasi Masyarakat Kelurahan Bongki",
    "serviceType": "Layanan Pengaduan & Keluhan Publik",
    "provider": {
        "@type": "GovernmentOrganization",
        "name": "Pemerintah Kelurahan Bongki",
        "url": "{{ url('/') }}"
    },
    "areaServed": {
        "@type": "AdministrativeArea",
        "name": "Kelurahan Bongki, Kecamatan Sinjai Utara, Kabupaten Sinjai"
    },
    "url": "{{ url()->current() }}"
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {
            "@type": "ListItem",
            "position": 1,
            "name": "Beranda",
            "item": "{{ url('/') }}"
        },
        {
            "@type": "ListItem",
            "position": 2,
            "name": "Pengaduan Masyarakat",
            "item": "{{ url()->current() }}"
        }
    ]
}
</script>
@endpush

@section('content')

{{-- ==========================================================
    HERO
========================================================== --}}
<section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden bg-slate-50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <div class="grid lg:grid-cols-2 gap-12 items-center">
            
            <div>
                <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold bg-white dark:bg-slate-800 text-primary dark:text-primary-400 mb-6 border border-slate-200 dark:border-slate-700 shadow-sm uppercase tracking-wider">
                    Layanan Pengaduan
                </span>
                
                <h1 class="text-3xl sm:text-4xl lg:text-[42px] font-extrabold text-slate-900 dark:text-slate-100 leading-tight mb-6">
                    Sampaikan Pengaduan, Keluhan, dan Aspirasi Anda
                </h1>
                
                <p class="text-lg text-slate-600 dark:text-slate-300 mb-8 leading-relaxed">
                    Pemerintah Kelurahan Bongki berkomitmen memberikan pelayanan yang cepat, transparan, dan responsif terhadap setiap pengaduan masyarakat.
                </p>

                <div class="flex flex-col sm:flex-row flex-wrap gap-4">
                    <a href="#kirim-pengaduan"
                       class="inline-flex items-center justify-center gap-3 px-8 py-4 rounded-xl bg-primary hover:bg-primary-dark text-white text-base font-bold transition-all duration-200 shadow-md shadow-primary/20 hover:-translate-y-0.5 active:scale-95 w-full sm:w-auto focus:ring-2 focus:ring-primary focus:outline-none focus:ring-offset-2">
                        <i class="fa-solid fa-comment-dots text-lg"></i>
                        Formulir Pengaduan
                    </a>
                    
                    <a href="{{ route('pengaduan.status') }}"
                       class="inline-flex items-center justify-center gap-3 px-8 py-4 rounded-xl bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 text-base font-bold transition-all duration-200 shadow-sm hover:-translate-y-0.5 active:scale-95 w-full sm:w-auto focus:ring-2 focus:ring-slate-400 focus:outline-none focus:ring-offset-2">
                        <i class="fa-solid fa-magnifying-glass text-lg"></i>
                        Cek Status Pengaduan
                    </a>
                </div>
            </div>

            <div class="relative flex justify-center lg:block">
                <img src="{{ asset('images/ilustrations/pengaduan.png') }}"
                     class="relative z-10 w-full max-w-xs sm:max-w-sm lg:max-w-lg mx-auto object-contain drop-shadow-sm"
                     alt="Ilustrasi Pengaduan Masyarakat">
            </div>

        </div>

    </div>
</section>

{{-- ==========================================================
    JENIS PENGADUAN
========================================================= --}}
<section class="py-24 bg-white dark:bg-slate-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-14 max-w-2xl mx-auto">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase bg-primary-light text-primary dark:bg-primary-950/60 dark:text-primary-300 mb-4">
                Kategori Laporan
            </span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 dark:text-slate-100">
                Jenis Pengaduan
            </h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            @php
                $items = [
                    ['icon' => 'fa-solid fa-road',            'label' => 'Jalan Rusak',         'bg' => 'bg-emerald-50 dark:bg-emerald-950/60', 'text' => 'text-emerald-600 dark:text-emerald-400'],
                    ['icon' => 'fa-solid fa-lightbulb',       'label' => 'Lampu Jalan Mati',    'bg' => 'bg-amber-50 dark:bg-amber-950/60',   'text' => 'text-amber-600 dark:text-amber-400'],
                    ['icon' => 'fa-solid fa-trash-can',       'label' => 'Sampah',              'bg' => 'bg-rose-50 dark:bg-rose-950/60',    'text' => 'text-rose-600 dark:text-rose-400'],
                    ['icon' => 'fa-solid fa-water',           'label' => 'Drainase',            'bg' => 'bg-sky-50 dark:bg-sky-950/60',     'text' => 'text-sky-600 dark:text-sky-400'],
                    ['icon' => 'fa-solid fa-tree-city',       'label' => 'Fasilitas Umum',      'bg' => 'bg-indigo-50 dark:bg-indigo-950/60',  'text' => 'text-indigo-600 dark:text-indigo-400'],
                    ['icon' => 'fa-solid fa-headset',         'label' => 'Pelayanan',           'bg' => 'bg-teal-50 dark:bg-teal-950/60',    'text' => 'text-teal-600 dark:text-teal-400'],
                    ['icon' => 'fa-solid fa-comments',        'label' => 'Saran & Masukan',     'bg' => 'bg-violet-50 dark:bg-violet-950/60',  'text' => 'text-violet-600 dark:text-violet-400'],
                    ['icon' => 'fa-solid fa-circle-question', 'label' => 'Lainnya',             'bg' => 'bg-slate-100 dark:bg-slate-800',  'text' => 'text-slate-600 dark:text-slate-300'],
                ];
            @endphp

            @foreach($items as $item)
                <button type="button"
                        onclick="selectPengaduanKategori('{{ $item['label'] }}')"
                        class="group flex flex-col items-center justify-center bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 sm:p-6 text-center hover:border-primary dark:hover:border-primary-500 hover:shadow-md hover:-translate-y-0.5 active:scale-95 transition-all duration-200 cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                    <div class="w-14 h-14 rounded-2xl {{ $item['bg'] }} flex items-center justify-center mb-3 group-hover:scale-105 transition-transform duration-200">
                        <i class="{{ $item['icon'] }} text-2xl {{ $item['text'] }}"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 dark:text-slate-100 text-sm sm:text-base group-hover:text-primary dark:group-hover:text-primary-400 transition-colors mb-1">{{ $item['label'] }}</h3>
                    <span class="text-[11px] font-medium text-slate-400 dark:text-slate-500 group-hover:text-primary dark:group-hover:text-primary-400 transition-colors">Pilih kategori</span>
                </button>
            @endforeach
        </div>

    </div>
</section>

{{-- ==========================================================
    CARA MELAPOR
========================================================= --}}
<section class="py-24 bg-slate-50 dark:bg-slate-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14 max-w-2xl mx-auto">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase bg-primary-light text-primary dark:bg-primary-950/60 dark:text-primary-300 mb-4">
                Tata Cara
            </span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 dark:text-slate-100">
                Cara Menyampaikan Pengaduan
            </h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- STEP 1 --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-800 text-center flex flex-col items-center">
                <div class="w-full flex items-center justify-between mb-4 pb-3 border-b border-slate-100 dark:border-slate-800">
                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-sky-100 text-sky-700 dark:bg-sky-950/60 dark:text-sky-300 text-xs font-bold font-mono">01</span>
                    <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">Langkah 1</span>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-sky-50 text-sky-600 dark:bg-sky-950/40 dark:text-sky-400 flex items-center justify-center text-2xl mb-4">
                    <i class="fa-solid fa-clipboard-list"></i>
                </div>
                <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 mb-1.5">Persiapan Data</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">Siapkan identitas diri, rincian keluhan, dan detail lokasi kejadian.</p>
            </div>

            {{-- STEP 2 --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-800 text-center flex flex-col items-center">
                <div class="w-full flex items-center justify-between mb-4 pb-3 border-b border-slate-100 dark:border-slate-800">
                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-300 text-xs font-bold font-mono">02</span>
                    <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">Langkah 2</span>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 dark:bg-amber-950/40 dark:text-amber-400 flex items-center justify-center text-2xl mb-4">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 mb-1.5">Uraikan Kronologi</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">Tuliskan kronologi kejadian secara singkat, padat, jelas, dan faktual.</p>
            </div>

            {{-- STEP 3 --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-800 text-center flex flex-col items-center">
                <div class="w-full flex items-center justify-between mb-4 pb-3 border-b border-slate-100 dark:border-slate-800">
                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-indigo-100 text-indigo-700 dark:bg-indigo-950/60 dark:text-indigo-300 text-xs font-bold font-mono">03</span>
                    <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">Langkah 3</span>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-950/40 dark:text-indigo-400 flex items-center justify-center text-2xl mb-4">
                    <i class="fa-solid fa-camera"></i>
                </div>
                <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 mb-1.5">Sertakan Bukti</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">Lampirkan foto pendukung untuk memperkuat laporan kejadian.</p>
            </div>

            {{-- STEP 4 --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-800 text-center flex flex-col items-center">
                <div class="w-full flex items-center justify-between mb-4 pb-3 border-b border-slate-100 dark:border-slate-800">
                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-emerald-100 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 text-xs font-bold font-mono">04</span>
                    <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">Langkah 4</span>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-400 flex items-center justify-center text-2xl mb-4">
                    <i class="fa-solid fa-paper-plane"></i>
                </div>
                <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 mb-1.5">Kirim & Pantau</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">Kirim laporan dan simpan kode pengaduan untuk memantau status.</p>
            </div>

        </div>

    </div>
</section>

{{-- ==========================================================
    FORM PENGADUAN
========================================================== --}}
<section id="kirim-pengaduan" class="py-24 bg-white dark:bg-slate-950 border-t border-slate-100 dark:border-slate-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14 max-w-2xl mx-auto">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase bg-primary-light text-primary dark:bg-primary-950/60 dark:text-primary-300 mb-4">
                Formulir Online
            </span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 dark:text-slate-100">
                Formulir Pengaduan
            </h2>
        </div>

        @if(session('success'))
            <div class="mb-8 bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 p-4 rounded-2xl flex items-center gap-3 text-emerald-800 dark:text-emerald-300 text-sm font-medium">
                <i class="fa-solid fa-circle-check text-emerald-600 dark:text-emerald-400 text-lg shrink-0"></i>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-md p-6 sm:p-8 md:p-10">
            <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="pengaduan-form" novalidate>
                @csrf
                {{-- Honeypot Anti-Bot Field --}}
                <div class="hidden" aria-hidden="true" style="display:none !important; position:absolute; left:-9999px;">
                    <input type="text" name="form_hp_check" value="" tabindex="-1" autocomplete="off">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" required placeholder="Contoh: Andi Baso" value="{{ old('nama') }}"
                               class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-slate-100 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm placeholder:text-slate-400 dark:placeholder:text-slate-500 @error('nama') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('nama')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">NIK Pelapor <span class="text-red-500">*</span></label>
                        <input type="text" name="nik_pelapor" required placeholder="Contoh: 730601xxxxxxxxxx" value="{{ old('nik_pelapor') }}"
                               class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-slate-100 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm placeholder:text-slate-400 dark:placeholder:text-slate-500 @error('nik_pelapor') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('nik_pelapor')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Nomor Telepon <span class="text-red-500">*</span></label>
                        <input type="text" name="telepon" required placeholder="Contoh: 081234567890" value="{{ old('telepon') }}"
                               class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-slate-100 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm placeholder:text-slate-400 dark:placeholder:text-slate-500 @error('telepon') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('telepon')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                    <textarea name="alamat" rows="2" required placeholder="Contoh: Jl. Bhayangkara No. 12, Lingkungan Paruntu, Kel. Bongki"
                              class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-slate-100 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm placeholder:text-slate-400 dark:placeholder:text-slate-500 @error('alamat') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">{{ old('alamat') }}</textarea>
                    @error('alamat')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Kategori Pengaduan <span class="text-red-500">*</span></label>
                        <select name="kategori" id="input_kategori" required
                                class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-slate-100 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm @error('kategori') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                            <option value="">Pilih kategori...</option>
                            @foreach(['Jalan Rusak','Lampu Jalan Mati','Sampah','Drainase','Fasilitas Umum','Pelayanan','Saran & Masukan','Lainnya'] as $kat)
                                <option value="{{ $kat }}" {{ old('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                        @error('kategori')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Lokasi Kejadian <span class="text-red-500">*</span></label>
                        <input type="text" name="lokasi" required placeholder="Contoh: Jl. Jenderal Sudirman, Depan SLB Negeri 1 Sinjai" value="{{ old('lokasi') }}"
                               class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-slate-100 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm placeholder:text-slate-400 dark:placeholder:text-slate-500 @error('lokasi') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('lokasi')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Uraian Pengaduan <span class="text-red-500">*</span></label>
                    <textarea name="uraian" rows="4" required placeholder="Contoh: Saluran drainase di depan SLB Negeri 1 Sinjai tersumbat sampah plastik sehingga meluap ke jalan saat hujan deras kemarin sore. Mohon segera ditindaklanjuti."
                              class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-slate-100 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm placeholder:text-slate-400 dark:placeholder:text-slate-500 @error('uraian') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">{{ old('uraian') }}</textarea>
                    @error('uraian')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Foto Bukti (Opsional)</label>
                    <input type="file" name="foto" accept="image/*"
                           class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-slate-100 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3 py-2 transition-colors shadow-sm cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-primary-light dark:file:bg-primary-950/60 file:text-primary dark:file:text-primary-300 hover:file:bg-primary/20 file:cursor-pointer @error('foto') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                    @error('foto')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                </div>

                <div class="pt-4 border-t border-slate-100 dark:border-slate-800 text-center">
                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl bg-primary text-white font-bold text-lg shadow-md shadow-primary/20 hover:bg-primary-dark transition-all duration-200 hover:-translate-y-0.5 active:scale-95 w-full sm:w-auto focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 cursor-pointer">
                        <i class="fa-solid fa-paper-plane"></i>
                        Kirim Pengaduan Sekarang
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>

@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Find the first error message element and scroll to it
        const firstError = document.querySelector('.text-red-500');
        if (firstError) {
            // Scroll a bit above the element so the label is visible
            const y = firstError.getBoundingClientRect().top + window.pageYOffset - 150;
            window.scrollTo({top: y, behavior: 'smooth'});
        }
    });
</script>
@endif

<script>
    function selectPengaduanKategori(kategori) {
        const select = document.getElementById('input_kategori');
        if (select) {
            select.value = kategori;
            
            // Trigger change event if needed
            select.dispatchEvent(new Event('change'));

            // Smooth scroll to form section
            const formSection = document.getElementById('kirim-pengaduan');
            if (formSection) {
                formSection.scrollIntoView({ behavior: 'smooth' });
            }

            // Focus on category with temporary highlight ring
            setTimeout(() => {
                select.focus();
                select.classList.add('ring-2', 'ring-primary');
                setTimeout(() => {
                    select.classList.remove('ring-2', 'ring-primary');
                }, 1200);
            }, 500);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('pengaduan-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const requiredInputs = this.querySelectorAll('input[required], select[required], textarea[required]');
                let isValid = true;
                
                requiredInputs.forEach(input => {
                    if (!input.value.trim() || !input.checkValidity()) {
                        isValid = false;
                        input.classList.remove('border-slate-200', 'focus:border-primary', 'focus:ring-primary');
                        input.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                        
                        let errorEl = input.nextElementSibling;
                        if (!errorEl || !errorEl.classList.contains('js-validation-error')) {
                            errorEl = document.createElement('div');
                            errorEl.className = 'mt-1 text-sm text-red-500 js-validation-error';
                            input.parentNode.insertBefore(errorEl, input.nextSibling);
                        }
                        
                        let message = 'Bagian ini wajib diisi.';
                        if (input.validity.valueMissing) {
                            message = 'Bagian ini wajib diisi.';
                        } else if (input.validity.typeMismatch) {
                            message = 'Format tidak valid.';
                        } else if (input.validity.patternMismatch || input.validity.tooShort || input.validity.tooLong) {
                            message = input.title || 'Format isian tidak sesuai.';
                        }
                        errorEl.textContent = message;

                        input.addEventListener('input', function() {
                            input.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                            input.classList.add('border-slate-200', 'focus:border-primary', 'focus:ring-primary');
                            if (errorEl && errorEl.parentNode) {
                                errorEl.remove();
                            }
                        }, { once: true });
                    }
                });

                if (!isValid) {
                    e.preventDefault(); // Mencegah submit
                    const firstError = this.querySelector('.js-validation-error');
                    if (firstError && firstError.previousElementSibling) {
                        const y = firstError.previousElementSibling.getBoundingClientRect().top + window.pageYOffset - 150;
                        window.scrollTo({top: y, behavior: 'smooth'});
                        
                        // Focus automatically on the first invalid input
                        setTimeout(() => {
                            firstError.previousElementSibling.focus({ preventScroll: true });
                        }, 100);
                    }
                }
            });
        }
    });
</script>

{{-- DEV AUTO FILL BUTTON FOR TESTING --}}
@env('local')
<button type="button" id="dev-autofill-pengaduan-btn" class="fixed bottom-6 left-6 z-50 h-11 px-4 rounded-full bg-slate-800 text-white font-mono text-xs shadow-lg hover:scale-105 hover:bg-slate-900 transition-all flex items-center gap-2 cursor-pointer border border-slate-600">
    <i class="fa-solid fa-flask text-amber-400"></i> Auto Fill
</button>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fillBtn = document.getElementById('dev-autofill-pengaduan-btn');
        if (!fillBtn) return;

        const dummyImageUrl = '{{ asset("images/meta.png") }}';

        async function getDummyImageFile() {
            try {
                const response = await fetch(dummyImageUrl);
                if (!response.ok) throw new Error('Network error');
                const blob = await response.blob();
                return new File([blob], 'bukti-pengaduan.png', { type: blob.type || 'image/png' });
            } catch (e) {
                const pngBase64 = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==';
                const byteCharacters = atob(pngBase64);
                const byteNumbers = new Array(byteCharacters.length);
                for (let i = 0; i < byteCharacters.length; i++) {
                    byteNumbers[i] = byteCharacters.charCodeAt(i);
                }
                return new File([new Uint8Array(byteNumbers)], 'bukti-pengaduan.png', { type: 'image/png' });
            }
        }

        fillBtn.addEventListener('click', function() {
            const randomId = Math.floor(1000 + Math.random() * 9000);
            const maleNames = ['Andi Baso Pratama', 'Muhammad Nur Fajri', 'Fajar Ramadhan', 'Hendra Gunawan', 'Ahmad Rizky', 'Faisal Akbar', 'Budi Santoso'];
            const femaleNames = ['Andi Tenri Olle', 'Siti Rahmawati', 'Nurul Annisa', 'Dewi Sartika', 'Sri Wahyuni', 'Rina Marlina', 'Putri Ayu'];
            const isMale = Math.random() > 0.5;
            const randomName = isMale 
                ? maleNames[Math.floor(Math.random() * maleNames.length)]
                : femaleNames[Math.floor(Math.random() * femaleNames.length)];

            const categories = [
                {
                    kategori: 'Jalan Rusak',
                    lokasi: 'Jl. Persatuan Raya No. ' + Math.floor(Math.random() * 50 + 1) + ', dekat pertigaan jalan',
                    uraian: 'Terdapat beberapa lubang jalan yang cukup lebar dan dalam. Sangat membahayakan pengendara sepeda motor terutama saat tergenang air hujan di malam hari. Mohon segera dilakukan penambalan atau perbaikan.'
                },
                {
                    kategori: 'Lampu Jalan Mati',
                    lokasi: 'Jl. Veteran No. ' + Math.floor(Math.random() * 40 + 1) + ', depan pemukiman warga',
                    uraian: 'Lampu penerangan jalan umum (PJU) sudah padam selama beberapa malam terakhir sehingga area sekitar menjadi gelap gulita dan rawan kecelakaan. Mohon bantuan penggantian bohlam / perbaikan jaringan.'
                },
                {
                    kategori: 'Sampah',
                    lokasi: 'Jl. Bhayangkara No. ' + Math.floor(Math.random() * 30 + 1) + ', dekat tempat penampungan sementara',
                    uraian: 'Terjadi penumpukan volume sampah yang belum terangkut selama 3 hari sehingga menimbulkan bau menyengat dan lalat di sekitar pemukiman. Mohon bantuan armada pengangkut sampah segera ke lokasi.'
                },
                {
                    kategori: 'Drainase',
                    lokasi: 'Jl. Kemakmuran No. ' + Math.floor(Math.random() * 45 + 1) + ', saluran drainase depan ruko',
                    uraian: 'Saluran drainase mengalami sedimentasi pasir dan tersumbat sampah plastik sehingga air meluap ke halaman rumah warga setiap kali hujan lebat. Mohon dilakukan pengerukan atau pembersihan saluran.'
                },
                {
                    kategori: 'Fasilitas Umum',
                    lokasi: 'Jl. Jenderal Sudirman, dekat area taman dan fasilitas umum warga',
                    uraian: 'Terdapat kerusakan pada fasilitas umum bangku taman dan pagar pengaman. Mohon perhatian instansi terkait untuk pemeliharaan fasilitas demi kenyamanan warga.'
                },
                {
                    kategori: 'Pelayanan',
                    lokasi: 'Kantor Kelurahan Bongki, loket pelayanan administrasi',
                    uraian: 'Aspirasi dan saran terkait peningkatan kemudahan antrean berkas dan informasi status permohonan surat agar warga dapat memantau proses secara lebih transparan dan cepat.'
                },
                {
                    kategori: 'Saran & Masukan',
                    lokasi: 'Lingkungan Paruntu / Bongki Raya',
                    uraian: 'Saran untuk penyelenggaraan kerja bakti lingkungan secara berkala dan penambahan tempat sampah pilah di titik-titik kumpul warga.'
                }
            ];

            const selectedCat = categories[Math.floor(Math.random() * categories.length)];
            const streets = ['Jl. Bhayangkara', 'Jl. Persatuan Raya', 'Jl. Veteran', 'Jl. Kemakmuran', 'Jl. Sam Ratulangi', 'Jl. Sultan Hasanuddin'];
            const randomStreet = streets[Math.floor(Math.random() * streets.length)];

            function setVal(name, value) {
                const el = document.querySelector(`[name="${name}"]`);
                if (el) {
                    el.value = value;
                    el.classList.remove('border-red-500', 'border-red-300');
                    el.classList.add('border-slate-200');
                    const err = el.nextElementSibling;
                    if (err && err.classList.contains('js-validation-error')) err.remove();
                    el.dispatchEvent(new Event('input', { bubbles: true }));
                    el.dispatchEvent(new Event('change', { bubbles: true }));
                }
            }

            setVal('nama', randomName);
            setVal('nik_pelapor', '730701' + Math.floor(1000000000 + Math.random() * 9000000000));
            setVal('telepon', '0812' + randomId + String(Math.floor(1000 + Math.random() * 9000)));
            setVal('alamat', `${randomStreet} No. ${Math.floor(Math.random() * 50 + 1)}, Lingkungan Paruntu, Kel. Bongki`);
            setVal('kategori', selectedCat.kategori);
            setVal('lokasi', selectedCat.lokasi);
            setVal('uraian', selectedCat.uraian);

            const fotoInput = document.querySelector('input[name="foto"]');
            if (fotoInput) {
                getDummyImageFile().then(file => {
                    const dt = new DataTransfer();
                    dt.items.add(file);
                    fotoInput.files = dt.files;
                    fotoInput.classList.remove('border-red-500', 'border-red-300');
                    fotoInput.classList.add('border-slate-200');
                    fotoInput.dispatchEvent(new Event('change', { bubbles: true }));
                });
            }

            // Scroll to form to show filled data
            const formSec = document.getElementById('kirim-pengaduan');
            if (formSec) formSec.scrollIntoView({ behavior: 'smooth' });
        });
    });
</script>
@endenv

@endsection