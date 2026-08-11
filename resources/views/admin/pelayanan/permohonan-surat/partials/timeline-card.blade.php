<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

 <div class="px-6 py-4 border-b border-slate-200 bg-white border-0 request-detail-card-header">

 <div>

 <h5 class="mb-0 request-detail-card-title">
 Riwayat Pelayanan
 </h5>

 </div>

 </div>

 <div class="p-6">

 <div class="timeline">

 {{-- Permohonan Dibuat --}}
 <div class="flex mb-6">

 <div class="me-3">

 <div class="rounded-circle bg-primary-100 text-primary-700 text-white flex items-center justify-center"
 style="width:42px;height:42px;">

 <i class="fa-solid fa-file-earmark-plus"></i>

 </div>

 </div>

 <div class="flex-grow-1">

 <div class="font-semibold">
 Permohonan Dibuat
 </div>

 <small class="text-slate-500 block">

 {{ $permohonanSurat->created_at->translatedFormat('d F Y H:i') }}

 </small>

 @php
 $creatorLabel = 'Warga';

 if ($permohonanSurat->operator) {
 $role = strtolower($permohonanSurat->operator->role ?? 'operator');
 $creatorLabel = $role === 'admin' ? 'Admin' : 'Operator';
 }
 @endphp

 <small class="text-secondary">

 Data permohonan berhasil dibuat oleh {{ $creatorLabel }}.

 </small>

 </div>

 </div>


 {{-- Diproses --}}
 @if(
 in_array($permohonanSurat->status,['Diproses','Selesai'])
 )

 <div class="flex mb-6">

 <div class="me-3">

 <div class="rounded-circle bg-sky-100 text-sky-700 text-white flex items-center justify-center"
 style="width:42px;height:42px;">

 <i class="fa-solid fa-arrow-repeat"></i>

 </div>

 </div>

 <div class="flex-grow-1">

 <div class="font-semibold">
 Permohonan Diproses
 </div>

 <small class="text-info">

 Sedang diproses oleh petugas pelayanan.

 </small>

 </div>

 </div>

 @endif


 {{-- Ditolak --}}
 @if($permohonanSurat->status=='Ditolak')

 <div class="flex">

 <div class="me-3">

 <div class="rounded-circle bg-rose-100 text-rose-700 text-white flex items-center justify-center"
 style="width:42px;height:42px;">

 <i class="fa-solid fa-circle-xmark"></i>

 </div>

 </div>

 <div class="flex-grow-1">

 <div class="font-semibold text-danger">
 Permohonan Ditolak
 </div>

 <small class="text-slate-500">

 Permohonan tidak dapat diproses.

 </small>

 </div>

 </div>

 @endif


 {{-- Selesai --}}
 @if($permohonanSurat->status=='Selesai')

 <div class="flex">

 <div class="me-3">

 <div class="rounded-circle bg-emerald-100 text-emerald-700 text-white flex items-center justify-center"
 style="width:42px;height:42px;">

 <i class="fa-solid fa-circle-check"></i>

 </div>

 </div>

 <div class="flex-grow-1">

 <div class="font-semibold text-success">
 Surat Selesai
 </div>

 <small class="text-slate-500">

 Surat telah selesai diproses dan siap dicetak.

 </small>

 </div>

 </div>

 @endif

 </div>

 </div>

</div>