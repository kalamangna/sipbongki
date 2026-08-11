@extends('layouts.admin')

@section('title','Detail Laporan Kartu Keluarga')

@section('content')

<div class="w-full">

 <div class="flex justify-between items-center mb-6">

 <div>
 <h3 class="font-bold mb-1">Detail Laporan Kartu Keluarga</h3>
 <p class="text-slate-500 mb-0">Informasi detail Kartu Keluarga khusus dari laporan.</p>
 </div>

 <a href="{{ route('admin.laporan.kartu-keluarga') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600">
 <i class="fa-solid fa-arrow-left"></i>
 Kembali ke Laporan
 </a>

 </div>

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-4">
 <div class="p-6">
 <div class="flex flex-wrap -mx-3">
 <div class="w-full md:w-1/2 px-3 mb-4">
 <strong>No. Kartu Keluarga :</strong>
 <br>
 {{ $kartuKeluarga->no_kk }}
 </div>

 <div class="w-full md:w-1/2 px-3 mb-4">
 <strong>Kepala Keluarga :</strong>
 <br>
 <div>{{ $kartuKeluarga->kepalaKeluarga->nama_lengkap ?? '-' }}</div>
 <small class="text-slate-500">
 {{ $kartuKeluarga->kepalaKeluarga->tempat_lahir ?? '-' }},
 {{ $kartuKeluarga->kepalaKeluarga?->tanggal_lahir
 ? \Carbon\Carbon::parse($kartuKeluarga->kepalaKeluarga->tanggal_lahir)->translatedFormat('d F Y')
 : '-' }}
 </small>
 </div>

 <div class="w-full md:w-1/2 px-3 mb-4">
 <strong>Lingkungan :</strong>
 <br>
 {{ $kartuKeluarga->lingkungan->nama ?? '-' }}
 </div>

 <div class="w-full md:w-1/2 px-3 mb-4">
 <strong>RT/RW :</strong>
 <br>
 {{ $kartuKeluarga->rt ?? '00' }}/{{ $kartuKeluarga->rw ?? '00' }}
 </div>

 <div class="w-full md:w-full px-3">
 <strong>Alamat :</strong>
 <br>
 {{ $kartuKeluarga->alamat ?? '-' }}
 </div>
 </div>
 </div>
 </div>

 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">
 <div class="px-6 py-4 border-b border-slate-200 bg-white">
 <h6 class="mb-0 text-center">Anggota Keluarga</h6>
 </div>
 <div class="p-6 p-0">
 <div class="overflow-x-auto w-full">
 <table class="w-full text-sm text-left text-slate-500">
 <thead class="px-4 py-3 font-medium text-slate-700">
 <tr>
 <th style="text-transform: capitalize !important; text-align: center;" class="px-4 py-3 font-medium text-slate-700">No.</th>
 <th style="text-transform: uppercase !important; text-align: center;" class="px-4 py-3 font-medium text-slate-700">NIK</th>
 <th style="text-transform: capitalize !important; text-align: center;" class="px-4 py-3 font-medium text-slate-700">Nama Lengkap</th>
 <th style="text-transform: capitalize !important; text-align: center;" class="px-4 py-3 font-medium text-slate-700">Tempat, Tanggal Lahir</th>
 <th style="text-transform: capitalize !important; text-align: center;" class="px-4 py-3 font-medium text-slate-700">Hubungan</th>
 <th style="text-transform: capitalize !important; text-align: center;" class="px-4 py-3 font-medium text-slate-700">Jenis Kelamin</th>
 </tr>
 </thead>
 <tbody>
 @forelse($kartuKeluarga->anggota as $anggota)
 <tr>
 <td class="px-4 py-3 border-b border-slate-100">{{ $loop->iteration }}</td>
 <td class="px-4 py-3 border-b border-slate-100">{{ $anggota->nik }}</td>
 <td class="px-4 py-3 border-b border-slate-100">{{ $anggota->nama_lengkap }}</td>
 <td class="px-4 py-3 border-b border-slate-100">
 {{ $anggota->tempat_lahir ?? '-' }},
 {{ $anggota->tanggal_lahir
 ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->translatedFormat('d F Y')
 : '-' }}
 </td>
 <td class="px-4 py-3 border-b border-slate-100">{{ $anggota->hubungan_keluarga ?? '-' }}</td>
 <td class="px-4 py-3 border-b border-slate-100">@gender($anggota->jenis_kelamin)</td>
 </tr>
 @empty
 <tr>
 <td colspan="6" class=\"text-center py-4 px-4 py-3 border-b border-slate-100\">
 Belum ada anggota keluarga.
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
