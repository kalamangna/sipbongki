@extends('layouts.admin')


@section('title', 'Agenda')


@section('content')


<div class="w-full">


 {{-- HEADER --}}
 <div class="flex justify-between items-center mb-6">


 <div>

 
 <p class="text-slate-500 mb-0">
 Kelola jadwal kegiatan Kelurahan Bongki.
 </p>

 </div>



 <a href="{{ route('admin.website.agenda.create') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

 <i class="fa-solid fa-circle-plus mr-2"></i>

 Tambah Agenda

 </a>


 </div>





 




 {{-- CARD TABLE --}}
 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">


 <div class="p-6">


 <div class="overflow-x-auto w-full">


 <table class="w-full text-sm text-left text-slate-500">


 <thead class="px-4 py-3 font-medium text-slate-700">

 <tr>

 <th width="60" class="px-4 py-3 font-medium text-slate-700">
 No
 </th>

 <th class="px-4 py-3 font-medium text-slate-700">
 Kegiatan
 </th>

 <th width="130" class="px-4 py-3 font-medium text-slate-700">
 Tanggal
 </th>

 <th width="120" class="px-4 py-3 font-medium text-slate-700">
 Waktu
 </th>

 <th class="px-4 py-3 font-medium text-slate-700">
 Lokasi
 </th>

 <th width="120" class="px-4 py-3 font-medium text-slate-700">
 Status
 </th>

 <th width="150" class="px-4 py-3 font-medium text-slate-700">
 Aksi
 </th>

 </tr>

 </thead>



 <tbody>


 @forelse($agendas as $index => $agenda)


 <tr>


 <td class="px-4 py-3 border-b border-slate-100">

 {{ $agendas->firstItem() + $index }}

 </td>




 <td class="px-4 py-3 border-b border-slate-100">


 <strong>

 {{ $agenda->judul }}

 </strong>


 <br>


 <small class="text-slate-500">

 {{ Str::limit($agenda->deskripsi, 70) }}

 </small>


 </td>




 <td class="px-4 py-3 border-b border-slate-100">


 {{ $agenda->tanggal
 ? $agenda->tanggal->format('d M Y')
 : '-'
 }}


 </td>





 <td class="px-4 py-3 border-b border-slate-100">


 {{ $agenda->waktu ?? '-' }}


 WITA


 </td>





 <td class="px-4 py-3 border-b border-slate-100">


 <i class="fa-solid fa-geo-alt text-primary mr-1"></i>


 {{ $agenda->lokasi ?? '-' }}


 </td>





 <td class="px-4 py-3 border-b border-slate-100">


 @if($agenda->status == 'aktif')


 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">

 Aktif

 </span>


 @else


 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">

 Nonaktif

 </span>


 @endif


 </td>






 
<td class=\"text-center px-4 py-3 border-b border-slate-100\">

 <div class="action-buttons">

 {{-- Detail --}}
 <a href="{{ route('admin.website.agenda.show',$agenda->id) }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-sky-600 text-white hover:bg-sky-700 shadow-sm !px-3 !py-1.5 !text-xs"
 title="Detail">

 <i class="fa-solid fa-eye"></i>

 </a>

 {{-- Hapus --}}
 <form action="{{ route('admin.website.agenda.destroy',$agenda->id) }}"
 method="POST"
 class="inline m-0">

 @csrf
 @method('DELETE')

 <button
 type="submit"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm !px-3 !py-1.5 !text-xs"
 title="Hapus"
 onclick="return confirm('Hapus agenda ini?')">

 <i class="fa-solid fa-trash"></i>

 </button>

 </form>

 </div>

</td>


 </tr>



 @empty


 <tr>

 <td colspan="7"
 class=\"text-center text-slate-500 py-4 px-4 py-3 border-b border-slate-100\">


 Belum ada agenda.


 </td>

 </tr>


 @endforelse



 </tbody>



 </table>

 @if($agendas->hasPages())
 <div class="px-6 py-4 border-t border-slate-100 bg-white">
    {{ $agendas->links() }}
 </div>
 @endif

 </div>


 </div>



</div>


@endsection