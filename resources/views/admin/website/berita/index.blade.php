@extends('layouts.admin')

@section('title', 'Berita')

@section('content')
<div class="w-full">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Data Berita</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola informasi dan berita publik SIP Bongki.</p>
        </div>
        <a href="{{ route('admin.website.berita.create') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none">
            <i class="fa-solid fa-circle-plus"></i> Tambah Berita
        </a>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/80">
                    <tr>
                        <th width="70" class="px-6 py-4 border-b border-slate-100 text-center">No</th>
                        <th width="120" class="px-6 py-4 border-b border-slate-100 text-center">Gambar</th>
                        <th class="px-6 py-4 border-b border-slate-100">Judul Berita</th>
                        <th class="px-6 py-4 border-b border-slate-100 text-center">Status</th>
                        <th class="px-6 py-4 border-b border-slate-100">Tanggal Publish</th>
                        <th width="150" class="px-6 py-4 border-b border-slate-100 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($beritas as $index => $berita)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-6 py-4 text-center font-medium">{{ $beritas->firstItem() + $index }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($berita->gambar)
                                <img src="{{ asset('storage/'.$berita->gambar) }}" class="w-20 h-14 object-cover rounded-lg shadow-sm mx-auto" alt="Gambar">
                            @else
                                <div class="w-20 h-14 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400 mx-auto border border-slate-200">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-900 mb-1">{{ $berita->judul }}</div>
                            <div class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                                {{ Str::limit(strip_tags($berita->isi), 100) }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($berita->status === 'publish')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 tracking-wide uppercase">Publish</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700 tracking-wide uppercase">Draft</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-slate-700 font-medium">
                            {{ $berita->tanggal_publish ? $berita->tanggal_publish->format('d M Y') : '-' }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.website.berita.show', $berita) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 hover:text-sky-700 transition-colors focus:outline-none" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.website.berita.edit', $berita) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 hover:text-amber-700 transition-colors focus:outline-none" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.website.berita.destroy', $berita) }}" method="POST" class="inline mb-0" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
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
                                <i class="fa-solid fa-inbox text-4xl mb-4 text-slate-300"></i>
                                <p class="text-sm">Belum ada data berita.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($beritas->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-white">
            {{ $beritas->links() }}
        </div>
        @endif
    </div>
</div>
@endsection