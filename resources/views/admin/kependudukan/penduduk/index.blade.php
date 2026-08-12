@extends('layouts.admin')

@section('title', 'Penduduk')

@section('content')
<div class="w-full">

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Data Penduduk</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola data kependudukan Kelurahan Bongki</p>
        </div>
        <a href="{{ route('admin.penduduk.create') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none">
            <i class="fa-solid fa-circle-plus"></i> Tambah Penduduk
        </a>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        
        {{-- Filters --}}
        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
            <form method="GET" class="flex flex-col md:flex-row gap-3">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ $search }}" class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-2.5 shadow-sm" placeholder="Cari Nama / NIK...">
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
                    <select name="jenis_kelamin" class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-2.5 shadow-sm">
                        <option value="">Semua JK</option>
                        <option value="L" {{ $jenis_kelamin == 'L' ? 'selected':'' }}>Laki-laki</option>
                        <option value="P" {{ $jenis_kelamin == 'P' ? 'selected':'' }}>Perempuan</option>
                    </select>
                </div>

                <div class="w-full md:w-40">
                    <select name="agama" class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-2.5 shadow-sm">
                        <option value="">Semua Agama</option>
                        @foreach($agamas as $item)
                            <option value="{{ $item }}" {{ $agama == $item ? 'selected':'' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl bg-slate-800 text-white hover:bg-slate-700 shadow-sm transition-all w-full md:w-auto focus:outline-none focus:ring-2 focus:ring-slate-500">
                        <i class="fa-solid fa-magnifying-glass"></i> Cari
                    </button>
                    @if($search || $lingkungan || $jenis_kelamin || $agama)
                        <a href="{{ route('admin.penduduk.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all focus:outline-none" title="Reset Filter">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/50">
                    <tr>
                        <th width="50" class="px-6 py-4 border-b border-slate-100 text-center">No</th>
                        <th class="px-6 py-4 border-b border-slate-100">
                            <a href="{{ request()->fullUrlWithQuery(['sort'=>'nik', 'direction'=>$direction=='asc'?'desc':'asc']) }}" class="flex items-center gap-1 group text-slate-600 hover:text-primary-600 transition-colors">
                                NIK <i class="fa-solid fa-sort text-[10px] text-slate-400 group-hover:text-primary-500 transition-colors"></i>
                            </a>
                        </th>
                        <th class="px-6 py-4 border-b border-slate-100">
                            <a href="{{ request()->fullUrlWithQuery(['sort'=>'nama_lengkap', 'direction'=>$direction=='asc'?'desc':'asc']) }}" class="flex items-center gap-1 group text-slate-600 hover:text-primary-600 transition-colors">
                                Nama <i class="fa-solid fa-sort text-[10px] text-slate-400 group-hover:text-primary-500 transition-colors"></i>
                            </a>
                        </th>
                        <th class="px-6 py-4 border-b border-slate-100">JK</th>
                        <th class="px-6 py-4 border-b border-slate-100">Lingkungan</th>
                        <th class="px-6 py-4 border-b border-slate-100">Agama</th>
                        <th class="px-6 py-4 border-b border-slate-100">Status</th>
                        <th width="100" class="px-6 py-4 border-b border-slate-100 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($penduduks as $penduduk)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-6 py-4 text-center font-medium">{{ $penduduks->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-4 font-mono text-xs">{{ $penduduk->nik }}</td>
                        <td class="px-6 py-4 font-medium text-slate-900">{{ $penduduk->nama_lengkap }}</td>
                        <td class="px-6 py-4">@gender($penduduk->jenis_kelamin)</td>
                        <td class="px-6 py-4">{{ $penduduk->lingkungan->nama ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $penduduk->agama ?? '-' }}</td>
                        <td class="px-6 py-4">
                            @if($penduduk->aktif)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 tracking-wide">Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 tracking-wide">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.penduduk.show', $penduduk) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 hover:text-sky-700 transition-colors focus:outline-none" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.penduduk.edit', $penduduk) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 hover:text-amber-700 transition-colors focus:outline-none" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.penduduk.destroy', $penduduk) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data penduduk ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 hover:text-rose-700 transition-colors focus:outline-none" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center">
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
        <div class="px-6 py-4 border-t border-slate-100 bg-white">
            {{ $penduduks->links() }}
        </div>
        @endif

    </div>
</div>
@endsection
