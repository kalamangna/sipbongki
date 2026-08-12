@extends('layouts.admin')

@section('title', 'Detail Pengaduan')

@section('content')

<div class="w-full">

 {{-- Header --}}
 <div class="flex justify-between items-center mb-6">

 <div>

 <h4 class="mb-1 complaint-detail-page-title">
 Detail Pengaduan
 </h4>

 <p class="text-slate-500 mb-0">
 Informasi lengkap laporan masyarakat.
 </p>

 </div>

 <a href="{{ route('admin.pengaduan.index') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm focus:outline-none active:scale-95 cursor-pointer">

 <i class="fa-solid fa-arrow-left"></i>
 Kembali

 </a>

 </div>

 <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

 {{-- Informasi Pengaduan --}}
 <div class="lg:col-span-2 space-y-6">

 <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">
 <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-circle-info text-primary-600 mr-2"></i>Informasi Pengaduan</h3>
 </div>

 <div class="p-6">

 <table class="w-full text-sm text-left text-slate-600">

 <tr>
 <th width="220" class="px-4 py-3 font-medium text-slate-700">Kode Pengaduan</th>
 <td class="px-4 py-3 border-b border-slate-100">{{ $pengaduan->kode }}</td>
 </tr>

 <tr>
 <th class="px-4 py-3 font-medium text-slate-700">Nama Pelapor</th>
 <td class="px-4 py-3 border-b border-slate-100">{{ $pengaduan->nama }}</td>
 </tr>

 <tr>
 <th class="px-4 py-3 font-medium text-slate-700">NIK Pelapor</th>
 <td class="px-4 py-3 border-b border-slate-100">{{ $pengaduan->nik_pelapor ?? '-' }}</td>
 </tr>

 <tr>
 <th class="px-4 py-3 font-medium text-slate-700">No. WhatsApp</th>
 <td class="px-4 py-3 border-b border-slate-100">{{ $pengaduan->telepon }}</td>
 </tr>

 <tr>
 <th class="px-4 py-3 font-medium text-slate-700">Alamat</th>
 <td class="px-4 py-3 border-b border-slate-100">{{ $pengaduan->alamat }}</td>
 </tr>

 <tr>
 <th class="px-4 py-3 font-medium text-slate-700">Catatan Petugas</th>
 <td class="px-4 py-3 border-b border-slate-100">{{ $pengaduan->catatan ?? '-' }}</td>
 </tr>

 <tr>
 <th class="px-4 py-3 font-medium text-slate-700">Kategori</th>
 <td class="px-4 py-3 border-b border-slate-100">{{ $pengaduan->kategori }}</td>
 </tr>

 <tr>
 <th class="px-4 py-3 font-medium text-slate-700">Lokasi Kejadian</th>
 <td class="px-4 py-3 border-b border-slate-100">{{ $pengaduan->lokasi }}</td>
 </tr>

 <tr>
 <th class="px-4 py-3 font-medium text-slate-700">Tanggal Laporan</th>
 <td class="px-4 py-3 border-b border-slate-100">

 {{ $pengaduan->created_at->timezone('Asia/Makassar')->format('d F Y H:i') }} WITA

 <br>

 <small class="text-slate-500">

 {{ $pengaduan->created_at->format('H:i') }} WITA

 </small>

 </td>
 </tr>

 </table>

 </div>

 </div>

 {{-- Uraian --}}
 <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">
 <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-file-lines text-sky-500 mr-2"></i>Uraian Pengaduan</h3>
 </div>

 <div class="p-6">

 {!! nl2br(e($pengaduan->uraian)) !!}

 </div>

 </div>

 </div>

 {{-- Sidebar --}}
 <div class="lg:col-span-1 space-y-6">

 {{-- Foto --}}
 <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">
 <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-image text-emerald-500 mr-2"></i>Foto Bukti</h3>
 </div>

 <div class="p-6 text-center">

 @if($pengaduan->foto)

 <img
 src="{{ asset('storage/'.$pengaduan->foto) }}"
 class="img-fluid rounded shadow-sm">

 @else

 <div class="text-slate-500 py-8">

 <i class="fa-solid fa-image block mb-4"></i>

 Tidak ada foto.

 </div>

 @endif

 </div>

 </div>

 {{-- Aksi Penanganan --}}
 <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">
 <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-bolt text-amber-500 mr-2"></i>Aksi Pengaduan</h3>
 </div>

 <div class="p-6">

 @if($pengaduan->status == 'Baru')

 <div class="flex flex-col gap-3 mb-6">

 <form
 action="{{ route('admin.pengaduan.update',$pengaduan) }}"
 method="POST">

 @csrf
 @method('PATCH')

 <input type="hidden" name="status" value="Diproses">

 <button
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm px-4 py-2.5 text-sm w-full active:scale-95 cursor-pointer"
 onclick="return confirm('Proses pengaduan ini?')">

 <i class="fa-solid fa-play-circle mr-2"></i>

 Proses Pengaduan

 </button>

 </form>

 <form
 action="{{ route('admin.pengaduan.update',$pengaduan) }}"
 method="POST">

 @csrf
 @method('PATCH')

 <input type="hidden" name="status" value="Selesai">

 <button
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm px-4 py-2.5 text-sm w-full active:scale-95 cursor-pointer"
 onclick="return confirm('Tandai pengaduan ini sebagai selesai?')">

 <i class="fa-solid fa-circle-check mr-2"></i>

 Selesaikan Pengaduan

 </button>

 </form>

 </div>

 @elseif($pengaduan->status == 'Diproses')

 <div class="flex flex-col gap-3 mb-6">

 <form
 action="{{ route('admin.pengaduan.update',$pengaduan) }}"
 method="POST">

 @csrf
 @method('PATCH')

 <input type="hidden" name="status" value="Selesai">

 <button
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm px-4 py-2.5 text-sm w-full active:scale-95 cursor-pointer"
 onclick="return confirm('Selesaikan pengaduan ini?')">

 <i class="fa-solid fa-circle-check mr-2"></i>

 Selesaikan Pengaduan

 </button>

 </form>

 </div>

 @endif

 <a
 href="{{ route('admin.pengaduan.edit',$pengaduan) }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-amber-500 text-white hover:bg-amber-600 shadow-sm px-4 py-2.5 text-sm w-full active:scale-95 cursor-pointer">

 <i class="fa-solid fa-pen-to-square mr-2"></i>

 Edit Pengaduan

 </a>

 <hr class="border-slate-100 my-6">

 <form
 action="{{ route('admin.pengaduan.update',$pengaduan) }}"
 method="POST">

 @csrf
 @method('PUT')

 <div class="mb-4">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">

 Status

 </label>

 <select
 name="status"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">

 <option
 value="Baru"
 @selected($pengaduan->status=='Baru')>

 Baru

 </option>

 <option
 value="Diproses"
 @selected($pengaduan->status=='Diproses')>

 Diproses

 </option>

 <option
 value="Selesai"
 @selected($pengaduan->status=='Selesai')>

 Selesai

 </option>

 </select>

 </div>

 <div class="mb-4">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">

 Catatan Petugas

 </label>

 <textarea
 name="catatan"
 rows="5"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">{{ old('catatan',$pengaduan->catatan) }}</textarea>

 </div>

 <button
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm px-4 py-2.5 text-sm w-full active:scale-95 cursor-pointer">

 <i class="fa-solid fa-circle-check mr-2"></i>

 Simpan Perubahan

 </button>

 </form>

 </div>

 </div>

 </div>

 </div>

</div>

@endsection