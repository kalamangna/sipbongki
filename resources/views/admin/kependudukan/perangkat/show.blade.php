@extends('layouts.admin')

@section('title', 'Profil Aparatur')

@section('content')
<div class="w-full">

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight dark:text-slate-100">Profil Aparatur</h2>
            <p class="text-sm text-slate-500 mt-1 dark:text-slate-400">Informasi lengkap aparatur kelurahan</p>
        </div>
        <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
            <a href="{{ route('admin.perangkat.index') }}" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none active:scale-95 cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white">
                <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
            </a>
            <a href="{{ route('admin.perangkat.edit', $perangkat) }}" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-100 border border-amber-200 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none active:scale-95 cursor-pointer dark:bg-amber-950/40 dark:border-amber-900/60 dark:text-amber-300 dark:hover:bg-amber-900/50">
                <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>
            <form action="{{ route('admin.perangkat.destroy', $perangkat) }}" method="POST" class="w-full sm:w-auto inline mb-0" onsubmit="return confirm('Yakin ingin menghapus data pejabat kelurahan ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-rose-600 text-white hover:bg-rose-700 shadow-sm transition-all hover:-translate-y-0.5 shadow-rose-500/20 focus:outline-none active:scale-95 cursor-pointer">
                    <i class="fa-solid fa-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Kolom Kiri: Foto Profil --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col items-center justify-center p-8 text-center h-full dark:bg-slate-900 dark:border-slate-800">
                <div class="relative w-40 h-40 mb-5">
                    @if($perangkat->foto)
                        <img src="{{ asset('storage/'.$perangkat->foto) }}" class="w-full h-full rounded-full object-cover ring-4 ring-primary-50 dark:ring-primary-950/60 shadow-md">
                    @else
                        <div class="w-full h-full rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-500 ring-4 ring-slate-50 dark:ring-slate-800 shadow-md text-6xl">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                    @endif
                    
                    @if($perangkat->aktif)
                        <div class="absolute bottom-1 right-3 w-6 h-6 rounded-full bg-emerald-500 border-4 border-white dark:border-slate-900" title="Aktif Menjabat"></div>
                    @else
                        <div class="absolute bottom-1 right-3 w-6 h-6 rounded-full bg-slate-300 dark:bg-slate-600 border-4 border-white dark:border-slate-900" title="Tidak Aktif"></div>
                    @endif
                </div>

                <h3 class="text-xl font-bold text-slate-900 mb-1 dark:text-slate-100">{{ $perangkat->nama_lengkap }}</h3>
                <p class="font-medium text-primary-600 mb-4 dark:text-primary-400">{{ $perangkat->jabatan->nama ?? '-' }}</p>

                @if($perangkat->aktif)
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 tracking-wide">
                        <i class="fa-solid fa-check-circle mr-1.5"></i> Aktif Menjabat
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400 tracking-wide">
                        <i class="fa-solid fa-power-off mr-1.5"></i> Tidak Aktif
                    </span>
                @endif
            </div>
        </div>

        {{-- Kolom Kanan: Data Profil --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden h-full dark:bg-slate-900 dark:border-slate-800">
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
                    <h3 class="font-bold text-slate-800 dark:text-slate-100">Identitas Kepegawaian</h3>
                </div>
                
                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-8 gap-x-10">
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wider dark:text-slate-400">Nama Lengkap</p>
                            <p class="font-bold text-slate-900 text-lg dark:text-slate-100">{{ $perangkat->nama_lengkap }}</p>
                        </div>
                        
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wider dark:text-slate-400">Nomor Induk Pegawai (NIP)</p>
                            <p class="font-mono font-medium text-slate-900 text-base dark:text-slate-100">
                                {{ $perangkat->nip ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wider dark:text-slate-400">Tempat, Tanggal Lahir</p>
                            <p class="font-medium text-slate-900 text-base dark:text-slate-100">
                                {{ $perangkat->tempat_lahir ?? '-' }}, 
                                {{ $perangkat->tanggal_lahir ? \Carbon\Carbon::parse($perangkat->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                            </p>
                        </div>
                        
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wider dark:text-slate-400">Agama</p>
                            <p class="font-medium text-slate-900 text-base dark:text-slate-100">
                                {{ $perangkat->agama ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wider dark:text-slate-400">Pendidikan Terakhir</p>
                            <p class="font-medium text-slate-900 text-base dark:text-slate-100">
                                {{ $perangkat->pendidikan ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wider dark:text-slate-400">Pangkat / Golongan</p>
                            <p class="font-medium text-slate-900 text-base dark:text-slate-100">
                                {{ $perangkat->pangkat_golongan ?? '-' }}
                            </p>
                        </div>
                        
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wider dark:text-slate-400">Nomor Keputusan Pengangkatan</p>
                            <p class="font-medium text-slate-900 text-base dark:text-slate-100">
                                {{ $perangkat->no_sk_pengangkatan ?? '-' }}
                            </p>
                            @if($perangkat->tanggal_sk_pengangkatan)
                                <p class="text-xs text-slate-500 mt-1 dark:text-slate-400">Tanggal SK: {{ \Carbon\Carbon::parse($perangkat->tanggal_sk_pengangkatan)->translatedFormat('d M Y') }}</p>
                            @endif
                        </div>
                        
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wider dark:text-slate-400">Nomor Keputusan Pemberhentian</p>
                            <p class="font-medium text-slate-900 text-base dark:text-slate-100">
                                {{ $perangkat->no_sk_pemberhentian ?? '-' }}
                            </p>
                            @if($perangkat->tanggal_sk_pemberhentian)
                                <p class="text-xs text-slate-500 mt-1 dark:text-slate-400">Tanggal SK: {{ \Carbon\Carbon::parse($perangkat->tanggal_sk_pemberhentian)->translatedFormat('d M Y') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

</div>
@endsection