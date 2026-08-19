@extends('layouts.admin')

@section('title', 'Detail Pengaduan')

@section('content')
<div class="w-full">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight dark:text-slate-100">Detail Pengaduan</h2>
            <p class="text-sm text-slate-500 mt-1 dark:text-slate-400">Informasi lengkap laporan masyarakat.</p>
        </div>
        <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
            <a href="{{ route('admin.pengaduan.index') }}" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none active:scale-95 cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white">
                <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
            </a>
            <form action="{{ route('admin.pengaduan.destroy', $pengaduan) }}" method="POST" class="w-full sm:w-auto inline m-0" onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm focus:outline-none hover:-translate-y-0.5 active:scale-95 cursor-pointer">
                    <i class="fa-solid fa-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Kiri (Col-2) --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Informasi Pengaduan --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
                    <h3 class="font-bold text-slate-800 text-sm dark:text-slate-100">Informasi Pengaduan</h3>
                </div>
                <div class="p-0">
                    <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300">
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <th width="200" class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30 dark:text-slate-300 dark:bg-slate-800/60">Kode Pengaduan</th>
                                <td class="px-6 py-4 font-mono font-medium text-slate-900 dark:text-slate-100">{{ $pengaduan->kode }}</td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <th width="200" class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30 dark:text-slate-300 dark:bg-slate-800/60">Nama Pelapor</th>
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-slate-100">{{ $pengaduan->nama }}</td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <th width="200" class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30 dark:text-slate-300 dark:bg-slate-800/60">NIK Pelapor</th>
                                <td class="px-6 py-4">{{ $pengaduan->nik_pelapor ?? '-' }}</td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <th width="200" class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30 dark:text-slate-300 dark:bg-slate-800/60">No. WhatsApp</th>
                                <td class="px-6 py-4 font-mono">{{ $pengaduan->telepon }}</td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <th width="200" class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30 dark:text-slate-300 dark:bg-slate-800/60">Alamat</th>
                                <td class="px-6 py-4">{{ $pengaduan->alamat }}</td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <th width="200" class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30 dark:text-slate-300 dark:bg-slate-800/60">Catatan Petugas</th>
                                <td class="px-6 py-4">{{ $pengaduan->catatan ?? '-' }}</td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <th width="200" class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30 dark:text-slate-300 dark:bg-slate-800/60">Kategori</th>
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-slate-100">{{ $pengaduan->kategori }}</td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <th width="200" class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30 dark:text-slate-300 dark:bg-slate-800/60">Lokasi Kejadian</th>
                                <td class="px-6 py-4">{{ $pengaduan->lokasi }}</td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <th width="200" class="px-6 py-4 font-semibold text-slate-700 bg-slate-50/30 dark:text-slate-300 dark:bg-slate-800/60">Tanggal Laporan</th>
                                <td class="px-6 py-4">
                                    {{ $pengaduan->created_at->timezone('Asia/Makassar')->format('d F Y H:i') }} WITA
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Uraian --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
                    <h3 class="font-bold text-slate-800 text-sm dark:text-slate-100">Uraian Pengaduan</h3>
                </div>
                <div class="p-6 text-slate-700 leading-relaxed text-sm dark:text-slate-300">
                    {!! nl2br(e($pengaduan->uraian)) !!}
                </div>
            </div>

        </div>

        {{-- Kanan (Col-1) --}}
        <div class="lg:col-span-1 space-y-6">
            
            {{-- Status & Penanganan --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
                    <h3 class="font-bold text-slate-800 text-sm dark:text-slate-100">Penanganan</h3>
                </div>
                
                <div class="p-6 space-y-6">
                    
                    {{-- Status Badge --}}
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4 dark:border-slate-800">
                        <span class="text-sm font-semibold text-slate-600 dark:text-slate-400">Status Saat Ini</span>
                        @if($pengaduan->status == 'Baru')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 dark:bg-rose-950/60 dark:text-rose-300 tracking-wide uppercase">Baru</span>
                        @elseif($pengaduan->status == 'Diproses')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-100 text-amber-700 dark:bg-amber-950/60 dark:text-amber-300 tracking-wide uppercase">Diproses</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 tracking-wide uppercase">Selesai</span>
                        @endif
                    </div>

                    {{-- Quick Actions --}}
                    @if($pengaduan->status == 'Baru' || $pengaduan->status == 'Diproses')
                    <div class="space-y-3">
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 dark:text-slate-400">Aksi Cepat</label>
                        
                        @if($pengaduan->status == 'Baru')
                            <form action="{{ route('admin.pengaduan.update', $pengaduan) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="Diproses">
                                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-amber-500 text-white hover:bg-amber-600 shadow-sm transition-all focus:outline-none cursor-pointer" onclick="return confirm('Proses pengaduan ini?')">
                                    <i class="fa-solid fa-play-circle"></i> Proses Pengaduan
                                </button>
                            </form>
                        @endif
                        
                        <form action="{{ route('admin.pengaduan.update', $pengaduan) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="Selesai">
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm transition-all focus:outline-none cursor-pointer" onclick="return confirm('Tandai pengaduan ini sebagai selesai?')">
                                <i class="fa-solid fa-circle-check"></i> Selesaikan Pengaduan
                            </button>
                        </form>
                    </div>
                    @endif

                    <div class="space-y-3 pt-2">
                        <a href="{{ route('admin.pengaduan.edit', $pengaduan) }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 shadow-sm transition-all focus:outline-none cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700">
                            <i class="fa-solid fa-pen-to-square text-slate-400"></i> Edit Manual
                        </a>
                    </div>
                    
                    {{-- Form Catatan Petugas (Manual Update) --}}
                    <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                        <form action="{{ route('admin.pengaduan.update', $pengaduan) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            
                            <div class="hidden">
                                <select name="status">
                                    <option value="{{ $pengaduan->status }}" selected>{{ $pengaduan->status }}</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 dark:text-slate-400">Perbarui Catatan Petugas</label>
                                <textarea name="catatan" rows="4" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" placeholder="Tambahkan catatan untuk pelapor...">{{ old('catatan', $pengaduan->catatan) }}</textarea>
                            </div>
                            
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all focus:outline-none cursor-pointer">
                                <i class="fa-solid fa-save"></i> Simpan Catatan
                            </button>
                        </form>
                    </div>

                </div>
            </div>

            {{-- Foto --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
                    <h3 class="font-bold text-slate-800 text-sm dark:text-slate-100">Foto Bukti</h3>
                </div>
                <div class="p-6 flex justify-center bg-slate-50/30 dark:bg-slate-900/50">
                    @if($pengaduan->foto)
                        <a href="{{ asset('storage/'.$pengaduan->foto) }}" target="_blank" class="block w-full">
                            <img src="{{ asset('storage/'.$pengaduan->foto) }}" class="rounded-xl shadow-sm w-full h-auto object-cover hover:opacity-90 transition-opacity border border-slate-200 dark:border-slate-700" alt="Foto Bukti">
                        </a>
                    @else
                        <div class="flex flex-col items-center justify-center py-8 text-slate-400 dark:text-slate-500">
                            <i class="fa-solid fa-image text-4xl mb-3 text-slate-200 dark:text-slate-700"></i>
                            <span class="text-sm">Tidak ada foto bukti.</span>
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </div>

</div>
@endsection