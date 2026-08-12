<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">

 <div class="px-6 py-4 border-b border-slate-200 bg-white flex items-center">

 <i class="fa-solid fa-user-vcard text-primary mr-2"></i>

 <div>

 <h5 class="mb-0 font-semibold">
 Data Pemohon
 </h5>

 <small class="text-slate-500">
 Informasi identitas pemohon surat
 </small>

 </div>

 </div>

 <div class="p-6">

 @php
 $pemohon = $permohonanSurat->penduduk;
 $dataSurat = $permohonanSurat->data_surat ?? [];
 @endphp

 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

 <div>

 <small class="text-slate-500 block">
 Nama Lengkap
 </small>

 <div class="font-semibold ">
 {{ optional($pemohon)->nama_lengkap ?? data_get($dataSurat, 'nama_lengkap') ?? '-' }}
 </div>

 </div>

 <div>

 <small class="text-slate-500 block">
 NIK
 </small>

 <div class="font-semibold">
 {{ optional($pemohon)->nik ?? data_get($dataSurat, 'nik') ?? '-' }}
 </div>

 </div>

 <div>

 <small class="text-slate-500 block">
 Nomor KK
 </small>

 <div class="font-semibold">
 {{ optional($pemohon)->no_kk ?? '-' }}
 </div>

 </div>

 <div>

 <small class="text-slate-500 block">
 Jenis Kelamin
 </small>

 <div>
 @gender(optional($pemohon)->jenis_kelamin ?? data_get($dataSurat, 'jenis_kelamin'))
 </div>

 </div>

 <div>

 <small class="text-slate-500 block">
 Tempat Lahir
 </small>

 <div>
 {{ optional($pemohon)->tempat_lahir ?? data_get($dataSurat, 'tempat_lahir') ?? '-' }}
 </div>

 </div>

 <div>

 <small class="text-slate-500 block">
 Tanggal Lahir
 </small>

 <div>
 {{ optional($pemohon)->tanggal_lahir?->translatedFormat('d F Y') ?? data_get($dataSurat, 'tanggal_lahir') ?? '-' }}
 </div>

 </div>

 <div class="md:col-span-2">

 <small class="text-slate-500 block">
 Alamat
 </small>

 <div class="border rounded-3 p-3 bg-slate-50">

 {{ optional($pemohon)->alamat ?? data_get($dataSurat, 'alamat') ?? '-' }}

 </div>

 </div>

 </div>

 </div>

</div>