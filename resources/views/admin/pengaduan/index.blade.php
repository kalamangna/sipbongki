@extends('layouts.admin')

@section('title', 'Pengaduan')

@section('content')

<div class="w-full">

 <div class="flex justify-between items-center mb-6">

 <div>

 
 <p class="text-slate-500 mb-0">
 Daftar seluruh pengaduan yang dikirim oleh masyarakat Kelurahan Bongki.
 </p>

 </div>

 </div>

 <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

 <div class="p-0">

 <div class="overflow-x-auto w-full">

 <table class="w-full text-sm text-left text-slate-500">

 <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-200">

 <tr>

 <th width="60" class="px-4 py-3 font-medium text-slate-700">No</th>

 <th class="px-4 py-3 font-medium text-slate-700">Kode</th>

 <th class="text-center px-4 py-3 font-medium text-slate-700">Nama Pelapor</th>

 <th class="px-4 py-3 font-medium text-slate-700">Kategori</th>

 <th class="px-4 py-3 font-medium text-slate-700">Lokasi</th>

 <th class="px-4 py-3 font-medium text-slate-700">Status</th>

 <th class="px-4 py-3 font-medium text-slate-700">Catatan Petugas</th>

 <th class="text-center px-4 py-3 font-medium text-slate-700">Tanggal</th>

 <th width="120" class="text-center px-4 py-3 font-medium text-slate-700">
 Aksi
 </th>

 </tr>

 </thead>

 <tbody>

 @forelse($pengaduans as $pengaduan)

 <tr>

 <td class="px-4 py-3 border-b border-slate-100">
 {{ $pengaduans->firstItem() + $loop->index }}
 </td>

 <td class="px-4 py-3 border-b border-slate-100">

 <span class="font-medium text-slate-900">
 {{ $pengaduan->kode }}
 </span>

 </td>

 <td class="text-center px-4 py-3 border-b border-slate-100">

 <div>
 {{ $pengaduan->nama }}
 </div>

 <small class="text-slate-500">
 {{ $pengaduan->telepon }}
 </small>

 </td>

 <td class="px-4 py-3 border-b border-slate-100">

 <span class="font-medium text-slate-900">
 {{ $pengaduan->kategori }}
 </span>

 </td>

 <td class="px-4 py-3 border-b border-slate-100">

 {{ \Illuminate\Support\Str::limit($pengaduan->lokasi,40) }}

 </td>

 <td class="px-4 py-3 border-b border-slate-100">

 @if($pengaduan->status == 'Baru')

 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">
 Baru
 </span>

 @elseif($pengaduan->status == 'Diproses')

 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">
 Diproses
 </span>

 @else

 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
 Selesai
 </span>

 @endif

 </td>

 <td class="px-4 py-3 border-b border-slate-100">
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

 <td class="text-center px-4 py-3 border-b border-slate-100">

 {{ $pengaduan->created_at->format('d M Y') }}

 <br>

 <small class="text-slate-500">
 {{ $pengaduan->created_at->format('H:i') }}
 </small>

 </td>

 <td class="text-center px-4 py-3 border-b border-slate-100">

 <div class="flex justify-center gap-2">

 <a
 href="{{ route('admin.pengaduan.show',$pengaduan) }}"
 class="inline-flex items-center justify-center gap-2 px-3 py-1.5 text-xs font-semibold rounded-xl transition-all bg-sky-600 text-white hover:bg-sky-700 shadow-sm active:scale-95"
 title="Detail">

 <i class="fa-solid fa-eye"></i>

 </a>

 {{-- Edit action removed per request --}}

 <form
 action="{{ route('admin.pengaduan.destroy',$pengaduan) }}"
 method="POST"
 class="inline mb-0"
 onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">

 @csrf
 @method('DELETE')

 <button
 type="submit"
 class="inline-flex items-center justify-center gap-2 px-3 py-1.5 text-xs font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm active:scale-95"
 title="Hapus">

 <i class="fa-solid fa-trash"></i>

 </button>

 </form>

 </div>

</td> 
 

 </tr>

 @empty

 <tr>

 <td colspan="9" class="text-center py-8 px-4 border-b border-slate-100">

 <i class="fa-solid fa-inbox text-5xl text-slate-300 mb-4 block"></i>

 <h5 class="text-lg font-bold text-slate-700 mb-2">
 Belum Ada Pengaduan
 </h5>

 <p class="text-slate-500 mb-0">
 Pengaduan dari masyarakat akan tampil di sini.
 </p>

 </td>

 </tr>

 @endforelse

 </tbody>

 </table>

 </div>

 </div>

 @if($pengaduans->hasPages())

 <div class="px-6 py-4 border-t border-slate-200 bg-white">

 {{ $pengaduans->links('pagination::tailwind') }}

 </div>

 @endif

 </div>

</div>

@endsection