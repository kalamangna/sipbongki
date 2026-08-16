@extends('layouts.admin')

@section('title', 'Data Penduduk')

@section('content')
<div class="w-full">

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Data Penduduk</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola data kependudukan Kelurahan Bongki</p>
        </div>
        <a href="{{ route('admin.penduduk.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none cursor-pointer active:scale-95">
            <i class="fa-solid fa-circle-plus"></i> Tambah Penduduk
        </a>
    </div>

    {{-- STATISTIC CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-5 mb-6">
        {{-- Total Penduduk --}}
        <a href="{{ route('admin.penduduk.index', request()->except(['aktif', 'page'])) }}"
           class="bg-white rounded-2xl p-4 sm:p-5 ring-1 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] hover:shadow-md transition-all hover:-translate-y-0.5 cursor-pointer {{ ($aktif === null || $aktif === '') ? 'ring-2 ring-primary-500 bg-primary-50/10' : 'ring-slate-200/60' }}">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-primary-50 text-primary-600 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-0.5 truncate">Total Penduduk</p>
                    <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">{{ number_format($totalSemua) }}</p>
                </div>
            </div>
        </a>

        {{-- Penduduk Aktif --}}
        <a href="{{ route('admin.penduduk.index', array_merge(request()->except(['page']), ['aktif' => '1'])) }}"
           class="bg-white rounded-2xl p-4 sm:p-5 ring-1 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] hover:shadow-md transition-all hover:-translate-y-0.5 cursor-pointer {{ $aktif === '1' ? 'ring-2 ring-emerald-500 bg-emerald-50/10' : 'ring-slate-200/60' }}">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-user-check"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-0.5 truncate">Penduduk Aktif</p>
                    <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">{{ number_format($totalAktif) }}</p>
                </div>
            </div>
        </a>

        {{-- Penduduk Tidak Aktif --}}
        <a href="{{ route('admin.penduduk.index', array_merge(request()->except(['page']), ['aktif' => '0'])) }}"
           class="bg-white rounded-2xl p-4 sm:p-5 ring-1 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] hover:shadow-md transition-all hover:-translate-y-0.5 cursor-pointer {{ $aktif === '0' ? 'ring-2 ring-rose-500 bg-rose-50/10' : 'ring-slate-200/60' }}">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-user-xmark"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-0.5 truncate">Tidak Aktif</p>
                    <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">{{ number_format($totalTidakAktif) }}</p>
                </div>
            </div>
        </a>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        
        {{-- Filters --}}
        <div class="p-4 sm:p-5 border-b border-slate-100 bg-slate-50/50">
            <form method="GET" class="flex flex-col md:flex-row gap-3">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ $search }}" class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-2.5 shadow-sm" placeholder="Cari NIK atau Nama Penduduk...">
                </div>
                
                <div class="w-full md:w-48">
                    <select name="lingkungan" class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-2.5 shadow-sm">
                        <option value="">Semua Lingkungan</option>
                        @foreach($lingkungans as $item)
                            <option value="{{ $item->id }}" {{ $lingkungan == $item->id ? 'selected':'' }}>{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full md:w-40">
                    <select name="aktif" class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-2.5 shadow-sm">
                        <option value="">Semua Status</option>
                        <option value="1" {{ $aktif === '1' ? 'selected':'' }}>Aktif</option>
                        <option value="0" {{ $aktif === '0' ? 'selected':'' }}>Tidak Aktif</option>
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit" class="flex-1 md:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl bg-slate-800 text-white hover:bg-slate-700 shadow-sm transition-all focus:outline-none focus:ring-2 focus:ring-slate-500 active:scale-95 cursor-pointer">
                        <i class="fa-solid fa-magnifying-glass"></i> Cari
                    </button>
                    @if($search || $lingkungan || $aktif !== null)
                        <a href="{{ route('admin.penduduk.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all focus:outline-none active:scale-95" title="Reset Filter">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600 min-w-[700px]">
                <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/50">
                    <tr>
                        <th width="50" class="px-4 sm:px-6 py-4 border-b border-slate-100 text-center">No</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100">
                            <a href="{{ request()->fullUrlWithQuery(['sort'=>'nik', 'direction'=>$direction=='asc'?'desc':'asc']) }}" class="flex items-center gap-1 group text-slate-600 hover:text-primary-600 transition-colors">
                                NIK <i class="fa-solid fa-sort text-[10px] text-slate-400 group-hover:text-primary-500 transition-colors"></i>
                            </a>
                        </th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100">
                            <a href="{{ request()->fullUrlWithQuery(['sort'=>'nama_lengkap', 'direction'=>$direction=='asc'?'desc':'asc']) }}" class="flex items-center gap-1 group text-slate-600 hover:text-primary-600 transition-colors">
                                Nama <i class="fa-solid fa-sort text-[10px] text-slate-400 group-hover:text-primary-500 transition-colors"></i>
                            </a>
                        </th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100">Lingkungan</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100">Status</th>
                        <th width="100" class="px-4 sm:px-6 py-4 border-b border-slate-100 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($penduduks as $penduduk)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center font-medium">{{ $penduduks->firstItem() + $loop->index }}</td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 font-mono text-xs">{{ $penduduk->nik }}</td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 font-medium text-slate-900">{{ $penduduk->nama_lengkap }}</td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4">{{ $penduduk->lingkungan->nama ?? '-' }}</td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                            @if($penduduk->aktif)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 tracking-wide">Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 tracking-wide">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.penduduk.show', $penduduk) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 hover:text-sky-700 transition-colors focus:outline-none active:scale-95" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 sm:px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <i class="fa-solid fa-users text-4xl mb-4 text-slate-300"></i>
                                <p class="text-sm">Belum ada data penduduk yang sesuai.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($penduduks->hasPages())
        <div class="px-4 sm:px-6 py-4 border-t border-slate-100 bg-white">
            {{ $penduduks->links() }}
        </div>
        @endif

    </div>
</div>
@endsection
