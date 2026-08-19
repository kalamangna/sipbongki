@extends('layouts.admin')

@section('title', 'Pengaduan')

@section('content')

<div class="w-full">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight dark:text-slate-100">Data Pengaduan</h2>
            <p class="text-sm text-slate-500 mt-1 dark:text-slate-400">Daftar seluruh pengaduan yang dikirim oleh masyarakat Kelurahan Bongki.</p>
        </div>
    </div>

 <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">

    {{-- Toolbar Filter & Pencarian --}}
    <div class="p-4 sm:p-5 border-b border-slate-100 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
        <form action="{{ route('admin.pengaduan.index') }}" method="GET" class="flex flex-col md:flex-row gap-3">
            
            {{-- Pencarian --}}
            <div class="flex-1 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Kode, Nama Pelapor, atau Uraian..." class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary pl-10 pr-4 py-2.5 shadow-sm transition-all dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
            </div>

            {{-- Filter Kategori --}}
            <div class="w-full md:w-48">
                <select name="kategori" class="w-full bg-white border border-slate-200 text-slate-700 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-2.5 shadow-sm transition-all cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat }}" @selected(request('kategori') == $kat)>{{ $kat }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Filter Status --}}
            <div class="w-full md:w-40">
                <select name="status" class="w-full bg-white border border-slate-200 text-slate-700 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-2.5 shadow-sm transition-all cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                    <option value="">Semua Status</option>
                    <option value="Baru" @selected(request('status') == 'Baru')>Baru</option>
                    <option value="Diproses" @selected(request('status') == 'Diproses')>Diproses</option>
                    <option value="Selesai" @selected(request('status') == 'Selesai')>Selesai</option>
                </select>
            </div>
            
            <div class="flex items-center gap-2">
                <button type="submit" class="flex-1 md:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl bg-slate-800 text-white hover:bg-slate-700 shadow-sm transition-all focus:outline-none active:scale-95 cursor-pointer dark:bg-primary-600 dark:hover:bg-primary-700">
                    <i class="fa-solid fa-magnifying-glass"></i> Cari
                </button>
                @if(request('search') || request('kategori') || request('status'))
                    <a href="{{ route('admin.pengaduan.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all focus:outline-none cursor-pointer active:scale-95 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white" title="Reset Filter">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-slate-500 dark:text-slate-400 min-w-[850px]">
            <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/50 dark:bg-slate-800/80 dark:text-slate-400">
                <tr>
                    <th width="50" class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 text-center">No</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">Kode</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">Nama Pelapor</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">Kategori</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">Lokasi</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 text-center">Status</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800">Catatan Petugas</th>
                    <th class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 text-center">Tanggal</th>
                    <th width="100" class="px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-slate-800 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($pengaduans as $pengaduan)
                <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition-colors">
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center font-medium">
                        {{ $pengaduans->firstItem() + $loop->index }}
                    </td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                        <span class="font-mono font-medium text-slate-900 dark:text-slate-100">{{ $pengaduan->kode }}</span>
                    </td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                        <div class="font-medium text-slate-900 dark:text-slate-100">{{ $pengaduan->nama }}</div>
                        <small class="text-slate-500 dark:text-slate-400">{{ $pengaduan->telepon }}</small>
                    </td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                        <span class="font-medium text-slate-800 dark:text-slate-200">{{ $pengaduan->kategori }}</span>
                    </td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 dark:text-slate-300">
                        {{ \Illuminate\Support\Str::limit($pengaduan->lokasi, 40) }}
                    </td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">
                        @if($pengaduan->status == 'Baru')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 dark:bg-rose-950/60 dark:text-rose-300 tracking-wide">Baru</span>
                        @elseif($pengaduan->status == 'Diproses')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-100 text-amber-700 dark:bg-amber-950/60 dark:text-amber-300 tracking-wide">Diproses</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 tracking-wide">Selesai</span>
                        @endif
                    </td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                        @if(!empty($pengaduan->catatan))
                            <span class="text-slate-500 dark:text-slate-400 text-xs">{{ Illuminate\Support\Str::limit($pengaduan->catatan, 50) }}</span>
                        @else
                            <span class="text-slate-400 dark:text-slate-600 text-xs">-</span>
                        @endif
                    </td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center whitespace-nowrap">
                        <span class="text-slate-800 dark:text-slate-200">{{ $pengaduan->created_at->format('d M Y') }}</span>
                        <br>
                        <small class="text-slate-400 dark:text-slate-500">{{ $pengaduan->created_at->format('H:i') }} WITA</small>
                    </td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.pengaduan.show', $pengaduan) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 hover:text-sky-700 dark:bg-sky-950/40 dark:text-sky-300 dark:hover:bg-sky-900/60 transition-colors focus:outline-none active:scale-95 cursor-pointer" title="Detail">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </div>
                    </td> 
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-4 sm:px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-slate-400 dark:text-slate-500">
                            <i class="fa-solid fa-inbox text-4xl mb-4 text-slate-300 dark:text-slate-600"></i>
                            <p class="text-sm font-medium">Belum ada data pengaduan yang masuk.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($pengaduans->hasPages())
    <div class="px-4 sm:px-6 py-4 border-t border-slate-100 bg-white dark:bg-slate-900 dark:border-slate-800">
        {{ $pengaduans->links('pagination::tailwind') }}
    </div>
    @endif

 </div>

</div>

@endsection