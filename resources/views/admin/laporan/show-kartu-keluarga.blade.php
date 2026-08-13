@extends('layouts.admin')

@section('title','Detail Laporan Kartu Keluarga')

@section('content')

<div class="w-full">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Detail Laporan Kartu Keluarga</h2>
            <p class="text-sm text-slate-500 mt-1">Informasi detail Kartu Keluarga khusus dari laporan.</p>
        </div>
        <a href="{{ route('admin.laporan.kartu-keluarga') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none">
            <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
        </a>
    </div>

    {{-- Kartu Keluarga Info --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <i class="fa-solid fa-house-user"></i>
            </div>
            <h3 class="font-bold text-slate-800 text-sm">Informasi Kepala Keluarga</h3>
        </div>
        <div class="p-0">
            <table class="w-full text-sm text-left text-slate-600">
                <tbody class="divide-y divide-slate-100">
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <th width="250" class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30">No. Kartu Keluarga</th>
                        <td class="px-6 py-4 font-mono text-slate-900 font-bold text-base">{{ $kartuKeluarga->no_kk }}</td>
                    </tr>
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <th class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30">Kepala Keluarga</th>
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-900">{{ $kartuKeluarga->kepalaKeluarga->nama_lengkap ?? '-' }}</div>
                            <div class="text-xs text-slate-500 mt-0.5">
                                {{ $kartuKeluarga->kepalaKeluarga->tempat_lahir ?? '-' }},
                                {{ $kartuKeluarga->kepalaKeluarga?->tanggal_lahir ? \Carbon\Carbon::parse($kartuKeluarga->kepalaKeluarga->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <th class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30">Lingkungan</th>
                        <td class="px-6 py-4">{{ $kartuKeluarga->lingkungan->nama ?? '-' }}</td>
                    </tr>
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <th class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30">RT / RW</th>
                        <td class="px-6 py-4 font-medium text-slate-700">{{ $kartuKeluarga->rt ?? '00' }} / {{ $kartuKeluarga->rw ?? '00' }}</td>
                    </tr>
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <th class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30 align-top">Alamat</th>
                        <td class="px-6 py-4 text-slate-700 leading-relaxed">{{ $kartuKeluarga->alamat ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Anggota Keluarga --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center">
                    <i class="fa-solid fa-users"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-sm">Anggota Keluarga</h3>
            </div>
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-sky-100 text-sky-700">
                {{ $kartuKeluarga->anggota->count() }} Anggota
            </span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/80">
                    <tr>
                        <th class="px-6 py-4 border-b border-slate-100 w-16 text-center">No</th>
                        <th class="px-6 py-4 border-b border-slate-100">NIK</th>
                        <th class="px-6 py-4 border-b border-slate-100">Nama Lengkap</th>
                        <th class="px-6 py-4 border-b border-slate-100">Tempat, Tanggal Lahir</th>
                        <th class="px-6 py-4 border-b border-slate-100">Hubungan</th>
                        <th class="px-6 py-4 border-b border-slate-100 text-center">Jenis Kelamin</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($kartuKeluarga->anggota as $anggota)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-6 py-4 text-center font-medium">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-mono text-xs text-slate-700">{{ $anggota->nik }}</td>
                        <td class="px-6 py-4 font-bold text-slate-900">{{ $anggota->nama_lengkap }}</td>
                        <td class="px-6 py-4 text-slate-500">
                            {{ $anggota->tempat_lahir ?? '-' }},
                            {{ $anggota->tanggal_lahir ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->translatedFormat('d M Y') : '-' }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold bg-slate-100 text-slate-700">
                                {{ $anggota->hubungan_keluarga ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($anggota->jenis_kelamin == 'L')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-sky-100 text-sky-700">Laki-laki</span>
                            @elseif($anggota->jenis_kelamin == 'P')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700">Perempuan</span>
                            @else
                                <span class="text-slate-400">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <i class="fa-solid fa-inbox text-4xl mb-4 text-slate-300"></i>
                                <p class="text-sm">Belum ada anggota keluarga.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
