@extends('layouts.admin')

@section('title', 'Riwayat Pelayanan')

@section('content')

<div class="w-full">

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

 <div class="px-6 py-4 border-b border-slate-200 bg-white">
 <div class="flex justify-between items-center">
 <div>
 <h5 class="mb-0">Riwayat Pelayanan</h5>
 <small class="text-slate-500">Semua riwayat pelayanan permohonan</small>
 </div>
 </div>
 </div>

 <div class="p-6 p-0">

 <div class="overflow-x-auto w-full">

 <table class="w-full text-sm text-left text-slate-500">

 <thead class=\"text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-200 px-4 py-3 font-medium text-slate-700\">

 <tr>

 <th width="70" class="px-4 py-3 font-medium text-slate-700">No</th>

 <th class="px-4 py-3 font-medium text-slate-700">No. Permohonan</th>

 <th class="px-4 py-3 font-medium text-slate-700">Pemohon</th>

 <th class="px-4 py-3 font-medium text-slate-700">Jenis Surat</th>

 <th width="120" class=\"text-center px-4 py-3 font-medium text-slate-700\">
 Status
 </th>

 <th width="150" class="px-4 py-3 font-medium text-slate-700">
 Tanggal Selesai
 </th>

 <th width="200" class=\"text-center px-4 py-3 font-medium text-slate-700\">
 Aksi
 </th>

 </tr>

 </thead>

 <tbody>

 @forelse($riwayats as $item)

 <tr>

 <td class="px-4 py-3 border-b border-slate-100">
 {{ $riwayats->firstItem() + $loop->index }}
 </td>

 <td class="px-4 py-3 border-b border-slate-100">
 {{ $item->nomor_permohonan }}
 </td>

 <td class="px-4 py-3 border-b border-slate-100">
 {{ optional($item->penduduk)->nama_lengkap ?? data_get($item->data_surat, 'nama_lengkap') ?? '-' }}
 </td>

 <td class="px-4 py-3 border-b border-slate-100">
 {{ $item->jenisSurat->nama ?? '-' }}
 </td>

 <td class=\"text-center px-4 py-3 border-b border-slate-100\">

 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-{{ $item->status_badge_class }}">
 {{ $item->status }}
 </span>

 </td>

 <td class="px-4 py-3 border-b border-slate-100">

 {{ $item->tanggal_selesai
 ? \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y')
 : '-'
 }}

 </td>

 <td class=\"text-center px-4 py-3 border-b border-slate-100\">

 <div class="action-buttons">

 {{-- Preview --}}
 <a
 href="{{ route('admin.permohonan-surat.preview', $item) }}?from=riwayat"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-sky-600 text-white hover:bg-sky-700 shadow-sm !px-3 !py-1.5 !text-xs"
 title="Preview Surat">

 <i class="fa-solid fa-eye"></i>

</a>

 </div>

 </td>

 </tr>

 @empty

 <tr>

 <td colspan="7" class=\"text-center py-8 px-4 py-3 border-b border-slate-100\">

 <i class="fa-solid fa-clock-history text-slate-500 block mb-4"></i>

 <span class="text-slate-500">

 Belum ada riwayat pelayanan.

 </span>

 </td>

 </tr>

 @endforelse

 </tbody>

 </table>

 </div>

 </div>

 @if($riwayats->hasPages())

 <div class="px-6 py-4 border-t border-slate-200 bg-white">

 {{ $riwayats->links() }}

 </div>

 @endif

 </div>

</div>

@endsection