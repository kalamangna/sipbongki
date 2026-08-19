@extends('layouts.admin')

@section('title', 'Detail Data Penduduk')

@section('content')
<div class="w-full">

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight dark:text-slate-100">Detail Data Penduduk</h2>
            <p class="text-sm text-slate-500 mt-1 dark:text-slate-400">Informasi lengkap kependudukan atas nama <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $penduduk->nama_lengkap }}</span></p>
        </div>
        <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
            <a href="{{ route('admin.penduduk.index') }}" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none active:scale-95 cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white">
                <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
            </a>
            @if(in_array(auth()->user()->role, ['admin', 'operator']))
            <a href="{{ route('admin.penduduk.edit', $penduduk) }}" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-100 border border-amber-200 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none active:scale-95 cursor-pointer dark:bg-amber-950/60 dark:text-amber-300 dark:border-amber-900/60 dark:hover:bg-amber-900/50">
                <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>
            <form action="{{ route('admin.penduduk.destroy', $penduduk) }}" method="POST" class="w-full sm:w-auto inline mb-0" onsubmit="return confirm('Yakin ingin menghapus data penduduk ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-rose-600 text-white hover:bg-rose-700 shadow-sm transition-all hover:-translate-y-0.5 shadow-rose-500/20 focus:outline-none active:scale-95 cursor-pointer">
                    <i class="fa-solid fa-trash"></i> Hapus
                </button>
            </form>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Left Column: Identitas Utama --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Data Pribadi --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800">
                    <h3 class="font-bold text-slate-800 dark:text-slate-100">Identitas Pribadi</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">NIK</p>
                            <p class="font-mono font-medium text-slate-900 text-base dark:text-slate-100">{{ $penduduk->nik }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Nama Lengkap</p>
                            <p class="font-bold text-slate-900 text-base dark:text-slate-100">{{ $penduduk->nama_lengkap }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Jenis Kelamin</p>
                            <p class="font-medium text-slate-900 text-base dark:text-slate-100">@gender($penduduk->jenis_kelamin)</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Tempat, Tanggal Lahir</p>
                            <p class="font-medium text-slate-900 text-base dark:text-slate-100">
                                {{ $penduduk->tempat_lahir }}, {{ $penduduk->tanggal_lahir ? $penduduk->tanggal_lahir->translatedFormat('d F Y') : '-' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Agama</p>
                            <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $penduduk->agama ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Telepon / WhatsApp</p>
                            <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $penduduk->telepon ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Email</p>
                            <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $penduduk->email ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Pendidikan</p>
                            <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $penduduk->pendidikan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Pekerjaan</p>
                            <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $penduduk->pekerjaan ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Status Perkawinan & Keluarga --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800">
                    <h3 class="font-bold text-slate-800 dark:text-slate-100">Status & Keluarga</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Status Perkawinan</p>
                            <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $penduduk->status_perkawinan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Hubungan dalam Keluarga</p>
                            <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $penduduk->hubungan_keluarga ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Nomor Kartu Keluarga (KK)</p>
                            @if($penduduk->kartuKeluarga)
                                <a href="{{ route('admin.kartu-keluarga.show', $penduduk->kartuKeluarga) }}" class="inline-flex items-center gap-1 font-mono font-semibold text-primary-600 hover:text-primary-700 transition-colors dark:text-primary-400 dark:hover:text-primary-300">
                                    {{ $penduduk->kartuKeluarga->no_kk ?? $penduduk->kartuKeluarga->nomor_kk }}
                                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                </a>
                            @else
                                <p class="font-medium text-slate-900 text-base dark:text-slate-100">-</p>
                            @endif
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Nama Kepala Keluarga</p>
                            <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $penduduk->kartuKeluarga->kepalaKeluarga->nama_lengkap ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Hak Akses Publik</p>
                            @if($penduduk->is_public)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-950/60 dark:text-blue-300">Ya</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">Tidak</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Right Column: Alamat & Sistem --}}
        <div class="space-y-6">
            
            {{-- Alamat & Lingkungan --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800">
                    <h3 class="font-bold text-slate-800 dark:text-slate-100">Alamat</h3>
                </div>
                <div class="p-6">
                    <div class="flex flex-col gap-6">
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Lingkungan / Dusun</p>
                            <p class="font-bold text-slate-900 text-base dark:text-slate-100">{{ $penduduk->lingkungan->nama ?? '-' }}</p>
                        </div>
                        <div class="flex gap-8">
                            <div>
                                <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">RT</p>
                                <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $penduduk->rt ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">RW</p>
                                <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $penduduk->rw ?? '-' }}</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Alamat Lengkap</p>
                            <p class="font-medium text-slate-900 text-base leading-relaxed dark:text-slate-100">{{ $penduduk->alamat ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Status Validasi Alamat</p>
                            <p class="font-medium text-slate-900 text-base dark:text-slate-100">
                                @if($penduduk->status_validasi_alamat === 'Valid')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300">
                                        <i class="fa-solid fa-check-circle mr-1"></i> Valid
                                    </span>
                                @elseif($penduduk->status_validasi_alamat === 'Perlu Verifikasi')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700 dark:bg-rose-950/60 dark:text-rose-300">
                                        <i class="fa-solid fa-triangle-exclamation mr-1"></i> Perlu Verifikasi
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700 dark:bg-amber-950/60 dark:text-amber-300">
                                        <i class="fa-solid fa-circle-question mr-1"></i> Belum Divalidasi
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sistem --}}
            <div class="bg-slate-50 rounded-2xl border border-slate-200 shadow-inner overflow-hidden dark:bg-slate-900 dark:border-slate-800">
                <div class="p-6">
                    <div class="flex flex-col gap-5">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Status Data</span>
                            @if($penduduk->aktif)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 tracking-wide dark:bg-emerald-950/60 dark:text-emerald-300">AKTIF</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 tracking-wide dark:bg-rose-950/60 dark:text-rose-300">TIDAK AKTIF</span>
                            @endif
                        </div>
                        <div class="h-px w-full bg-slate-200 dark:bg-slate-800"></div>
                        <div>
                            <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-widest mb-0.5 dark:text-slate-400">Dibuat Pada</p>
                            <p class="text-sm font-medium text-slate-800 dark:text-slate-200">{{ $penduduk->created_at ? $penduduk->created_at->translatedFormat('d M Y, H:i') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-widest mb-0.5 dark:text-slate-400">Terakhir Diperbarui</p>
                            <p class="text-sm font-medium text-slate-800 dark:text-slate-200">{{ $penduduk->updated_at ? $penduduk->updated_at->translatedFormat('d M Y, H:i') : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection