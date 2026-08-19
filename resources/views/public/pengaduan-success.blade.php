@extends('layouts.public')

@section('title', 'Pengaduan Berhasil Dikirim')

@section('content')

<section class="min-h-screen py-24 bg-slate-50 dark:bg-slate-950 pt-32 flex items-center justify-center">
    <div class="max-w-3xl w-full mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-md overflow-hidden border border-slate-200 dark:border-slate-800 p-5 sm:p-8 md:p-12 text-center">
            
            <div class="w-16 h-16 mx-auto bg-emerald-50 dark:bg-emerald-950/60 rounded-full flex items-center justify-center mb-5 text-primary dark:text-primary-400 text-2xl">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <h2 class="text-2xl md:text-3xl font-bold text-slate-800 dark:text-slate-100 mb-2">Pengaduan Berhasil Dikirim</h2>
            <p class="text-slate-500 dark:text-slate-400 max-w-lg mx-auto mb-8">
                Laporan pengaduan Anda telah diterima dan akan segera diproses oleh petugas Kelurahan Bongki.
            </p>

            <div class="bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 mb-8 text-left">
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="p-4 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700">
                        <span class="text-xs font-semibold text-slate-400 dark:text-slate-400 uppercase tracking-wider block mb-1">Kode Pengaduan</span>
                        <span class="text-base font-bold text-primary dark:text-primary-400">{{ $pengaduan->kode }}</span>
                    </div>

                    <div class="p-4 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700">
                        <span class="text-xs font-semibold text-slate-400 dark:text-slate-400 uppercase tracking-wider block mb-1">Status Laporan</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 border border-rose-200 dark:border-rose-800">
                            {{ $pengaduan->status }}
                        </span>
                    </div>

                    <div class="p-4 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700">
                        <span class="text-xs font-semibold text-slate-400 dark:text-slate-400 uppercase tracking-wider block mb-1">Nama Pelapor</span>
                        <span class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $pengaduan->nama }}</span>
                    </div>

                    <div class="p-4 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700">
                        <span class="text-xs font-semibold text-slate-400 dark:text-slate-400 uppercase tracking-wider block mb-1">Kategori</span>
                        <span class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $pengaduan->kategori }}</span>
                    </div>
                </div>

                @if(!empty($pengaduan->catatan))
                    <div class="mt-4 p-4 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700">
                        <span class="text-xs font-semibold text-slate-400 dark:text-slate-400 uppercase tracking-wider block mb-1">Catatan Petugas</span>
                        <p class="text-sm text-slate-700 dark:text-slate-200">{{ $pengaduan->catatan }}</p>
                    </div>
                @endif

                <div class="mt-4 p-4 bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 rounded-xl text-center text-sm text-emerald-800 dark:text-emerald-300 font-medium">
                    <i class="fa-solid fa-circle-info mr-1.5 text-primary dark:text-primary-400"></i>
                    Simpan kode pengaduan di atas untuk mengecek perkembangan laporan Anda di kemudian hari.
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('pengaduan.status') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-primary hover:bg-primary-dark text-white font-semibold text-sm transition-all duration-200 active:scale-95 shadow-sm shadow-primary/20 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Cek Status Pengaduan
                </a>
                <a href="{{ url('/') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 font-semibold text-sm transition-all duration-200 active:scale-95 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">
                    <i class="fa-solid fa-house"></i>
                    Kembali ke Beranda
                </a>
            </div>

        </div>

    </div>
</section>

@endsection
