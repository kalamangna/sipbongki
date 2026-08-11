@extends('layouts.admin')


@section('title', 'Manajemen Pengumuman')


@section('content')


<div class="w-full">



 {{-- HEADER --}}
 <div class="flex justify-between items-center mb-6">


 <div>

 

 <p class="text-slate-500 mb-0">
 Kelola pengumuman publik SIP Bongki.
 </p>


 </div>




 <a href="{{ route('admin.website.pengumuman.create') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">


 <i class="fa-solid fa-circle-plus mr-2"></i>

 Tambah Pengumuman


 </a>


 </div>







 

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">


 <div class="p-6">



 <div class="overflow-x-auto w-full">


 <table class="w-full text-sm text-left text-slate-500">



 <thead class="px-4 py-3 font-medium text-slate-700">


 <tr>


 <th width="70" class="px-4 py-3 font-medium text-slate-700">
 No
 </th>


 <th width="120" class="px-4 py-3 font-medium text-slate-700">
 Gambar
 </th>


 <th class="px-4 py-3 font-medium text-slate-700">
 Judul
 </th>


 <th class="px-4 py-3 font-medium text-slate-700">
 Status
 </th>


 <th class="px-4 py-3 font-medium text-slate-700">
 Tanggal
 </th>


 <th width="190" class="px-4 py-3 font-medium text-slate-700">
 Aksi
 </th>


 </tr>


 </thead>






 <tbody>



 @forelse($pengumumen as $index => $pengumuman)



 <tr>



 <td class="px-4 py-3 border-b border-slate-100">

 {{ $pengumumen->firstItem() + $index }}

 </td>







 <td class="px-4 py-3 border-b border-slate-100">


 @if($pengumuman->gambar)


 <img
 src="{{ asset('storage/'.$pengumuman->gambar) }}"
 width="90"
 height="60"
 class="rounded object-fit-cover"
 alt="{{ $pengumuman->judul }}"
 >


 @else


 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">

 Tidak ada

 </span>


 @endif


 </td>








 <td class="px-4 py-3 border-b border-slate-100">


 <strong>

 {{ $pengumuman->judul }}

 </strong>



 <br>


 <small class="text-slate-500">

 {{ Str::limit(strip_tags($pengumuman->isi),70) }}

 </small>


 </td>









 <td class="px-4 py-3 border-b border-slate-100">


 @if($pengumuman->status === 'publish')


 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">

 <i class="fa-solid fa-circle-check mr-1"></i>

 Publish

 </span>


 @else


 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">

 <i class="fa-solid fa-pen-to-square mr-1"></i>

 Draft

 </span>


 @endif


 </td>









 <td class="px-4 py-3 border-b border-slate-100">


 {{ 
 $pengumuman->tanggal_publish
 ? $pengumuman->tanggal_publish->format('d M Y')
 : '-'
 }}


 </td>









 <td class=\"text-center px-4 py-3 border-b border-slate-100\">

 <div class="action-buttons">

 {{-- Detail --}}
 <a href="{{ route('admin.website.pengumuman.show',$pengumuman) }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-sky-600 text-white hover:bg-sky-700 shadow-sm !px-3 !py-1.5 !text-xs"
 title="Lihat Detail">

 <i class="fa-solid fa-eye"></i>

 </a>

 {{-- Hapus --}}
 <form action="{{ route('admin.website.pengumuman.destroy',$pengumuman) }}"
 method="POST"
 class="inline m-0">

 @csrf
 @method('DELETE')

 <button
 type="submit"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm !px-3 !py-1.5 !text-xs"
 title="Hapus Pengumuman"
 onclick="return confirm('Yakin hapus pengumuman ini?')">

 <i class="fa-solid fa-trash"></i>

 </button>

 </form>

 </div>

</td> 





 </tr>




 @empty



 <tr>


 <td colspan="6"
 class=\"text-center text-slate-500 py-4 px-4 py-3 border-b border-slate-100\">


 <i class="fa-solid fa-bullhorn-fill block mb-2"></i>

 Belum ada pengumuman.



 </td>


 </tr>



 @endforelse




 </tbody>



 </table>


 </div>






 <div class="mt-3">

 {{ $pengumumen->links() }}

 </div>





 </div>


 </div>




</div>



@endsection