@extends('layouts.admin')

@section('title', 'Detail Laporan Persuratan')

@section('content')

<div class="w-full">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Detail Laporan Persuratan</h2>
            <p class="text-sm text-slate-500 mt-1">Informasi detail permohonan surat khusus dari laporan.</p>
        </div>
        <a href="{{ route('admin.laporan.persuratan') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none">
            <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Kiri (Col-2) --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Informasi Permohonan --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                        <i class="fa-solid fa-file-signature"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm">Informasi Permohonan</h3>
                </div>
                <div class="p-0">
                    <table class="w-full text-sm text-left text-slate-600">
                        <tbody class="divide-y divide-slate-100">
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <th width="200" class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30">Nomor Permohonan</th>
                                <td class="px-6 py-4 font-mono font-medium text-slate-900">{{ $permohonanSurat->nomor_permohonan ?? '-' }}</td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <th class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30">Nomor Surat</th>
                                <td class="px-6 py-4 font-mono text-slate-500">{{ $permohonanSurat->nomor_surat ?? 'Belum diterbitkan' }}</td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <th class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30">Jenis Surat</th>
                                <td class="px-6 py-4 font-bold text-slate-900">{{ optional($permohonanSurat->jenisSurat)->nama ?? '-' }}</td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <th class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30">Nama Pemohon</th>
                                <td class="px-6 py-4">{{ optional($permohonanSurat->penduduk)->nama_lengkap ?? '-' }}</td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <th class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30">NIK Pemohon</th>
                                <td class="px-6 py-4">{{ optional($permohonanSurat->penduduk)->nik ?? '-' }}</td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <th class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30">Tanggal Permohonan</th>
                                <td class="px-6 py-4">{{ $permohonanSurat->tanggal_permohonan ? $permohonanSurat->tanggal_permohonan->translatedFormat('d F Y') : '-' }}</td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <th class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30 align-top">Keperluan</th>
                                <td class="px-6 py-4 text-slate-700 leading-relaxed">{{ $permohonanSurat->keperluan ?? '-' }}</td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <th class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30 align-top">Alamat Domisili</th>
                                <td class="px-6 py-4 text-slate-700 leading-relaxed">{{ optional($permohonanSurat->penduduk)->alamat ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Kanan (Col-1) --}}
        <div class="lg:col-span-1 space-y-6">
            
            {{-- Status --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm">Status Laporan</h3>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Status Saat Ini</label>
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-{{ $permohonanSurat->status_badge_class }}-100 text-{{ $permohonanSurat->status_badge_class }}-700 tracking-wide uppercase">
                            {{ $permohonanSurat->status }}
                        </span>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Catatan Petugas</label>
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-slate-700 text-sm italic">
                            {{ $permohonanSurat->catatan ?? 'Tidak ada catatan.' }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Penandatangan --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <i class="fa-solid fa-signature"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm">Penandatangan</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400">
                            <i class="fa-solid fa-user-tie text-xl"></i>
                        </div>
                        <div>
                            <div class="font-bold text-slate-900">{{ optional($permohonanSurat->penandatangan)->nama_lengkap ?? 'Belum ditentukan' }}</div>
                            <div class="text-xs text-slate-500 mt-0.5">{{ optional(optional($permohonanSurat->penandatangan)->jabatan)->nama ?? 'Jabatan tidak diketahui' }}</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
