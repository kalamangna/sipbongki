@extends('layouts.admin')


@section('title', 'Halaman')


@section('content')


<div class="w-full">


<div class="flex justify-between items-center mb-6">


 <div>

 

 <p class="text-slate-500 mb-0">
 Kelola halaman informasi publik SIP Bongki.
 </p>

 </div>



 <a href="{{ route('admin.website.halaman.create') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

 <i class="fa-solid fa-circle-plus mr-2"></i>

 Tambah Halaman

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

<th class="px-4 py-3 font-medium text-slate-700">
Judul
</th>

<th class="px-4 py-3 font-medium text-slate-700">
Slug
</th>

<th class="px-4 py-3 font-medium text-slate-700">
Status
</th>

<th width="180" class="px-4 py-3 font-medium text-slate-700">
Aksi
</th>

</tr>

</thead>




<tbody>


@forelse($halamans as $index=>$halaman)


<tr>


<td class="px-4 py-3 border-b border-slate-100">
{{ $index+1 }}
</td>



<td class="px-4 py-3 border-b border-slate-100">

<strong>
{{ $halaman->judul }}
</strong>

<br>

<small class="text-slate-500">

{{ Str::limit(strip_tags($halaman->isi),60) }}

</small>


</td>




<td class="px-4 py-3 border-b border-slate-100">

{{ $halaman->slug }}

</td>




<td class="px-4 py-3 border-b border-slate-100">


@if($halaman->status == 'aktif')


<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">

Aktif

</span>


@else


<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">

Draft

</span>


@endif


</td>




<td class=\"text-center px-4 py-3 border-b border-slate-100\">

 <div class="action-buttons">

 {{-- Detail --}}
 <a href="{{ route('admin.website.halaman.show',$halaman->id) }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-sky-600 text-white hover:bg-sky-700 shadow-sm !px-3 !py-1.5 !text-xs"
 title="Detail">

 <i class="fa-solid fa-eye"></i>

 </a>

 {{-- Edit --}}
 <a href="{{ route('admin.website.halaman.edit',$halaman->id) }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-amber-500 text-white hover:bg-amber-600 shadow-sm !px-3 !py-1.5 !text-xs"
 title="Edit">

 <i class="fa-solid fa-pen-to-square"></i>

 </a>

 {{-- Hapus --}}
 <form action="{{ route('admin.website.halaman.destroy',$halaman->id) }}"
 method="POST"
 class="inline m-0">

 @csrf
 @method('DELETE')

 <button type="submit"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm !px-3 !py-1.5 !text-xs"
 title="Hapus"
 onclick="return confirm('Hapus halaman ini?')">

 <i class="fa-solid fa-trash"></i>

 </button>

 </form>

 </div>

</td>


</tr>


@empty


<tr>

<td colspan="5"
class=\"text-center text-slate-500 py-4 px-4 py-3 border-b border-slate-100\">

Belum ada halaman.

</td>

</tr>


@endforelse


</tbody>


</table>


</div>


</div>

</div>


</div>


@endsection