@extends('layouts.admin')

@section('title', 'Riwayat')

@section('content')

<div class="w-full">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight dark:text-slate-100">Riwayat</h2>
            <p class="text-sm text-slate-500 mt-1 dark:text-slate-400">Semua riwayat pelayanan permohonan surat yang telah selesai atau ditolak.</p>
        </div>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
        <div class="p-4 sm:p-5 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between dark:border-slate-800 dark:bg-slate-800/50">
            <h5 class="text-sm font-bold text-slate-800 dark:text-slate-100">Daftar Riwayat</h5>
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-primary-50 text-primary-700 dark:bg-primary-950/60 dark:text-primary-300">
                {{ $riwayats->total() }} Data
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300 min-w-[750px]">
                <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/80 dark:bg-slate-800/80 dark:text-slate-400">
                    <tr>
                        <th width="70" class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 text-center">No</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">No. Permohonan</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">Pemohon</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">Jenis Surat</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 text-center">Status</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 text-center">Tanggal Selesai</th>
                        <th width="120" class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($riwayats as $item)
                    <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center text-slate-400 text-xs">{{ $riwayats->firstItem() + $loop->index }}</td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 font-mono font-medium text-slate-900 dark:text-slate-100 text-xs">{{ $item->nomor_permohonan }}</td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                            <span class="font-medium text-slate-900 dark:text-slate-100">{{ optional($item->penduduk)->nama_lengkap ?? data_get($item->data_surat, 'nama_lengkap') ?? '-' }}</span>
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-slate-700 dark:text-slate-300">
                            {{ $item->jenisSurat->nama ?? '-' }}
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">
                            @php
                                $statusColors = [
                                    'menunggu'   => 'bg-amber-100 text-amber-700 dark:bg-amber-950/60 dark:text-amber-300',
                                    'pending'    => 'bg-amber-100 text-amber-700 dark:bg-amber-950/60 dark:text-amber-300',
                                    'diproses'   => 'bg-sky-100 text-sky-700 dark:bg-sky-950/60 dark:text-sky-300',
                                    'selesai'    => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300',
                                    'ditolak'    => 'bg-rose-100 text-rose-700 dark:bg-rose-950/60 dark:text-rose-300',
                                    'dibatalkan' => 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300'
                                ];
                                $statusIcon = [
                                    'menunggu'   => 'fa-clock',
                                    'pending'    => 'fa-clock',
                                    'diproses'   => 'fa-spinner',
                                    'selesai'    => 'fa-check-circle',
                                    'ditolak'    => 'fa-xmark-circle',
                                    'dibatalkan' => 'fa-ban'
                                ];
                                $statusKey = strtolower($item->status);
                                $color = $statusColors[$statusKey] ?? 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300';
                                $icon = $statusIcon[$statusKey] ?? 'fa-circle-info';
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold tracking-wide {{ $color }} uppercase">
                                <i class="fa-solid {{ $icon }}"></i> {{ $item->status }}
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center text-slate-500 dark:text-slate-400">
                            {{ $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d M Y') : '-' }}
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">
                            <a href="{{ route('admin.permohonan-surat.preview', $item) }}?from=riwayat"
                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 hover:text-sky-700 transition-colors shadow-sm focus:outline-none active:scale-95 cursor-pointer dark:bg-sky-950/40 dark:text-sky-300 dark:hover:bg-sky-900/60"
                                title="Preview Surat">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 sm:px-6 py-12 text-center text-slate-400 dark:text-slate-500">
                            <i class="fa-solid fa-clock-rotate-left text-4xl mb-4 text-slate-300 dark:text-slate-600"></i>
                            <p class="text-sm font-medium">Belum ada riwayat pelayanan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($riwayats->hasPages())
        <div class="px-4 sm:px-6 py-4 border-t border-slate-100 bg-white dark:bg-slate-900 dark:border-slate-800">
            {{ $riwayats->links() }}
        </div>
        @endif

    </div>
</div>

@endsection