@extends('layouts.admin')

@section('title', 'Pengaduan')

@section('content')

<div class="w-full">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Data Pengaduan</h2>
            <p class="text-sm text-slate-500 mt-1">Daftar seluruh pengaduan yang dikirim oleh masyarakat Kelurahan Bongki.</p>
        </div>
    </div>

 <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

 

 <div class="overflow-x-auto">

 <table class="w-full text-sm text-left text-slate-500">

 <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/50">

 <tr>

 <th width="50" class="px-6 py-4 border-b border-slate-100">No</th>

 <th class="px-6 py-4 border-b border-slate-100">Kode</th>

 <th class="px-6 py-4 border-b border-slate-100 text-center">Nama Pelapor</th>

 <th class="px-6 py-4 border-b border-slate-100">Kategori</th>

 <th class="px-6 py-4 border-b border-slate-100">Lokasi</th>

 <th class="px-6 py-4 border-b border-slate-100">Status</th>

 <th class="px-6 py-4 border-b border-slate-100">Catatan Petugas</th>

 <th class="px-6 py-4 border-b border-slate-100 text-center">Tanggal</th>

 <th width="100" class="px-6 py-4 border-b border-slate-100 text-center">
 Aksi
 </th>

 </tr>

 </thead>

 <tbody class="divide-y divide-slate-100">

 @forelse($pengaduans as $pengaduan)

 <tr class="hover:bg-slate-50/80 transition-colors">
 <td class="px-6 py-4 text-center font-medium">
 {{ $pengaduans->firstItem() + $loop->index }}
 </td>

 <td class="px-6 py-4">

 <span class="font-medium text-slate-900">
 {{ $pengaduan->kode }}
 </span>

 </td>

 <td class="px-6 py-4 text-center">

 <div>
 {{ $pengaduan->nama }}
 </div>

 <small class="text-slate-500">
 {{ $pengaduan->telepon }}
 </small>

 </td>

 <td class="px-6 py-4">

 <span class="font-medium text-slate-900">
 {{ $pengaduan->kategori }}
 </span>

 </td>

 <td class="px-6 py-4">

 {{ \Illuminate\Support\Str::limit($pengaduan->lokasi,40) }}

 </td>

 <td class="px-6 py-4">

 @if($pengaduan->status == 'Baru')

 <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 tracking-wide">Baru</span>

 @elseif($pengaduan->status == 'Diproses')

 <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-100 text-amber-700 tracking-wide">Diproses</span>

 @else

 <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 tracking-wide">Selesai</span>

 @endif

 </td>

 <td class="px-6 py-4">
 @if(!empty($pengaduan->catatan))
 <span class="text-slate-500 small">
 {{ 
 Illuminate\Support\Str::limit($pengaduan->catatan, 50)
 }}
 </span>
 @else
 <span class="text-slate-500 small">-</span>
 @endif
 </td>

 <td class="px-6 py-4 text-center">

 {{ $pengaduan->created_at->format('d M Y') }}

 <br>

 <small class="text-slate-500">
 {{ $pengaduan->created_at->format('H:i') }}
 </small>

 </td>

 <td class="px-6 py-4 text-center">
 <div class="flex items-center justify-center gap-2">
 <a href="{{ route('admin.pengaduan.show',$pengaduan) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 hover:text-sky-700 transition-colors focus:outline-none" title="Detail">
 <i class="fa-solid fa-eye"></i>
 </a>
 </div>
 </td> 
 

 </tr>

 @empty

 <tr>

 <td colspan="9" class="px-6 py-12 text-center">
 <div class="flex flex-col items-center justify-center text-slate-400">
 <i class="fa-solid fa-inbox text-4xl mb-4 text-slate-300"></i>
 <p class="text-sm">Belum ada data pengaduan yang masuk.</p>
 </div>
 </td>

 </tr>

 @endforelse

 </tbody>

 </table>

 </div>

 @if($pengaduans->hasPages())

 <div class="px-6 py-4 border-t border-slate-200 bg-white">

 {{ $pengaduans->links('pagination::tailwind') }}

 </div>

 @endif

 </div>

</div>

@endsection