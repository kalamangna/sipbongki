@extends('layouts.admin')

@section('title', 'Detail Kartu Keluarga')

@section('content')
<div class="w-full">

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight dark:text-slate-100">Detail Kartu Keluarga</h2>
            <p class="text-sm text-slate-500 mt-1 dark:text-slate-400">Informasi lengkap KK No. <span class="font-mono font-semibold text-slate-700 dark:text-slate-200">{{ $kartuKeluarga->no_kk }}</span></p>
        </div>
        <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
            <a href="{{ route('admin.kartu-keluarga.index') }}" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none active:scale-95 cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white">
                <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
            </a>
            @if(in_array(auth()->user()->role, ['admin', 'operator']))
            <a href="{{ route('admin.kartu-keluarga.edit', $kartuKeluarga) }}" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-100 border border-amber-200 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none active:scale-95 cursor-pointer dark:bg-amber-950/60 dark:text-amber-300 dark:border-amber-900/60 dark:hover:bg-amber-900/50">
                <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>
            <form action="{{ route('admin.kartu-keluarga.destroy', $kartuKeluarga) }}" method="POST" class="w-full sm:w-auto inline mb-0" onsubmit="return confirm('Yakin ingin menghapus Kartu Keluarga ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-rose-600 text-white hover:bg-rose-700 shadow-sm transition-all hover:-translate-y-0.5 shadow-rose-500/20 focus:outline-none active:scale-95 cursor-pointer">
                    <i class="fa-solid fa-trash"></i> Hapus
                </button>
            </form>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        
        {{-- Card: Informasi KK --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 dark:bg-slate-800/50 dark:border-slate-800">
                <h3 class="font-bold text-slate-800 dark:text-slate-100">Identitas Kartu Keluarga</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                    <div>
                        <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Nomor Kartu Keluarga</p>
                        <p class="font-mono font-bold text-slate-900 text-lg tracking-tight dark:text-slate-100">{{ $kartuKeluarga->no_kk }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Kepala Keluarga</p>
                        <p class="font-bold text-slate-900 text-base dark:text-slate-100">{{ $kartuKeluarga->kepalaKeluarga->nama_lengkap ?? '-' }}</p>
                        @if($kartuKeluarga->kepalaKeluarga)
                        <p class="text-[11px] text-slate-500 mt-0.5 dark:text-slate-400">
                            {{ $kartuKeluarga->kepalaKeluarga->tempat_lahir ?? '-' }}, 
                            {{ $kartuKeluarga->kepalaKeluarga->tanggal_lahir ? $kartuKeluarga->kepalaKeluarga->tanggal_lahir->translatedFormat('d M Y') : '-' }}
                        </p>
                        @endif
                    </div>
                    <div class="sm:col-span-2 border-t border-slate-100 pt-5 mt-1 dark:border-slate-800">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                            <div>
                                <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Lingkungan</p>
                                <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $kartuKeluarga->lingkungan->nama ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">RT / RW</p>
                                <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $kartuKeluarga->rt ?? '00' }} / {{ $kartuKeluarga->rw ?? '00' }}</p>
                            </div>
                            <div class="sm:col-span-2">
                                <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Alamat Lengkap</p>
                                <p class="font-medium text-slate-900 text-base leading-relaxed dark:text-slate-100">{{ $kartuKeluarga->alamat ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card: Status & Sistem --}}
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 dark:bg-slate-800/50 dark:border-slate-800">
                    <h3 class="font-bold text-slate-800 dark:text-slate-100">Status Data</h3>
                </div>
                <div class="p-6">
                    <div class="flex flex-col gap-5">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Status Aktif</span>
                            @if($kartuKeluarga->aktif)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 tracking-wide dark:bg-emerald-950/60 dark:text-emerald-300">AKTIF</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 tracking-wide dark:bg-rose-950/60 dark:text-rose-300">TIDAK AKTIF</span>
                            @endif
                        </div>
                        <div class="h-px w-full bg-slate-100 dark:bg-slate-800"></div>
                        <div>
                            <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-widest mb-0.5 dark:text-slate-400">Dibuat Pada</p>
                            <p class="text-sm font-medium text-slate-800 dark:text-slate-200">{{ $kartuKeluarga->created_at ? $kartuKeluarga->created_at->translatedFormat('d M Y, H:i') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-widest mb-0.5 dark:text-slate-400">Terakhir Diperbarui</p>
                            <p class="text-sm font-medium text-slate-800 dark:text-slate-200">{{ $kartuKeluarga->updated_at ? $kartuKeluarga->updated_at->translatedFormat('d M Y, H:i') : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-primary-600 rounded-2xl shadow-sm p-6 relative overflow-hidden">
                <i class="fa-solid fa-users absolute -bottom-4 -right-4 text-7xl text-white opacity-10"></i>
                <div class="relative z-10">
                    <p class="text-primary-100 text-xs font-semibold uppercase tracking-widest mb-1">Total Anggota</p>
                    <p class="text-4xl font-extrabold text-white tracking-tight">{{ $kartuKeluarga->anggota->count() }} <span class="text-lg font-medium text-primary-200">Orang</span></p>
                </div>
            </div>
        </div>

    </div>

    {{-- Daftar Anggota Keluarga --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-8 dark:bg-slate-900 dark:border-slate-800">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50 dark:bg-slate-800/50 dark:border-slate-800">
            <h3 class="font-bold text-slate-800 dark:text-slate-100">Daftar Anggota Keluarga</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600 min-w-[650px] dark:text-slate-300">
                <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/50 dark:bg-slate-800/80 dark:text-slate-400">
                    <tr>
                        <th width="50" class="px-4 sm:px-6 py-4 border-b border-slate-100 text-center dark:border-slate-800">No</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">NIK</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">Nama Lengkap</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">TTL</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">Hubungan</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 text-center dark:border-slate-800">L/P</th>
                        <th width="80" class="px-4 sm:px-6 py-4 border-b border-slate-100 text-center dark:border-slate-800">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($kartuKeluarga->anggota as $anggota)
                        <tr class="hover:bg-slate-50/80 transition-colors dark:hover:bg-slate-800/50 {{ $anggota->id === $kartuKeluarga->kepala_keluarga_id ? 'bg-primary-50/30 dark:bg-primary-950/20' : '' }}">
                            <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center font-medium">{{ $loop->iteration }}</td>
                            <td class="px-4 sm:px-6 py-3.5 sm:py-4 font-mono text-xs">{{ $anggota->nik }}</td>
                            <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                                <p class="font-bold text-slate-900 dark:text-slate-100">{{ $anggota->nama_lengkap }}</p>
                                @if($anggota->id === $kartuKeluarga->kepala_keluarga_id)
                                    <span class="inline-block mt-1 px-2 py-0.5 rounded text-[10px] font-bold bg-primary-100 text-primary-700 uppercase tracking-wider dark:bg-primary-950/60 dark:text-primary-300">Kepala Keluarga</span>
                                @endif
                            </td>
                            <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                                {{ $anggota->tempat_lahir ?? '-' }},<br>
                                <span class="text-xs text-slate-500 dark:text-slate-400">{{ $anggota->tanggal_lahir ? $anggota->tanggal_lahir->translatedFormat('d M Y') : '-' }}</span>
                            </td>
                            <td class="px-4 sm:px-6 py-3.5 sm:py-4 font-medium text-slate-700 dark:text-slate-300">{{ $anggota->hubungan_keluarga ?? '-' }}</td>
                            <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">
                                @gender($anggota->jenis_kelamin)
                            </td>
                            <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">
                                <a href="{{ route('admin.penduduk.show', $anggota->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 hover:text-sky-700 transition-colors focus:outline-none active:scale-95 dark:bg-sky-950/60 dark:text-sky-300 dark:hover:bg-sky-900/50" title="Lihat Profil">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-400 dark:text-slate-500">
                                <i class="fa-solid fa-user-xmark text-3xl mb-3 text-slate-300 dark:text-slate-600"></i>
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