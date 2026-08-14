@extends('layouts.public')

@section('title', 'Pengaduan Masyarakat')

@section('content')

{{-- ==========================================================
    HERO
========================================================== --}}
<section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden bg-slate-50">
    <div class="absolute inset-0 bg-slate-50 border-b border-slate-100"></div>
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
                       class="inline-flex items-center justify-center gap-3 px-8 py-4 rounded-xl bg-primary hover:bg-primary-dark text-white text-base font-bold transition duration-300 shadow-md shadow-primary/20 hover:-translate-y-0.5 focus:ring-2 focus:ring-primary focus:outline-none focus:ring-offset-2">
                        <i class="fa-solid fa-comment-dots text-lg"></i>
                        Formulir Pengaduan
                    </a>
                    
                    <a href="{{ route('pengaduan.status') }}"
                       class="inline-flex items-center justify-center gap-3 px-8 py-4 rounded-xl bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 text-base font-bold transition duration-300 shadow-sm hover:-translate-y-0.5 focus:ring-2 focus:ring-slate-400 focus:outline-none focus:ring-offset-2">
                        <i class="fa-solid fa-magnifying-glass text-lg"></i>
                        Cek Status Pengaduan
                    </a>
                </div>
            </div>

            <div class="relative hidden lg:block">
                {{-- Decorative elements removed to comply with DESIGN.md simplicity --}}
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
                <div class="block w-full bg-white border border-slate-200 rounded-3xl p-6 text-center">
                    <div class="w-16 h-16 mx-auto bg-primary-50 rounded-2xl flex items-center justify-center mb-5">
                        <i class="{{ $item['icon'] }} text-2xl text-primary"></i>
                    </div>
                    <h5 class="font-bold text-slate-800 text-sm sm:text-base">{{ $item['label'] }}</h5>
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
            <div class="hidden md:block absolute top-10 left-[12%] right-[12%] h-[2px] bg-slate-200 z-0"></div>

            <div class="relative z-10 flex flex-col items-center group">
                <div class="w-20 h-20 bg-white rounded-full shadow-sm border border-slate-200 flex items-center justify-center mb-6 text-2xl font-extrabold text-slate-400 group-hover:text-primary group-hover:border-primary-200 transition-colors">
                    1
                </div>
                <h3 class="text-base font-bold text-slate-800 mb-2">Persiapan</h3>
                <p class="text-sm text-slate-600 px-2 sm:px-4">Siapkan informasi akurat beserta detail lokasi kejadian.</p>
            </div>
            
            <div class="relative z-10 flex flex-col items-center group">
                <div class="w-20 h-20 bg-white rounded-full shadow-sm border border-slate-200 flex items-center justify-center mb-6 text-2xl font-extrabold text-slate-400 group-hover:text-primary group-hover:border-primary-200 transition-colors">
                    2
                </div>
                <h3 class="text-base font-bold text-slate-800 mb-2">Kronologi</h3>
                <p class="text-sm text-slate-600 px-2 sm:px-4">Jelaskan urutan kejadian secara singkat, padat, dan jelas.</p>
            </div>
            
            <div class="relative z-10 flex flex-col items-center group">
                <div class="w-20 h-20 bg-white rounded-full shadow-sm border border-slate-200 flex items-center justify-center mb-6 text-2xl font-extrabold text-slate-400 group-hover:text-primary group-hover:border-primary-200 transition-colors">
                    3
                </div>
                <h3 class="text-base font-bold text-slate-800 mb-2">Bukti Lampiran</h3>
                <p class="text-sm text-slate-600 px-2 sm:px-4">Lampirkan foto pendukung untuk memperkuat laporan Anda.</p>
            </div>
            
            <div class="relative z-10 flex flex-col items-center group">
                <div class="w-20 h-20 bg-primary rounded-full shadow-md shadow-primary/20 border border-primary flex items-center justify-center mb-6 text-2xl font-extrabold text-white">
                    4
                </div>
                <h3 class="text-base font-bold text-slate-800 mb-2">Kirim Laporan</h3>
                <p class="text-sm text-slate-600 px-2 sm:px-4">Kirimkan formulir pengaduan agar dapat segera kami proses.</p>
            </div>
        </div>

    </div>
