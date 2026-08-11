@extends('layouts.admin')

@section('title','Detail Laporan Persuratan')

@section('content')

<div class="w-full">

 <div class="flex justify-between items-center mb-6">
 <div>
 <h3 class="font-bold mb-1">Detail Laporan Persuratan</h3>
 <p class="text-slate-500 mb-0">Informasi detail permohonan surat khusus dari laporan.</p>
 </div>

 <a href="{{ route('admin.laporan.persuratan') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600">
 <i class="fa-solid fa-arrow-left"></i>
 Kembali
 </a>
 </div>

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-4">
 <div class="p-6">
 <div class="flex flex-wrap -mx-3 gap-4">
 <div class="w-full md:w-1/2 px-3">
 <strong>Nomor Permohonan :</strong><br>
 {{ $permohonanSurat->nomor_permohonan ?? '-' }}
 </div>
 <div class="w-full md:w-1/2 px-3">
 <strong>Nomor Surat :</strong><br>
 {{ $permohonanSurat->nomor_surat ?? 'Belum diterbitkan' }}
 </div>
 <div class="w-full md:w-1/2 px-3">
 <strong>Jenis Surat :</strong><br>
 {{ optional($permohonanSurat->jenisSurat)->nama ?? '-' }}
 </div>
 <div class="w-full md:w-1/2 px-3">
 <strong>Status :</strong><br>
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-{{ $permohonanSurat->status_badge_class }}">{{ $permohonanSurat->status }}</span>
 </div>
 <div class="w-full md:w-1/2 px-3">
 <strong>Nama Pemohon :</strong><br>
 {{ optional($permohonanSurat->penduduk)->nama_lengkap ?? '-' }}
 </div>
 <div class="w-full md:w-1/2 px-3">
 <strong>NIK :</strong><br>
 {{ optional($permohonanSurat->penduduk)->nik ?? '-' }}
 </div>
 <div class="w-full md:w-1/2 px-3">
 <strong>Tanggal Permohonan :</strong><br>
 {{ $permohonanSurat->tanggal_permohonan ? $permohonanSurat->tanggal_permohonan->translatedFormat('d F Y') : '-' }}
 </div>
 <div class="w-full md:w-1/2 px-3">
 <strong>Penandatangan :</strong><br>
 {{ optional($permohonanSurat->penandatangan)->nama_lengkap ?? '-' }}
 </div>
 <div class="w-full px-3">
 <strong>Keperluan :</strong><br>
 {{ $permohonanSurat->keperluan ?? '-' }}
 </div>
 <div class="w-full px-3">
 <strong>Alamat :</strong><br>
 {{ optional($permohonanSurat->penduduk)->alamat ?? '-' }}
 </div>
 </div>
 </div>
 </div>

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">
 <div class="px-6 py-4 border-b border-slate-200 bg-white">
 <h6 class="mb-0">Data Tambahan</h6>
 </div>
 <div class="p-6">
 <div class="flex flex-wrap -mx-3 gap-4">
 <div class="w-full px-3">
 <strong>Catatan Petugas :</strong><br>
 {{ $permohonanSurat->catatan ?? 'Tidak ada catatan.' }}
 </div>
 </div>
 </div>
 </div>

</div>

@endsection
