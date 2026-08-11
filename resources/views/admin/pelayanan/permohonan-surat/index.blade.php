@extends('layouts.admin')

@section('title', 'Permohonan Surat')

@section('content')
<div class="w-full">

 <div class="flex justify-between items-center mb-6">

 <div>
 
 
 

 </div>

 <a
 href="{{ route('admin.permohonan-surat.create') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

 <i class="fa-solid fa-circle-plus"></i>
 Permohonan

 </a>

 </div>


 
 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">

 <div class="px-6 py-4 border-b border-slate-200 bg-white">

 <form method="GET">

 <div class="flex flex-col md:flex-flex flex-wrap -mx-3 gap-3">

 <div class="flex-1">

 <input
 type="text"
 name="search"
 value="{{ request('search') }}"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="Cari Nomor / Nama Pemohon...">

 </div>


 <div class="shrink-0">

 <button class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

 <i class="fa-solid fa-magnifying-glass"></i>
 Cari

 </button>

 </div>


 @if(request('search'))

 <div class="shrink-0">

 <a
 href="{{ route('admin.permohonan-surat.index') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600">

 Reset

 </a>

 </div>

 @endif

 </div>

 </form>

 </div>



 <div class="p-6 p-0">

 <table class="w-full text-sm text-left text-slate-500">

 <thead class=\"text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-200 px-4 py-3 font-medium text-slate-700\">

 <tr>

 <th width="70" class=\"text-center px-4 py-3 font-medium text-slate-700\">
 No
 </th>

 <th class=\"text-center px-4 py-3 font-medium text-slate-700\">
 No. Permohonan
 </th>

 <th class=\"text-center px-4 py-3 font-medium text-slate-700\">
 Tanggal
 </th>

 <th class=\"text-center px-4 py-3 font-medium text-slate-700\">
 Pemohon
 </th>

 <th class=\"text-center px-4 py-3 font-medium text-slate-700\">
 Jenis Surat
 </th>

 <th class=\"text-center px-4 py-3 font-medium text-slate-700\">
 Status
 </th>

 <th width="230" class=\"text-center px-4 py-3 font-medium text-slate-700\">
 Aksi
 </th>

 </tr>

 </thead>


 <tbody>

 @forelse($permohonans as $permohonan)

 <tr>

 <td class=\"text-center px-4 py-3 border-b border-slate-100\">
 {{ $permohonans->firstItem() + $loop->index }}
 </td>


 <td class=\"text-center px-4 py-3 border-b border-slate-100\">
 {{ $permohonan->nomor_permohonan }}
 </td>


 <td class=\"text-center px-4 py-3 border-b border-slate-100\">
 {{ $permohonan->tanggal_permohonan->format('d-m-Y') }}
 </td>


 <td class=\"text-center px-4 py-3 border-b border-slate-100\">
 {{ optional($permohonan->penduduk)->nama_lengkap ?? data_get($permohonan->data_surat, 'nama_lengkap') ?? '-' }}
 </td>


 <td class=\"text-center px-4 py-3 border-b border-slate-100\">
 {{ optional($permohonan->jenisSurat)->nama ?? '-' }}
 </td>


 <td class=\"text-center px-4 py-3 border-b border-slate-100\">

 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-{{ $permohonan->status_badge_class }}">

 {{ $permohonan->status }}

 </span>

 </td>

<td class=\"text-center px-4 py-3 border-b border-slate-100\">

 <div class="action-buttons">

 {{-- Detail --}}
 <a href="{{ route('admin.permohonan-surat.show', $permohonan) }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-sky-600 text-white hover:bg-sky-700 shadow-sm !px-3 !py-1.5 !text-xs"
 title="Detail">
 <i class="fa-solid fa-eye"></i>
 </a>

</div>

</td>
 </tr>


 @empty

 <tr>

 <td colspan="7" class=\"text-center py-8 px-4 py-3 border-b border-slate-100\">

 <i class="fa-solid fa-file-lines block mb-4"></i>

 <span class="text-slate-500">

 Belum ada permohonan surat.

 </span>

 </td>

 </tr>

 @endforelse


 </tbody>


 </table>


 </div>



 @if($permohonans->hasPages())

 <div class="px-6 py-4 border-t border-slate-200 bg-white">

 {{ $permohonans->links() }}

 </div>

 @endif


 </div>

</div>
@endsection