<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">

 <div class="px-6 py-4 border-b border-slate-200 bg-white border-0 request-detail-card-header">

 <div>

 <h3 class="font-bold text-slate-800 text-base mb-0">
 Status Pelayanan
 </h3>

 </div>

 </div>

 <div class="p-6 text-center">

 @php

 $icon = match($permohonanSurat->status){

 'Menunggu' => 'fa-hourglass-half',

 'Diproses' => 'fa-arrow-rotate-right',

 'Selesai' => 'fa-circle-check',

 'Ditolak' => 'fa-circle-xmark',

 default => 'fa-circle-question',

 };

 @endphp

 <div class="mb-4">

 <i class="fa-solid {{ $icon }} text-5xl mb-2 inline-block text-{{ $permohonanSurat->status_badge_class }}"></i>

 </div>

 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold rounded-pill px-4 py-3 bg-{{ str_replace('text-', 'bg-', $permohonanSurat->status_badge_class) }} text-{{ $permohonanSurat->status_badge_class }} bg-opacity-20">

 {{ strtoupper($permohonanSurat->status) }}

 </span>

 <hr class="my-4">

 @switch($permohonanSurat->status)

 @case('Menunggu')

 <div class="text-warning">

 <h6 class="font-bold">
 Menunggu Diproses
 </h6>

 <p class="mb-0 text-slate-500">

 Permohonan telah diterima dan sedang
 menunggu verifikasi petugas pelayanan.

 </p>

 </div>

 @break

 @case('Diproses')

 <div class="text-info">

 <h6 class="font-bold">
 Sedang Diproses
 </h6>

 <p class="mb-0 text-slate-500">

 Surat sedang diproses dan menunggu
 penyelesaian administrasi.

 </p>

 </div>

 @break

 @case('Selesai')

 <div class="text-success">

 <h6 class="font-bold">
 Surat Telah Selesai
 </h6>

 <p class="mb-0 text-slate-500">

 Surat sudah selesai diproses dan
 siap dicetak maupun diserahkan.

 </p>

 </div>

 @break

 @case('Ditolak')

 <div class="text-danger">

 <h6 class="font-bold">
 Permohonan Ditolak
 </h6>

 <p class="mb-0 text-slate-500">

 Permohonan tidak dapat diproses.
 Silakan lihat catatan petugas.

 </p>

 </div>

 @break

 @endswitch

 </div>

</div>