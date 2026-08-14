@extends('layouts.public')

@section('title', 'Cek Status Pengaduan')

@section('content')

<section class="min-h-screen py-24 bg-slate-50 pt-32 flex items-center justify-center">
    <div class="max-w-xl w-full mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-white rounded-3xl shadow-md overflow-hidden border border-slate-200">
            <div class="p-8 md:p-12">
                
                <div class="text-center mb-8">
                    <div class="w-16 h-16 mx-auto bg-primary-light rounded-full flex items-center justify-center mb-4 text-primary text-xl">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800 mb-2">Cek Status Pengaduan</h2>
                    <p class="text-slate-500">
                        Masukkan kode pengaduan Anda untuk melihat perkembangan laporan.
                    </p>
                </div>

                @if(session('error'))
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl">
                        <div class="flex">
                            <div class="flex-shrink-0 text-red-500">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700 font-medium">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('pengaduan.status.check') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="kode" class="block text-sm font-semibold text-slate-700 mb-2">Kode Pengaduan</label>
                        <input type="text"
                               name="kode"
                               id="kode"
                               class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 shadow-sm px-4 py-3 text-lg tracking-wide uppercase transition-shadow placeholder:normal-case placeholder:text-sm placeholder:text-slate-400"
                               placeholder="Contoh: ADU-20260808-ABC12"
                               value="{{ old('kode') }}"
                               required>
                    </div>

                    <div>
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-8 py-4 rounded-xl bg-primary hover:bg-primary-dark text-white font-bold text-base shadow-md shadow-primary/20 transition-all duration-200 hover:-translate-y-0.5 active:scale-95 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Cek Status
                        </button>
                    </div>
                </form>

                <div class="text-center mt-8 pt-6 border-t border-slate-200">
                    <a href="{{ route('pengaduan') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-500 hover:text-primary transition-colors focus:outline-none focus:ring-2 focus:ring-primary rounded">
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali ke Form Pengaduan
                    </a>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection
