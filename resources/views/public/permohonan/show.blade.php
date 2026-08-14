@extends('layouts.public')

@section('title', $pageMode === 'status' ? 'Status Permohonan' : 'Permohonan Berhasil')

@section('content')

@php
    $isStatusMode = $pageMode === 'status';
    $status       = $permohonanSurat->status;

    $headerBadgeClass = $isStatusMode ? match($status) {
        'Menunggu' => 'bg-amber-50 text-amber-600',
        'Diproses' => 'bg-sky-50 text-sky-600',
        'Selesai'  => 'bg-emerald-50 text-emerald-600',
        'Ditolak'  => 'bg-rose-50 text-rose-600',
        default    => 'bg-slate-100 text-slate-600',
    } : 'bg-emerald-50 text-emerald-600';

    $headerIconClass = $isStatusMode ? match($status) {
        'Menunggu' => 'fa-clock text-3xl',
        'Diproses' => 'fa-rotate text-3xl',
        'Selesai'  => 'fa-circle-check text-3xl',
        'Ditolak'  => 'fa-circle-xmark text-3xl',
        default    => 'fa-file-lines text-3xl',
    } : 'fa-check text-4xl';

    $statusAlert = match($status) {
        'Menunggu' => [
            'class'   => 'bg-amber-50/90 border-amber-200 text-amber-900',
            'icon'    => 'fa-clock text-amber-600',
            'title'   => 'Menunggu Verifikasi',
            'message' => $isStatusMode 
                ? 'Permohonan Anda berada dalam antrean dan sedang menunggu verifikasi berkas oleh petugas.'
                : 'Permohonan Anda berhasil dikirim dan sedang menunggu verifikasi petugas. Simpan nomor permohonan untuk memantau status secara berkala.'
        ],
        'Diproses' => [
            'class'   => 'bg-sky-50/90 border-sky-200 text-sky-900',
            'icon'    => 'fa-spinner fa-spin text-sky-600',
            'title'   => 'Sedang Diproses',
            'message' => 'Berkas permohonan Anda telah diverifikasi dan saat ini sedang dalam proses pembuatan atau penandatanganan surat resmi.'
        ],
        'Selesai' => [
            'class'   => 'bg-emerald-50/90 border-emerald-200 text-emerald-900',
            'icon'    => 'fa-circle-check text-emerald-600',
            'title'   => 'Permohonan Selesai',
            'message' => 'Surat permohonan Anda telah selesai diterbitkan. Silakan datang ke Kantor Kelurahan Bongki untuk mengambil dokumen fisik dengan membawa kartu identitas.'
        ],
        'Ditolak' => [
            'class'   => 'bg-rose-50/90 border-rose-200 text-rose-900',
            'icon'    => 'fa-circle-xmark text-rose-600',
            'title'   => 'Permohonan Ditolak',
            'message' => 'Permohonan belum dapat disetujui. Silakan baca catatan petugas di atas untuk mengetahui alasan penolakan dan lakukan permohonan ulang jika diperlukan.'
        ],
        default => [
            'class'   => 'bg-slate-50 border-slate-200 text-slate-800',
            'icon'    => 'fa-circle-info text-slate-500',
            'title'   => 'Informasi Permohonan',
            'message' => 'Simpan nomor permohonan di atas untuk mengecek status permohonan Anda secara berkala.'
        ],
    };
@endphp

<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8 mt-10">
    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">
        <div class="p-8 md:p-10 text-center">
            
            <div class="mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-4 {{ $headerBadgeClass }}">
                    <i class="fa-solid {{ $headerIconClass }}"></i>
                </div>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-800 mb-2">{{ $isStatusMode ? 'Status Permohonan' : 'Permohonan Berhasil Dikirim' }}</h2>
                <p class="text-slate-500 max-w-md mx-auto text-sm sm:text-base">
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

            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 md:p-8 text-left">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <div class="bg-white border border-slate-200 rounded-xl p-4 flex flex-col justify-center items-center text-center shadow-sm">
                        <span class="text-xs uppercase tracking-wider text-slate-500 font-semibold mb-1">Nomor Permohonan</span>
                        <span class="font-bold text-primary text-lg">{{ $permohonanSurat->nomor_permohonan }}</span>
                    </div>
                    
                    <div class="bg-white border border-slate-200 rounded-xl p-4 flex flex-col justify-center items-center text-center shadow-sm">
                        <span class="text-xs uppercase tracking-wider text-slate-500 font-semibold mb-1">Jenis Layanan</span>
                        <span class="font-bold text-primary text-lg">{{ $permohonanSurat->jenisSurat->nama }}</span>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-xl p-4 flex flex-col justify-center items-center text-center shadow-sm">
                        <span class="text-xs uppercase tracking-wider text-slate-500 font-semibold mb-1">Nama Pemohon</span>
                        <span class="font-bold text-slate-800 text-base">{{ $namaPemohon }}</span>
                    </div>
                    
                    <div class="bg-white border border-slate-200 rounded-xl p-4 flex flex-col justify-center items-center text-center shadow-sm">
                        <span class="text-xs uppercase tracking-wider text-slate-500 font-semibold mb-1">NIK Pemohon</span>
                        <span class="font-bold text-slate-800 text-base font-mono">@maskNik($nikPemohon)</span>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-xl p-4 flex flex-col justify-center items-center text-center shadow-sm">
                        <span class="text-xs uppercase tracking-wider text-slate-500 font-semibold mb-1">Waktu Permohonan</span>
                        <span class="text-slate-800 font-medium text-sm sm:text-base">
                            {{ $permohonanSurat->created_at?->setTimezone('Asia/Makassar')->translatedFormat('l, j F Y, H:i') }} WITA
                        </span>
                    </div>
                    
                    <div class="bg-white border border-slate-200 rounded-xl p-4 flex flex-col justify-center items-center text-center shadow-sm">
                        <span class="text-xs uppercase tracking-wider text-slate-500 font-semibold mb-2">Status</span>
                        @php
                            $badge = match($status) {
                                'Menunggu' => 'bg-amber-50 text-amber-700 border-amber-200',
                                'Diproses' => 'bg-sky-50 text-sky-700 border-sky-200',
                                'Selesai'  => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                'Ditolak'  => 'bg-rose-50 text-rose-700 border-rose-200',
                                default    => 'bg-slate-100 text-slate-700 border-slate-200',
                            };
                        @endphp
                        <span class="inline-flex items-center px-3.5 py-1 rounded-full text-xs font-bold border {{ $badge }}">
                            {{ $status }}
                        </span>
                    </div>
                </div>

                @if(!empty($permohonanSurat->catatan))
                    <div class="mt-6 bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-400 block mb-1">Catatan Petugas</span>
                        <div class="text-slate-700 text-sm leading-relaxed">
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
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 font-semibold text-sm shadow-sm transition-all duration-200 hover:-translate-y-0.5 active:scale-95 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">
                    <i class="fa-solid fa-house"></i> Kembali ke Beranda
                </a>
                <a href="{{ route('permohonan.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-primary text-white hover:bg-primary-dark font-semibold text-sm shadow-sm transition-all duration-200 hover:-translate-y-0.5 active:scale-95 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                    <i class="fa-solid fa-plus"></i> Buat Permohonan Baru
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
