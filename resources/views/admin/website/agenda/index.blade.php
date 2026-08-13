@extends('layouts.admin')

@section('title', 'Agenda')

@section('content')
<div class="w-full">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Data Agenda</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola jadwal kegiatan Kelurahan Bongki.</p>
        </div>
        <a href="{{ route('admin.website.agenda.create') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none">
            <i class="fa-solid fa-circle-plus"></i> Tambah Agenda
        </a>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/80">
                    <tr>
                        <th width="70" class="px-6 py-4 border-b border-slate-100 text-center">No</th>
                        <th class="px-6 py-4 border-b border-slate-100">Kegiatan</th>
                        <th width="150" class="px-6 py-4 border-b border-slate-100">Waktu & Tempat</th>
                        <th width="120" class="px-6 py-4 border-b border-slate-100 text-center">Status</th>
                        <th width="150" class="px-6 py-4 border-b border-slate-100 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($agendas as $index => $agenda)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-6 py-4 text-center font-medium">{{ $agendas->firstItem() + $index }}</td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-900 mb-1">{{ $agenda->judul }}</div>
                            <div class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                                {{ Str::limit($agenda->deskripsi, 100) }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-slate-700 mb-1">
                                <i class="fa-solid fa-calendar-day text-slate-400"></i>
                                <span class="font-medium">{{ $agenda->tanggal ? $agenda->tanggal->format('d M Y') : '-' }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-slate-500 text-xs mb-1">
                                <i class="fa-solid fa-clock text-slate-400"></i>
                                <span>{{ $agenda->waktu ?? '-' }} WITA</span>
                            </div>
                            <div class="flex items-center gap-2 text-slate-500 text-xs">
                                <i class="fa-solid fa-location-dot text-slate-400"></i>
                                <span class="truncate max-w-[120px]" title="{{ $agenda->lokasi }}">{{ $agenda->lokasi ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($agenda->status == 'aktif')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 tracking-wide uppercase">Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700 tracking-wide uppercase">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.website.agenda.show', $agenda->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 hover:text-sky-700 transition-colors focus:outline-none" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.website.agenda.edit', $agenda->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 hover:text-amber-700 transition-colors focus:outline-none" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.website.agenda.destroy', $agenda->id) }}" method="POST" class="inline mb-0" onsubmit="return confirm('Hapus agenda ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 hover:text-rose-700 transition-colors focus:outline-none" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <i class="fa-solid fa-inbox text-4xl mb-4 text-slate-300"></i>
                                <p class="text-sm">Belum ada data agenda.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($agendas->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-white">
            {{ $agendas->links() }}
        </div>
        @endif
    </div>
</div>
@endsection