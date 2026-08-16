@extends('layouts.admin')

@section('title', 'Galeri')

@section('content')
<div class="w-full">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Data Galeri</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola dokumentasi kegiatan Kelurahan Bongki.</p>
        </div>
        <a href="{{ route('admin.website.galeri.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none active:scale-95 cursor-pointer">
            <i class="fa-solid fa-circle-plus"></i> Tambah Galeri
        </a>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600 min-w-[700px]">
                <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/80">
                    <tr>
                        <th width="70" class="px-4 sm:px-6 py-4 border-b border-slate-100 text-center">No</th>
                        <th width="140" class="px-4 sm:px-6 py-4 border-b border-slate-100 text-center">Foto</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100">Informasi Dokumentasi</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100 text-center">Status</th>
                        <th class="px-4 sm:px-6 py-4 border-b border-slate-100">Dibuat Pada</th>
                        <th width="140" class="px-4 sm:px-6 py-4 border-b border-slate-100 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($galeris as $index => $galeri)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-6 py-4 text-center font-medium">{{ $galeris->firstItem() + $index }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($galeri->gambar)
                                <img src="{{ asset('storage/'.$galeri->gambar) }}" class="w-24 h-16 object-cover rounded-lg shadow-sm mx-auto" alt="Gambar">
                            @else
                                <div class="w-24 h-16 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400 mx-auto border border-slate-200">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-900 mb-1">{{ $galeri->judul }}</div>
                            <div class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                                {{ Str::limit($galeri->deskripsi, 100) ?: 'Tidak ada deskripsi' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($galeri->status == 'aktif')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 tracking-wide uppercase">Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700 tracking-wide uppercase">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-slate-700 font-medium">
                            {{ $galeri->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.website.galeri.show', $galeri->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 hover:text-sky-700 transition-colors focus:outline-none" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.website.galeri.edit', $galeri->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 hover:text-amber-700 transition-colors focus:outline-none" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.website.galeri.destroy', $galeri->id) }}" method="POST" class="inline mb-0" onsubmit="return confirm('Hapus dokumentasi ini?')">
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
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <i class="fa-solid fa-images text-4xl mb-4 text-slate-300"></i>
                                <p class="text-sm">Belum ada dokumentasi galeri.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($galeris->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-white">
            {{ $galeris->links() }}
        </div>
        @endif
    </div>
</div>
@endsection