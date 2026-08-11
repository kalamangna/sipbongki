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
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600">

 <i class="fa-solid fa-arrow-left"></i>
 Kembali

 </a>

 </div>

 <div class="flex flex-wrap -mx-3">

 {{-- Informasi Pengaduan --}}
 <div class="w-full lg:w-2/3 px-3">

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

 <div class="px-6 py-4 border-b border-slate-200 bg-white border-0 complaint-detail-card-header">

 <h5 class="mb-0 complaint-detail-card-title">
 Informasi Pengaduan
 </h5>

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
 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

 <div class="px-6 py-4 border-b border-slate-200 bg-white border-0 complaint-detail-card-header">

 <h5 class="mb-0 complaint-detail-card-title">

 Uraian Pengaduan

 </h5>

 </div>

 <div class="p-6">

 {!! nl2br(e($pengaduan->uraian)) !!}

 </div>

 </div>

 </div>

 {{-- Sidebar --}}
 <div class="w-full lg:w-1/3 px-3">

 {{-- Foto --}}
 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

 <div class="px-6 py-4 border-b border-slate-200 bg-white border-0 complaint-detail-card-header">

 <h5 class="mb-0 complaint-detail-card-title">

 Foto Bukti

 </h5>

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
 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

 <div class="px-6 py-4 border-b border-slate-200 bg-white border-0 complaint-detail-card-header complaint-detail-action-header">

 <h5 class="mb-0 complaint-detail-card-title">

 Aksi Pengaduan

 </h5>

 </div>

 <div class="p-6">

 @if($pengaduan->status == 'Baru')

 <div class="d-grid gap-3 mb-6">

 <form
 action="{{ route('admin.pengaduan.update',$pengaduan) }}"
 method="POST">

 @csrf
 @method('PATCH')

 <input type="hidden" name="status" value="Diproses">

 <button
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm px-5 py-3 text-base w-100"
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
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm px-5 py-3 text-base w-100"
 onclick="return confirm('Tandai pengaduan ini sebagai selesai?')">

 <i class="fa-solid fa-circle-check mr-2"></i>

 Selesaikan Pengaduan

 </button>

 </form>

 </div>

 @elseif($pengaduan->status == 'Diproses')

 <div class="d-grid gap-3 mb-6">

 <form
 action="{{ route('admin.pengaduan.update',$pengaduan) }}"
 method="POST">

 @csrf
 @method('PATCH')

 <input type="hidden" name="status" value="Selesai">

 <button
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm px-5 py-3 text-base w-100"
 onclick="return confirm('Selesaikan pengaduan ini?')">

 <i class="fa-solid fa-circle-check mr-2"></i>

 Selesaikan Pengaduan

 </button>

 </form>

 </div>

 @endif

 <a
 href="{{ route('admin.pengaduan.edit',$pengaduan) }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-amber-500 text-white hover:bg-amber-600 shadow-sm px-5 py-3 text-base w-100 mb-6">

 <i class="fa-solid fa-pen-to-square mr-2"></i>

 Edit Pengaduan

 </a>

 <form
 action="{{ route('admin.pengaduan.update',$pengaduan) }}"
 method="POST">

 @csrf
 @method('PUT')

 <div class="mb-4">

 <label class="form-label">

 Status

 </label>

 <select
 name="status"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">

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

 <label class="form-label">

 Catatan Petugas

 </label>

 <textarea
 name="catatan"
 rows="5"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">{{ old('catatan',$pengaduan->catatan) }}</textarea>

 </div>

 <button
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm px-5 py-3 text-base w-100">

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