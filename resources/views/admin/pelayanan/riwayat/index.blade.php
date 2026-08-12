@extends('layouts.admin')

@section('title', 'Riwayat Pelayanan')

@section('content')

<div class="w-full">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Riwayat Pelayanan</h2>
            <p class="text-sm text-slate-500 mt-1">Semua riwayat pelayanan permohonan surat yang telah selesai atau ditolak.</p>
        </div>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
            <h5 class="text-sm font-bold text-slate-800">Daftar Riwayat</h5>
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-primary-50 text-primary-700">
                {{ $riwayats->total() }} Data
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/80">
                    <tr>
                        <th width="70" class="px-6 py-4 border-b border-slate-100 text-center">No</th>
                        <th class="px-6 py-4 border-b border-slate-100">No. Permohonan</th>
                        <th class="px-6 py-4 border-b border-slate-100">Pemohon</th>
                        <th class="px-6 py-4 border-b border-slate-100">Jenis Surat</th>
                        <th class="px-6 py-4 border-b border-slate-100 text-center">Status</th>
                        <th class="px-6 py-4 border-b border-slate-100 text-center">Tanggal Selesai</th>
                        <th width="150" class="px-6 py-4 border-b border-slate-100 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($riwayats as $item)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-6 py-4 text-center text-slate-400 text-xs">{{ $riwayats->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-4 font-mono font-medium text-slate-900 text-xs">{{ $item->nomor_permohonan }}</td>
                        <td class="px-6 py-4">
                            <span class="font-medium text-slate-900">{{ optional($item->penduduk)->nama_lengkap ?? data_get($item->data_surat, 'nama_lengkap') ?? '-' }}</span>
                        </td>
                        <td class="px-6 py-4 text-slate-700">
                            {{ $item->jenisSurat->nama ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @php
                                $statusColors = [
                                    'selesai' => 'bg-emerald-100 text-emerald-700',
                                    'ditolak' => 'bg-rose-100 text-rose-700',
                                    'dibatalkan' => 'bg-slate-100 text-slate-700'
                                ];
                                $statusIcon = [
                                    'selesai' => 'fa-check-circle',
                                    'ditolak' => 'fa-xmark-circle',
                                    'dibatalkan' => 'fa-ban'
                                ];
                                $color = $statusColors[strtolower($item->status)] ?? 'bg-slate-100 text-slate-700';
                                $icon = $statusIcon[strtolower($item->status)] ?? 'fa-circle-info';
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold tracking-wide {{ $color }} uppercase">
                                <i class="fa-solid {{ $icon }}"></i> {{ $item->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center text-slate-500">
                            {{ $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d M Y') : '-' }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.permohonan-surat.preview', $item) }}?from=riwayat"
                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 hover:text-sky-700 transition-colors shadow-sm focus:outline-none active:scale-95 cursor-pointer"
                                title="Preview Surat">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-slate-400">
                            <i class="fa-solid fa-clock-rotate-left text-4xl mb-4 text-slate-300"></i>
                            <p class="text-sm font-medium">Belum ada riwayat pelayanan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($riwayats->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-white">
            {{ $riwayats->links() }}
        </div>
        @endif

    </div>
</div>

@endsection