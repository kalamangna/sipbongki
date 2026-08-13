@extends('layouts.public')

@section('title', $pageMode === 'status' ? 'Status Permohonan' : 'Permohonan Berhasil')

@section('content')

@php
    $isStatusMode = $pageMode === 'status';
@endphp

<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8 mt-10">
    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">
        <div class="p-8 md:p-10 text-center">
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 text-sm text-green-700 text-left rounded-r-xl">
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif
            
            <div class="mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-4 {{ $isStatusMode ? 'bg-blue-50 text-blue-500' : 'bg-green-50 text-green-500' }}">
                    <i class="fa-solid {{ $isStatusMode ? 'fa-rotate text-4xl' : 'fa-check text-5xl' }}"></i>
                </div>
                <h2 class="text-3xl font-bold text-slate-800 mb-2">{{ $isStatusMode ? 'Status Permohonan' : 'Permohonan Berhasil' }}</h2>
                <p class="text-slate-500">
                    {{ $isStatusMode
                        ? 'Berikut adalah status terkini pengajuan surat Anda.'
                        : 'Permohonan Anda telah dikirim dan sedang menunggu proses verifikasi.'
                    }}
                </p>
            </div>

            @php
                // Gunakan accessor $pemohon: menangani penduduk terdaftar,
                // pengajuan manual, maupun nama_pemilik (usaha)
                $pemohon     = $permohonanSurat->pemohon;
                $namaPemohon = $pemohon->nama_lengkap ?? '-';
                $nikPemohon  = $pemohon->nik ?? '-';
            @endphp

            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 md:p-8 text-left">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <div class="bg-white border border-slate-100 rounded-xl p-4 flex flex-col justify-center items-center text-center shadow-sm">
                        <span class="text-xs uppercase tracking-wider text-slate-500 font-semibold mb-1">Nomor Pengajuan</span>
                        <span class="font-bold text-primary-600 text-lg">{{ $permohonanSurat->nomor_permohonan }}</span>
                    </div>
                    
                    <div class="bg-white border border-slate-100 rounded-xl p-4 flex flex-col justify-center items-center text-center shadow-sm">
                        <span class="text-xs uppercase tracking-wider text-slate-500 font-semibold mb-1">Jenis Layanan</span>
                        <span class="font-bold text-primary-600 text-lg">{{ $permohonanSurat->jenisSurat->nama }}</span>
                    </div>

                    <div class="bg-white border border-slate-100 rounded-xl p-4 flex flex-col justify-center items-center text-center shadow-sm">
                        <span class="text-xs uppercase tracking-wider text-slate-500 font-semibold mb-1">Nama Pemohon</span>
                        <span class="font-bold text-slate-800 text-base">{{ $namaPemohon }}</span>
                    </div>
                    
                    <div class="bg-white border border-slate-100 rounded-xl p-4 flex flex-col justify-center items-center text-center shadow-sm">
                        <span class="text-xs uppercase tracking-wider text-slate-500 font-semibold mb-1">NIK Pemohon</span>
                        <span class="font-bold text-slate-800 text-base">{{ $nikPemohon }}</span>
                    </div>

                    <div class="bg-white border border-slate-100 rounded-xl p-4 flex flex-col justify-center items-center text-center shadow-sm">
                        <span class="text-xs uppercase tracking-wider text-slate-500 font-semibold mb-1">Tanggal & Waktu Pengajuan</span>
                        <span class="text-slate-800 font-medium">
                            {{ $permohonanSurat->created_at?->setTimezone('Asia/Makassar')->translatedFormat('l, j F Y, H:i') }} WITA
                        </span>
                    </div>
                    
                    <div class="bg-white border border-slate-100 rounded-xl p-4 flex flex-col justify-center items-center text-center shadow-sm">
                        <span class="text-xs uppercase tracking-wider text-slate-500 font-semibold mb-2">Status</span>
                        @php
                            $status = $permohonanSurat->status;
                            $badge = match($status) {
                                'Menunggu' => 'bg-amber-100 text-amber-700 border-amber-200',
                                'Diproses' => 'bg-blue-100 text-blue-700 border-blue-200',
                                'Selesai' => 'bg-green-100 text-green-700 border-green-200',
                                'Ditolak' => 'bg-red-100 text-red-700 border-red-200',
                                default => 'bg-slate-100 text-slate-700 border-slate-200',
                            };
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold border {{ $badge }}">
                            {{ $status }}
                        </span>
                    </div>
                </div>

                @php
                    $hasNote = !empty($permohonanSurat->catatan);
                    $statusAlertClass = match($status) {
                        'Selesai' => 'bg-green-50 border-green-500 text-green-700',
                        'Ditolak' => 'bg-red-50 border-red-500 text-red-700',
                        'Diproses' => 'bg-blue-50 border-blue-500 text-blue-700',
                        'Menunggu' => 'bg-amber-50 border-amber-500 text-amber-700',
                        default => 'bg-blue-50 border-blue-500 text-blue-700',
                    };

                    $submittedText = match($status) {
                        'Selesai' => 'Permohonan Anda telah selesai. Silakan datang ke kantor Kelurahan Bongki untuk mengambil Surat Keterangan yang telah dibuat.',
                        'Ditolak' => 'Permohonan Anda telah dikirim namun ditolak. Silakan hubungi petugas Kelurahan untuk detail alasan penolakan.',
                        'Diproses' => 'Permohonan Anda berhasil dikirim dan sedang diproses oleh petugas Kelurahan. Mohon tunggu informasi lebih lanjut.',
                        'Menunggu' => 'Permohonan Anda berhasil dikirim dan sedang menunggu verifikasi awal oleh petugas Kelurahan.',
                        default => 'Permohonan Anda berhasil dikirim. Simpan nomor pengajuan dan cek status secara berkala.',
                    };

                    $statusModeText = match($status) {
                        'Selesai' => 'Permohonan Anda telah selesai. Silakan datang ke kantor Kelurahan Bongki untuk mengambil Surat Keterangan yang telah dibuat.',
                        'Ditolak' => 'Mohon maaf, permohonan Anda ditolak. Silakan hubungi petugas Kelurahan untuk informasi lebih lanjut.',
                        'Diproses' => 'Permohonan Anda sedang diproses oleh petugas Kelurahan. Mohon cek kembali nanti untuk perkembangan status.',
                        'Menunggu' => 'Permohonan Anda masih menunggu verifikasi awal dari petugas Kelurahan. Silakan cek kembali dalam beberapa waktu.',
                        default => 'Simpan nomor pengajuan ini untuk mengecek perkembangan permohonan Anda.',
                    };

                    $noteText = $hasNote
                        ? 'Catatan petugas tersedia di bawah. Bacalah instruksi berikut untuk melengkapi berkas atau mempercepat proses.'
                        : '';

                    $alertText = $isStatusMode && $hasNote
                        ? $noteText
                        : ($isStatusMode ? $statusModeText : $submittedText);
                @endphp

                <div class="mt-8 mb-0 p-4 border-l-4 rounded-r-xl {{ $statusAlertClass }} text-center sm:text-left">
                    {{ $alertText }}
                </div>

                @if($hasNote)
                    <div class="mt-4 bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                        <strong class="block text-slate-800 mb-2">Catatan Petugas:</strong>
                        <div class="text-slate-600 text-sm leading-relaxed text-justify">
                            {!! nl2br(e($permohonanSurat->catatan)) !!}
                        </div>
                    </div>
                @endif
            </div>

            <div class="mt-8">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold transition-colors">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
