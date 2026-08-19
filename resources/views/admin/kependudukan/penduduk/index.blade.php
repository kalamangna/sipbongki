@extends('layouts.admin')

@section('title', 'Data Penduduk')

@section('content')
<div class="w-full">

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight dark:text-slate-100">Data Penduduk</h2>
            <p class="text-sm text-slate-500 mt-1 dark:text-slate-400">Kelola data kependudukan Kelurahan Bongki</p>
        </div>
        <a href="{{ route('admin.penduduk.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none cursor-pointer active:scale-95">
            <i class="fa-solid fa-circle-plus"></i> Tambah Penduduk
        </a>
    </div>

    {{-- STATISTIC CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-5 mb-6">
        {{-- Total Penduduk --}}
        <a href="{{ route('admin.penduduk.index', request()->except(['aktif', 'page'])) }}"
           class="bg-white rounded-2xl p-4 sm:p-5 ring-1 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] hover:shadow-md transition-all hover:-translate-y-0.5 cursor-pointer dark:bg-slate-900 {{ ($aktif === null || $aktif === '') ? 'ring-2 ring-primary-500 bg-primary-50/10 dark:ring-primary-500 dark:bg-primary-950/30' : 'ring-slate-200/60 dark:ring-slate-800' }}">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-primary-50 text-primary-600 flex items-center justify-center text-xl shrink-0 dark:bg-primary-950/60 dark:text-primary-400">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-0.5 truncate dark:text-slate-400">Total Penduduk</p>
                    <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight dark:text-slate-100">{{ number_format($totalSemua) }}</p>
                </div>
            </div>
        </a>

        {{-- Penduduk Aktif --}}
        <a href="{{ route('admin.penduduk.index', array_merge(request()->except(['page']), ['aktif' => '1'])) }}"
           class="bg-white rounded-2xl p-4 sm:p-5 ring-1 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] hover:shadow-md transition-all hover:-translate-y-0.5 cursor-pointer dark:bg-slate-900 {{ $aktif === '1' ? 'ring-2 ring-emerald-500 bg-emerald-50/10 dark:ring-emerald-500 dark:bg-emerald-950/30' : 'ring-slate-200/60 dark:ring-slate-800' }}">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shrink-0 dark:bg-emerald-950/60 dark:text-emerald-400">
                    <i class="fa-solid fa-user-check"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-0.5 truncate dark:text-slate-400">Penduduk Aktif</p>
                    <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight dark:text-slate-100">{{ number_format($totalAktif) }}</p>
                </div>
            </div>
        </a>

        {{-- Penduduk Tidak Aktif --}}
        <a href="{{ route('admin.penduduk.index', array_merge(request()->except(['page']), ['aktif' => '0'])) }}"
           class="bg-white rounded-2xl p-4 sm:p-5 ring-1 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] hover:shadow-md transition-all hover:-translate-y-0.5 cursor-pointer dark:bg-slate-900 {{ $aktif === '0' ? 'ring-2 ring-rose-500 bg-rose-50/10 dark:ring-rose-500 dark:bg-rose-950/30' : 'ring-slate-200/60 dark:ring-slate-800' }}">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl shrink-0 dark:bg-rose-950/60 dark:text-rose-400">
                    <i class="fa-solid fa-user-xmark"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-0.5 truncate dark:text-slate-400">Tidak Aktif</p>
                    <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight dark:text-slate-100">{{ number_format($totalTidakAktif) }}</p>
                </div>
            </div>
        </a>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
        
        {{-- Filters --}}
        <div class="p-4 sm:p-5 border-b border-slate-100 bg-slate-50/50 dark:bg-slate-800/50 dark:border-slate-800">
            <form method="GET" class="flex flex-col md:flex-row gap-3">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ $search }}" class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-2.5 shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" placeholder="Cari NIK atau Nama Penduduk...">
                </div>
                
                <div class="w-full md:w-48">
                    <select name="lingkungan" class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-2.5 shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                        <option value="">Semua Lingkungan</option>
                        @foreach($lingkungans as $item)
                            <option value="{{ $item->id }}" {{ $lingkungan == $item->id ? 'selected':'' }}>{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full md:w-40">
                    <select name="aktif" class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-2.5 shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                        <option value="">Semua Status</option>
                        <option value="1" {{ $aktif === '1' ? 'selected':'' }}>Aktif</option>
                        <option value="0" {{ $aktif === '0' ? 'selected':'' }}>Tidak Aktif</option>
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit" class="flex-1 md:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl bg-slate-800 text-white hover:bg-slate-700 shadow-sm transition-all focus:outline-none focus:ring-2 focus:ring-slate-500 active:scale-95 cursor-pointer dark:bg-primary-600 dark:hover:bg-primary-700">
                        <i class="fa-solid fa-magnifying-glass"></i> Cari
                    </button>
                    @if($search || $lingkungan || $aktif !== null)
                        <a href="{{ route('admin.penduduk.index') }}" class="flex-1 md:flex-none inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all focus:outline-none active:scale-95 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white" title="Reset Filter">
                            <i class="fa-solid fa-rotate-left mr-1.5"></i> Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600 min-w-[700px] dark:text-slate-300">
                <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/50 dark:bg-slate-800/80 dark:text-slate-400">
                    <tr>
                        <th width="50" class="px-4 sm:px-6 py-4 border-b border-slate-100 text-center dark:border-slate-800">No</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">
                            <a href="{{ request()->fullUrlWithQuery(['sort'=>'nik', 'direction'=>$direction=='asc'?'desc':'asc']) }}" class="flex items-center gap-1 group text-slate-600 hover:text-primary-600 transition-colors dark:text-slate-400 dark:hover:text-primary-400">
                                NIK <i class="fa-solid fa-sort text-[10px] text-slate-400 group-hover:text-primary-500 transition-colors"></i>
                            </a>
                        </th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">
                            <a href="{{ request()->fullUrlWithQuery(['sort'=>'nama_lengkap', 'direction'=>$direction=='asc'?'desc':'asc']) }}" class="flex items-center gap-1 group text-slate-600 hover:text-primary-600 transition-colors dark:text-slate-400 dark:hover:text-primary-400">
                                Nama <i class="fa-solid fa-sort text-[10px] text-slate-400 group-hover:text-primary-500 transition-colors"></i>
                            </a>
                        </th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">Lingkungan</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">Status</th>
                        <th width="120" class="px-4 sm:px-6 py-4 border-b border-slate-100 text-center dark:border-slate-800">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($penduduks as $penduduk)
                    <tr class="hover:bg-slate-50/80 transition-colors dark:hover:bg-slate-800/50">
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center font-medium">{{ $penduduks->firstItem() + $loop->index }}</td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 font-mono text-xs">{{ $penduduk->nik }}</td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 font-medium text-slate-900 dark:text-slate-100">{{ $penduduk->nama_lengkap }}</td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4">{{ $penduduk->lingkungan->nama ?? '-' }}</td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                            @if($penduduk->aktif)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 tracking-wide dark:bg-emerald-950/60 dark:text-emerald-300">Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 tracking-wide dark:bg-rose-950/60 dark:text-rose-300">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.penduduk.show', $penduduk) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 hover:text-sky-700 transition-colors focus:outline-none active:scale-95 dark:bg-sky-950/60 dark:text-sky-300 dark:hover:bg-sky-900/50" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                @if(in_array(auth()->user()->role, ['admin', 'operator']))
                                <a href="{{ route('admin.penduduk.edit', $penduduk) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 hover:text-amber-700 transition-colors focus:outline-none active:scale-95 dark:bg-amber-950/60 dark:text-amber-300 dark:hover:bg-amber-900/50" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 sm:px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400 dark:text-slate-500">
                                <i class="fa-solid fa-users text-4xl mb-4 text-slate-300 dark:text-slate-600"></i>
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
        <div class="px-4 sm:px-6 py-4 border-t border-slate-100 bg-white dark:border-slate-800 dark:bg-slate-900">
            {{ $penduduks->links() }}
        </div>
        @endif

    </div>
</div>
@endsection
