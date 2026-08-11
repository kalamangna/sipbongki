@extends('layouts.admin')

@section('title', 'Detail Penduduk')

@section('content')
<div class="w-full">

    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Detail Penduduk</h2>
            <p class="text-sm text-slate-500 mt-1">Informasi lengkap kependudukan atas nama <span class="font-semibold text-slate-700">{{ $penduduk->nama_lengkap }}</span></p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.penduduk.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5">
                <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
            </a>
            <a href="{{ route('admin.penduduk.edit', $penduduk) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-100 border border-amber-200 shadow-sm transition-all hover:-translate-y-0.5">
                <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>
            <form action="{{ route('admin.penduduk.destroy', $penduduk) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data penduduk ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-rose-600 text-white hover:bg-rose-700 shadow-sm transition-all hover:-translate-y-0.5 shadow-rose-500/20">
                    <i class="fa-solid fa-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Left Column: Identitas Utama --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Data Pribadi --}}
            <div class="bg-white rounded-3xl ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-primary-50 flex items-center justify-center text-primary-600">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <h3 class="font-bold text-slate-800">Identitas Pribadi</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">NIK</p>
                            <p class="font-mono font-medium text-slate-900 text-base">{{ $penduduk->nik }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">Nama Lengkap</p>
                            <p class="font-bold text-slate-900 text-base">{{ $penduduk->nama_lengkap }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">Jenis Kelamin</p>
                            <p class="font-medium text-slate-900 text-base">@gender($penduduk->jenis_kelamin)</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">Tempat, Tanggal Lahir</p>
                            <p class="font-medium text-slate-900 text-base">
                                {{ $penduduk->tempat_lahir }}, {{ $penduduk->tanggal_lahir ? $penduduk->tanggal_lahir->translatedFormat('d F Y') : '-' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">Agama</p>
                            <p class="font-medium text-slate-900 text-base">{{ $penduduk->agama ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">Golongan Darah</p>
                            <p class="font-medium text-slate-900 text-base">{{ $penduduk->golongan_darah ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">Pendidikan</p>
                            <p class="font-medium text-slate-900 text-base">{{ $penduduk->pendidikan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">Pekerjaan</p>
                            <p class="font-medium text-slate-900 text-base">{{ $penduduk->pekerjaan ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Status Perkawinan & Keluarga --}}
            <div class="bg-white rounded-3xl ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600">
                        <i class="fa-solid fa-people-roof"></i>
                    </div>
                    <h3 class="font-bold text-slate-800">Status & Keluarga</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">Status Perkawinan</p>
                            <p class="font-medium text-slate-900 text-base">{{ $penduduk->status_perkawinan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">Hubungan dalam Keluarga</p>
                            <p class="font-medium text-slate-900 text-base">{{ $penduduk->hubungan_keluarga ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">Nomor Kartu Keluarga (KK)</p>
                            @if($penduduk->kartuKeluarga)
                                <a href="{{ route('admin.kartu-keluarga.show', $penduduk->kartuKeluarga) }}" class="inline-flex items-center gap-1 font-mono font-semibold text-primary-600 hover:text-primary-700 transition-colors">
                                    {{ $penduduk->kartuKeluarga->no_kk }}
                                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                </a>
                            @else
                                <p class="font-medium text-slate-900 text-base">-</p>
                            @endif
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">Nama Kepala Keluarga</p>
                            <p class="font-medium text-slate-900 text-base">{{ $penduduk->kartuKeluarga->kepalaKeluarga->nama_lengkap ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">Nama Ayah</p>
                            <p class="font-medium text-slate-900 text-base">{{ $penduduk->nama_ayah ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">Nama Ibu</p>
                            <p class="font-medium text-slate-900 text-base">{{ $penduduk->nama_ibu ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Right Column: Alamat & Sistem --}}
        <div class="space-y-6">
            
            {{-- Alamat & Lingkungan --}}
            <div class="bg-white rounded-3xl ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center text-amber-600">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <h3 class="font-bold text-slate-800">Alamat</h3>
                </div>
                <div class="p-6">
                    <div class="flex flex-col gap-6">
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">Lingkungan / Dusun</p>
                            <p class="font-bold text-slate-900 text-base">{{ $penduduk->lingkungan->nama ?? '-' }}</p>
                        </div>
                        <div class="flex gap-8">
                            <div>
                                <p class="text-xs font-semibold text-slate-500 mb-1">RT</p>
                                <p class="font-medium text-slate-900 text-base">{{ $penduduk->rt ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-slate-500 mb-1">RW</p>
                                <p class="font-medium text-slate-900 text-base">{{ $penduduk->rw ?? '-' }}</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">Alamat Lengkap</p>
                            <p class="font-medium text-slate-900 text-base leading-relaxed">{{ $penduduk->alamat ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sistem --}}
            <div class="bg-slate-50 rounded-3xl ring-1 ring-slate-200/60 shadow-inner overflow-hidden">
                <div class="p-6">
                    <div class="flex flex-col gap-5">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-semibold text-slate-500">Status Data</span>
                            @if($penduduk->aktif)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 tracking-wide">AKTIF</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 tracking-wide">TIDAK AKTIF</span>
                            @endif
                        </div>
                        <div class="h-px w-full bg-slate-200"></div>
                        <div>
                            <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-widest mb-0.5">Dibuat Pada</p>
                            <p class="text-sm font-medium text-slate-800">{{ $penduduk->created_at ? $penduduk->created_at->translatedFormat('d M Y, H:i') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-widest mb-0.5">Terakhir Diperbarui</p>
                            <p class="text-sm font-medium text-slate-800">{{ $penduduk->updated_at ? $penduduk->updated_at->translatedFormat('d M Y, H:i') : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection