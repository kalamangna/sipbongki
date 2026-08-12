<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

 <div class="px-6 py-4 border-b border-slate-200 bg-white border-0 request-detail-card-header">

 <div>

 <h3 class="font-bold text-slate-800 text-base mb-0">
 Informasi Sistem
 </h3>

 </div>

 </div>

 <div class="p-6">

 <div class="flex justify-between items-center py-2 border-bottom">

 <div>

 <small class="text-slate-500 block">
 ID Permohonan
 </small>

 <strong>
 #{{ $permohonanSurat->id }}
 </strong>

 </div>

 <i class="fa-solid fa-hash text-primary "></i>

 </div>

 <div class="flex justify-between items-center py-3 border-bottom">

 <div>

 <small class="text-slate-500 block">
 Dibuat
 </small>

 <strong>

 {{ $permohonanSurat->created_at->translatedFormat('d F Y') }}

 </strong>

 <br>

 <small class="text-secondary">

 {{ $permohonanSurat->created_at->format('H:i') }} WITA

 </small>

 </div>

 <i class="fa-solid fa-calendar-plus text-success "></i>

 </div>

 <div class="flex justify-between items-center py-3 border-bottom">

 <div>

 <small class="text-slate-500 block">
 Terakhir Diubah
 </small>

 <strong>

 {{ $permohonanSurat->updated_at->translatedFormat('d F Y') }}

 </strong>

 <br>

 <small class="text-secondary">

 {{ $permohonanSurat->updated_at->format('H:i') }} WITA

 </small>

 </div>

 <i class="fa-solid fa-clock-history text-warning "></i>

 </div>

 @if($permohonanSurat->tanggal_selesai)

 <div class="flex justify-between items-center pt-3">

 <div>

 <small class="text-slate-500 block">
 Tanggal Selesai
 </small>

 <strong>

 {{ $permohonanSurat->tanggal_selesai->translatedFormat('d F Y') }}

 </strong>

 </div>

 <i class="fa-solid fa-circle-check-fill text-success "></i>

 </div>

 @endif

 </div>

</div>