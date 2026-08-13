@extends('layouts.admin')

@section('title', 'Edit Pengaduan')

@section('content')

<div class="w-full">

 <div class="flex justify-between items-center mb-6">

 <div>

 <h3 class="text-2xl font-bold text-slate-800 mb-1">
 Edit Pengaduan
 </h3>

 <p class="text-slate-500 mb-0">
 Perbarui status dan catatan pengaduan.
 </p>

 </div>

 <a href="{{ route('admin.pengaduan.index') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm focus:outline-none active:scale-95 cursor-pointer">

 <i class="fa-solid fa-arrow-left"></i>
 Kembali

 </a>

 </div>

 <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">
 <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-pen-to-square text-primary-600 mr-2"></i>Form Edit Pengaduan</h3>
 </div>

 <div class="p-6">

 @if ($errors->any())
 <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 flex gap-3 items-start">
 <i class="fa-solid fa-circle-exclamation text-red-500 mt-0.5"></i>
 <div>
 <h4 class="text-sm font-bold text-red-800">Mohon periksa kembali input Anda:</h4>
 <ul class="text-sm text-red-600 mt-1 list-disc list-inside">
 @foreach ($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>
 </div>
 </div>
 @endif

 <form
 action="{{ route('admin.pengaduan.update', $pengaduan) }}"
 method="POST">

 @csrf
 @method('PUT')

 <div class="mb-4">
 <label class="block text-sm font-semibold text-slate-700 mb-1.5">Status</label>
 <select name="status" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">
 <option value="Baru" @selected($pengaduan->status=='Baru')>Baru</option>
 <option value="Diproses" @selected($pengaduan->status=='Diproses')>Diproses</option>
 <option value="Selesai" @selected($pengaduan->status=='Selesai')>Selesai</option>
 </select>
 </div>

 <div class="mb-4">
 <label class="block text-sm font-semibold text-slate-700 mb-1.5">Catatan Petugas</label>
 <textarea name="catatan" rows="5" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm" placeholder="Tuliskan catatan atau tanggapan petugas di sini...">{{ old('catatan', $pengaduan->catatan) }}</textarea>
 </div>

 </div>
 
 <div class="bg-slate-50/50 border-t border-slate-200 px-6 py-4 flex items-center justify-end gap-3">
 <a href="{{ route('admin.pengaduan.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm focus:outline-none">
 Batal
 </a>
 <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm hover:-translate-y-0.5 shadow-primary-500/20 focus:outline-none focus:ring-2 focus:ring-primary-500 cursor-pointer">
 <i class="fa-solid fa-save"></i> Simpan Perubahan
 </button>
 </div>

 </form>

 </div>

</div>

@endsection
