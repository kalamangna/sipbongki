@extends('layouts.admin')

@section('title', 'Detail Kartu Keluarga')

@section('content')
<div class="w-full">

    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Detail Kartu Keluarga</h2>
            <p class="text-sm text-slate-500 mt-1">Informasi lengkap KK No. <span class="font-mono font-semibold text-slate-700">{{ $kartuKeluarga->no_kk }}</span></p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.kartu-keluarga.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5">
                <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
            </a>
            <a href="{{ route('admin.kartu-keluarga.edit', $kartuKeluarga) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-100 border border-amber-200 shadow-sm transition-all hover:-translate-y-0.5">
                <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>
            <form action="{{ route('admin.kartu-keluarga.destroy', $kartuKeluarga) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus Kartu Keluarga ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-rose-600 text-white hover:bg-rose-700 shadow-sm transition-all hover:-translate-y-0.5 shadow-rose-500/20">
                    <i class="fa-solid fa-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        
        {{-- Card: Informasi KK --}}
        <div class="lg:col-span-2 bg-white rounded-3xl ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3 bg-slate-50/50">
                <div class="w-8 h-8 rounded-full bg-primary-50 flex items-center justify-center text-primary-600">
                    <i class="fa-solid fa-address-card"></i>
                </div>
                <h3 class="font-bold text-slate-800">Identitas Kartu Keluarga</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                    <div>
                        <p class="text-xs font-semibold text-slate-500 mb-1">Nomor Kartu Keluarga</p>
                        <p class="font-mono font-bold text-slate-900 text-lg tracking-tight">{{ $kartuKeluarga->no_kk }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 mb-1">Kepala Keluarga</p>
                        <p class="font-bold text-slate-900 text-base">{{ $kartuKeluarga->kepalaKeluarga->nama_lengkap ?? '-' }}</p>
                        @if($kartuKeluarga->kepalaKeluarga)
                        <p class="text-[11px] text-slate-500 mt-0.5">
                            {{ $kartuKeluarga->kepalaKeluarga->tempat_lahir ?? '-' }}, 
                            {{ $kartuKeluarga->kepalaKeluarga->tanggal_lahir ? $kartuKeluarga->kepalaKeluarga->tanggal_lahir->translatedFormat('d M Y') : '-' }}
                        </p>
                        @endif
                    </div>
                    <div class="sm:col-span-2 border-t border-slate-100 pt-5 mt-1">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                            <div>
                                <p class="text-xs font-semibold text-slate-500 mb-1">Lingkungan</p>
                                <p class="font-medium text-slate-900 text-base">{{ $kartuKeluarga->lingkungan->nama ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-slate-500 mb-1">RT / RW</p>
                                <p class="font-medium text-slate-900 text-base">{{ $kartuKeluarga->rt ?? '00' }} / {{ $kartuKeluarga->rw ?? '00' }}</p>
                            </div>
                            <div class="sm:col-span-2">
                                <p class="text-xs font-semibold text-slate-500 mb-1">Alamat Lengkap</p>
                                <p class="font-medium text-slate-900 text-base leading-relaxed">{{ $kartuKeluarga->alamat ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card: Status & Sistem --}}
        <div class="space-y-6">
            <div class="bg-white rounded-3xl ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3 bg-slate-50/50">
                    <div class="w-8 h-8 rounded-full bg-sky-50 flex items-center justify-center text-sky-600">
                        <i class="fa-solid fa-server"></i>
                    </div>
                    <h3 class="font-bold text-slate-800">Status Data</h3>
                </div>
                <div class="p-6">
                    <div class="flex flex-col gap-5">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-semibold text-slate-500">Status Aktif</span>
                            @if($kartuKeluarga->aktif)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 tracking-wide">AKTIF</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 tracking-wide">TIDAK AKTIF</span>
                            @endif
                        </div>
                        <div class="h-px w-full bg-slate-100"></div>
                        <div>
                            <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-widest mb-0.5">Dibuat Pada</p>
                            <p class="text-sm font-medium text-slate-800">{{ $kartuKeluarga->created_at ? $kartuKeluarga->created_at->translatedFormat('d M Y, H:i') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-widest mb-0.5">Terakhir Diperbarui</p>
                            <p class="text-sm font-medium text-slate-800">{{ $kartuKeluarga->updated_at ? $kartuKeluarga->updated_at->translatedFormat('d M Y, H:i') : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-primary-600 rounded-3xl shadow-[0_4px_20px_-4px_rgba(6,81,237,0.3)] p-6 relative overflow-hidden">
                <i class="fa-solid fa-users absolute -bottom-4 -right-4 text-7xl text-white opacity-10"></i>
                <div class="relative z-10">
                    <p class="text-primary-100 text-xs font-semibold uppercase tracking-widest mb-1">Total Anggota</p>
                    <p class="text-4xl font-extrabold text-white tracking-tight">{{ $kartuKeluarga->anggota->count() }} <span class="text-lg font-medium text-primary-200">Orang</span></p>
                </div>
            </div>
        </div>

    </div>

    {{-- Daftar Anggota Keluarga --}}
    <div class="bg-white rounded-3xl ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] overflow-hidden mb-8">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h3 class="font-bold text-slate-800 flex items-center gap-2">
                <i class="fa-solid fa-users text-slate-400"></i> Daftar Anggota Keluarga
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs font-semibold text-slate-500 uppercase bg-white">
                    <tr>
                        <th width="50" class="px-6 py-4 border-b border-slate-100 text-center">No</th>
                        <th class="px-6 py-4 border-b border-slate-100">NIK</th>
                        <th class="px-6 py-4 border-b border-slate-100">Nama Lengkap</th>
                        <th class="px-6 py-4 border-b border-slate-100">TTL</th>
                        <th class="px-6 py-4 border-b border-slate-100">Hubungan</th>
                        <th class="px-6 py-4 border-b border-slate-100 text-center">L/P</th>
                        <th width="80" class="px-6 py-4 border-b border-slate-100 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($kartuKeluarga->anggota as $anggota)
                        <tr class="hover:bg-slate-50/80 transition-colors {{ $anggota->id === $kartuKeluarga->kepala_keluarga_id ? 'bg-primary-50/30' : '' }}">
                            <td class="px-6 py-4 text-center font-medium">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-mono text-xs">{{ $anggota->nik }}</td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-900">{{ $anggota->nama_lengkap }}</p>
                                @if($anggota->id === $kartuKeluarga->kepala_keluarga_id)
                                    <span class="inline-block mt-1 px-2 py-0.5 rounded text-[10px] font-bold bg-primary-100 text-primary-700 uppercase tracking-wider">Kepala Keluarga</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ $anggota->tempat_lahir ?? '-' }},<br>
                                <span class="text-xs text-slate-500">{{ $anggota->tanggal_lahir ? $anggota->tanggal_lahir->translatedFormat('d M Y') : '-' }}</span>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-700">{{ $anggota->hubungan_keluarga ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                @gender($anggota->jenis_kelamin)
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.penduduk.show', $anggota->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 hover:text-sky-700 transition-colors" title="Lihat Profil">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-400">
                                <i class="fa-solid fa-user-xmark text-3xl mb-3 text-slate-300"></i>
                                <p>Belum ada anggota keluarga yang didaftarkan ke KK ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection