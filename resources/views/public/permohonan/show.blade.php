@extends('layouts.public')

@section('title', $pageMode === 'status' ? 'Status Permohonan' : 'Permohonan Berhasil')

@section('content')

@php
    $isStatusMode = $pageMode === 'status';
    $status       = $permohonanSurat->status;

    $headerBadgeClass = $isStatusMode ? match($status) {
        'Menunggu' => 'bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400',
        'Diproses' => 'bg-sky-50 dark:bg-sky-950/60 text-sky-600 dark:text-sky-400',
        'Selesai'  => 'bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400',
        'Ditolak'  => 'bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400',
        default    => 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300',
    } : 'bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400';

    $headerIconClass = $isStatusMode ? match($status) {
        'Menunggu' => 'fa-clock text-3xl',
        'Diproses' => 'fa-rotate text-3xl',
        'Selesai'  => 'fa-circle-check text-3xl',
        'Ditolak'  => 'fa-circle-xmark text-3xl',
        default    => 'fa-file-lines text-3xl',
    } : 'fa-check text-4xl';

    $statusAlert = match($status) {
        'Menunggu' => [
            'class'   => 'bg-amber-50/90 dark:bg-amber-950/60 border-amber-200 dark:border-amber-800 text-amber-900 dark:text-amber-200',
            'icon'    => 'fa-clock text-amber-600 dark:text-amber-400',
            'title'   => 'Menunggu Verifikasi',
            'message' => $isStatusMode 
                ? 'Permohonan Anda berada dalam antrean dan sedang menunggu verifikasi berkas oleh petugas.'
                : 'Permohonan Anda berhasil dikirim dan sedang menunggu verifikasi petugas. Simpan nomor permohonan untuk memantau status secara berkala.'
        ],
        'Diproses' => [
            'class'   => 'bg-sky-50/90 dark:bg-sky-950/60 border-sky-200 dark:border-sky-800 text-sky-900 dark:text-sky-200',
            'icon'    => 'fa-spinner fa-spin text-sky-600 dark:text-sky-400',
            'title'   => 'Sedang Diproses',
            'message' => 'Berkas permohonan Anda telah diverifikasi dan saat ini sedang dalam proses pembuatan atau penandatanganan surat resmi.'
        ],
        'Selesai' => [
            'class'   => 'bg-emerald-50/90 dark:bg-emerald-950/60 border-emerald-200 dark:border-emerald-800 text-emerald-900 dark:text-emerald-200',
            'icon'    => 'fa-circle-check text-emerald-600 dark:text-emerald-400',
            'title'   => 'Permohonan Selesai',
            'message' => 'Surat permohonan Anda telah selesai diterbitkan. Silakan datang ke Kantor Kelurahan Bongki untuk mengambil dokumen fisik dengan membawa kartu identitas.'
        ],
        'Ditolak' => [
            'class'   => 'bg-rose-50/90 dark:bg-rose-950/60 border-rose-200 dark:border-rose-800 text-rose-900 dark:text-rose-200',
            'icon'    => 'fa-circle-xmark text-rose-600 dark:text-rose-400',
            'title'   => 'Permohonan Ditolak',
            'message' => 'Permohonan belum dapat disetujui. Silakan baca catatan petugas di atas untuk mengetahui alasan penolakan dan lakukan permohonan ulang jika diperlukan.'
        ],
        default => [
            'class'   => 'bg-slate-50 dark:bg-slate-800/50 border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-100',
            'icon'    => 'fa-circle-info text-slate-500 dark:text-slate-400',
            'title'   => 'Informasi Permohonan',
            'message' => 'Simpan nomor permohonan di atas untuk mengecek status permohonan Anda secara berkala.'
        ],
    };
@endphp

<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8 mt-10">
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-sm overflow-hidden">
        <div class="p-8 md:p-10 text-center">
            
            <div class="mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-4 {{ $headerBadgeClass }}">
                    <i class="fa-solid {{ $headerIconClass }}"></i>
                </div>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-800 dark:text-slate-100 mb-2">{{ $isStatusMode ? 'Status Permohonan' : 'Permohonan Berhasil Dikirim' }}</h2>
                <p class="text-slate-500 dark:text-slate-400 max-w-md mx-auto text-sm sm:text-base">
                    Berikut adalah rincian dan status terkini permohonan surat Anda.
                </p>
            </div>

            @php
                // Gunakan accessor $pemohon: menangani penduduk terdaftar,
                // pengajuan manual, maupun nama_pemilik (usaha)
                $pemohon     = $permohonanSurat->pemohon;
                $namaPemohon = $pemohon->nama_lengkap ?? '-';
                $nikPemohon  = $pemohon->nik ?? '-';
            @endphp

            <div class="bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 text-left">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-4 flex flex-col justify-center items-center text-center shadow-sm">
                        <span class="text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 font-semibold mb-1">Nomor Permohonan</span>
                        <span class="font-bold text-primary dark:text-primary-400 text-lg">{{ $permohonanSurat->nomor_permohonan }}</span>
                    </div>
                    
                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-4 flex flex-col justify-center items-center text-center shadow-sm">
                        <span class="text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 font-semibold mb-1">Jenis Layanan</span>
                        <span class="font-bold text-primary dark:text-primary-400 text-lg">{{ $permohonanSurat->jenisSurat->nama }}</span>
                    </div>

                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-4 flex flex-col justify-center items-center text-center shadow-sm">
                        <span class="text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 font-semibold mb-1">Nama Pemohon</span>
                        <span class="font-bold text-slate-800 dark:text-slate-100 text-base">{{ $namaPemohon }}</span>
                    </div>
                    
                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-4 flex flex-col justify-center items-center text-center shadow-sm">
                        <span class="text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 font-semibold mb-1">NIK Pemohon</span>
                        <span class="font-bold text-slate-800 dark:text-slate-100 text-base font-mono">@maskNik($nikPemohon)</span>
                    </div>

                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-4 flex flex-col justify-center items-center text-center shadow-sm">
                        <span class="text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 font-semibold mb-1">Waktu Permohonan</span>
                        <span class="text-slate-800 dark:text-slate-100 font-medium text-sm sm:text-base">
                            {{ $permohonanSurat->created_at?->setTimezone('Asia/Makassar')->translatedFormat('l, j F Y, H:i') }} WITA
                        </span>
                    </div>
                    
                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-4 flex flex-col justify-center items-center text-center shadow-sm">
                        <span class="text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 font-semibold mb-2">Status</span>
                        @php
                            $badge = match($status) {
                                'Menunggu' => 'bg-amber-50 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300 border-amber-200 dark:border-amber-800',
                                'Diproses' => 'bg-sky-50 dark:bg-sky-950/60 text-sky-700 dark:text-sky-300 border-sky-200 dark:border-sky-800',
                                'Selesai'  => 'bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800',
                                'Ditolak'  => 'bg-rose-50 dark:bg-rose-950/60 text-rose-700 dark:text-rose-300 border-rose-200 dark:border-rose-800',
                                default    => 'bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 border-slate-200 dark:border-slate-700',
                            };
                        @endphp
                        <span class="inline-flex items-center px-3.5 py-1 rounded-full text-xs font-bold border {{ $badge }}">
                            {{ $status }}
                        </span>
                    </div>
                </div>

                @if(!empty($permohonanSurat->catatan))
                    <div class="mt-6 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-5 shadow-sm">
                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-1">Catatan Petugas</span>
                        <div class="text-slate-700 dark:text-slate-200 text-sm leading-relaxed">
                            {!! nl2br(e($permohonanSurat->catatan)) !!}
                        </div>
                    </div>
                @endif

                <div class="mt-6 p-4 sm:p-5 border rounded-2xl text-left sm:text-center text-sm font-medium {{ $statusAlert['class'] }}">
                    <div class="flex items-center justify-center gap-2 mb-1 font-bold">
                        <i class="fa-solid {{ $statusAlert['icon'] }}"></i>
                        <span>{{ $statusAlert['title'] }}</span>
                    </div>
                    <div class="text-xs sm:text-sm opacity-95">
                        {{ $statusAlert['message'] }}
                    </div>
                </div>
            </div>

            <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:bg-slate-50 hover:text-slate-900 dark:hover:bg-slate-700 dark:hover:text-white font-semibold text-sm shadow-sm transition-all duration-200 hover:-translate-y-0.5 active:scale-95 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2 cursor-pointer">
                    <i class="fa-solid fa-house"></i> Kembali ke Beranda
                </a>
                <a href="{{ route('permohonan.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-primary text-white hover:bg-primary-dark font-semibold text-sm shadow-sm transition-all duration-200 hover:-translate-y-0.5 active:scale-95 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 cursor-pointer">
                    <i class="fa-solid fa-plus"></i> Buat Permohonan Baru
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