</section>

{{-- ==========================================================
    FORM PENGADUAN
========================================================== --}}
<section id="kirim-pengaduan" class="py-24 bg-primary relative overflow-hidden">
    {{-- Decorative elements removed to comply with DESIGN.md simplicity --}}

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <div class="text-center mb-12 text-white">
            <h2 class="text-3xl font-bold text-white mb-4">Formulir Pengaduan</h2>
            <p class="text-white/80">Isi formulir berikut untuk menyampaikan laporan kepada Kelurahan Bongki.</p>
        </div>

        @if(session('success'))
            <div class="mb-8 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fa-solid fa-circle-check text-green-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden p-6 md:p-10">
            <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="pengaduan-form" novalidate>
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" required placeholder="Contoh: Andi Baso" value="{{ old('nama') }}"
                               class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm placeholder:text-slate-400 @error('nama') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('nama')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">NIK Pelapor <span class="text-red-500">*</span></label>
                        <input type="text" name="nik_pelapor" required placeholder="Contoh: 730601xxxxxxxxxx" value="{{ old('nik_pelapor') }}"
                               class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm placeholder:text-slate-400 @error('nik_pelapor') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('nik_pelapor')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nomor Telepon <span class="text-red-500">*</span></label>
                        <input type="text" name="telepon" required placeholder="Contoh: 081234567890" value="{{ old('telepon') }}"
                               class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm placeholder:text-slate-400 @error('telepon') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('telepon')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                    <textarea name="alamat" rows="2" required placeholder="Contoh: Jl. Bhayangkara No. 12, Lingkungan Paruntu, Kel. Bongki"
                              class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm placeholder:text-slate-400 @error('alamat') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">{{ old('alamat') }}</textarea>
                    @error('alamat')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Kategori Pengaduan <span class="text-red-500">*</span></label>
                        <select name="kategori" required
                                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('kategori') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                            <option value="">Pilih kategori...</option>
                            @foreach(['Jalan Rusak','Lampu Jalan Mati','Sampah','Drainase','Fasilitas Umum','Pelayanan','Saran & Masukan','Lainnya'] as $kat)
                                <option value="{{ $kat }}" {{ old('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                        @error('kategori')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Lokasi Kejadian <span class="text-red-500">*</span></label>
                        <input type="text" name="lokasi" required placeholder="Contoh: Jl. Jenderal Sudirman, Depan SLB Negeri 1 Sinjai" value="{{ old('lokasi') }}"
                               class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm placeholder:text-slate-400 @error('lokasi') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('lokasi')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Uraian Pengaduan <span class="text-red-500">*</span></label>
                    <textarea name="uraian" rows="4" required placeholder="Contoh: Saluran drainase di depan SLB Negeri 1 Sinjai tersumbat sampah plastik sehingga meluap ke jalan saat hujan deras kemarin sore. Mohon segera ditindaklanjuti."
                              class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm placeholder:text-slate-400 @error('uraian') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">{{ old('uraian') }}</textarea>
                    @error('uraian')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Foto Bukti (Opsional)</label>
                    <input type="file" name="foto" accept="image/*"
                           class="w-full file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-600 hover:file:bg-primary-100 transition-colors border border-slate-200 bg-slate-50 text-slate-900 rounded-xl cursor-pointer @error('foto') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                    @error('foto')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                </div>

                <div class="pt-4 border-t border-slate-100 text-center">
                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl bg-primary text-white font-bold text-lg shadow-md shadow-primary/20 hover:bg-primary-700 transition-all duration-200 hover:-translate-y-1 w-full sm:w-auto focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 cursor-pointer">
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
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('pengaduan-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const requiredInputs = this.querySelectorAll('input[required], select[required], textarea[required]');
                let isValid = true;
                
                requiredInputs.forEach(input => {
                    if (!input.value.trim() || !input.checkValidity()) {
                        isValid = false;
                        input.classList.remove('border-slate-200', 'focus:border-primary-500', 'focus:ring-primary-500');
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
                            input.classList.add('border-slate-200', 'focus:border-primary-500', 'focus:ring-primary-500');
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

@endsection