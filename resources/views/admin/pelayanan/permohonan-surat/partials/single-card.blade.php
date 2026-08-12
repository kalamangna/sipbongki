<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">

 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">

 <h3 class="font-bold text-slate-800 text-base mb-0">
 Detail Permohonan
 </h3>

 </div>

 <div class="p-6 request-detail-card-body">

 @php
 $pemohon = $permohonanSurat->penduduk;
 $dataSurat = $permohonanSurat->data_surat ?? [];
 $isUsaha = $permohonanSurat->jenisSurat?->isUsaha() ?? false;

 $compare = function ($field) use ($pemohon, $dataSurat) {
 if (!$pemohon) return null;
 $pendudukValue = data_get($pemohon, $field);
 $formValue = data_get($dataSurat, $field);
 if (blank($pendudukValue) || blank($formValue)) return null;
 return trim(strtolower($pendudukValue)) === trim(strtolower($formValue));
 };
 @endphp

 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

 <div class="md:col-span-2">
 <small class="text-slate-500 block">Nomor Permohonan</small>
 <div class="request-detail-value request-number-text">{{ $permohonanSurat->nomor_permohonan }}</div>
 </div>

 <div>
 <small class="text-slate-500 block">Nomor Surat</small>
 <div class="request-detail-value">@if($permohonanSurat->nomor_surat){{ $permohonanSurat->nomor_surat }}@else<span class="text-slate-500">Belum diterbitkan</span>@endif</div>
 </div>

 <div>
 <small class="text-slate-500 block">Nomor KK</small>
 <div class="request-detail-value">{{ optional($pemohon)->no_kk ?? data_get($dataSurat, 'no_kk') ?? '-' }}</div>
 </div>

 <div>
 <small class="text-slate-500 block">Nama Lengkap</small>
 <div class="request-detail-value">{{ optional($pemohon)->nama_lengkap ?? data_get($dataSurat, 'nama_lengkap') ?? '-' }}</div>
 @if($pemohon)
 @php $match = $compare('nama_lengkap'); @endphp
 @if($match === true)
 <div class="mt-1"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Nama Cocok</span></div>
 @elseif($match === false)
 <div class="mt-1"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">Nama Beda</span></div>
 @endif
 @endif
 </div>

 <div>
 <small class="text-slate-500 block">NIK</small>
 <div class="request-detail-value">{{ optional($pemohon)->nik ?? data_get($dataSurat, 'nik') ?? '-' }}</div>
 </div>

 <div>
 <small class="text-slate-500 block">Jenis Surat</small>
 <div>{{ optional($permohonanSurat->jenisSurat)->nama ?? '-' }}</div>
 </div>

 <div>
 <small class="text-slate-500 block">Tanggal Permohonan</small>
 <div>{{ $permohonanSurat->tanggal_permohonan->translatedFormat('d F Y') }}</div>
 </div>

 <div>
 <small class="text-slate-500 block">Tempat Lahir</small>
 <div>{{ optional($pemohon)->tempat_lahir ?? data_get($dataSurat, 'tempat_lahir') ?? '-' }}</div>
 @if($pemohon)
 @php $match = $compare('tempat_lahir'); @endphp
 @if($match === true)
 <div class="mt-1"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Cocok</span></div>
 @elseif($match === false)
 <div class="mt-1"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">Beda</span></div>
 @endif
 @endif
 </div>

 <div>
 <small class="text-slate-500 block">Tanggal Lahir</small>
 <div>{{ optional($pemohon)->tanggal_lahir?->translatedFormat('d F Y') ?? data_get($dataSurat, 'tanggal_lahir') ?? '-' }}</div>
 </div>

 <div>
 <small class="text-slate-500 block">Jenis Kelamin</small>
 @php
 $rawGender = optional($pemohon)->jenis_kelamin ?? data_get($dataSurat, 'jenis_kelamin') ?? null;
 if ($rawGender === 'L') {
 $genderLabel = 'Laki-laki';
 } elseif ($rawGender === 'P') {
 $genderLabel = 'Perempuan';
 } else {
 $genderLabel = $rawGender ?? '-';
 }
 @endphp
 <div>{{ $genderLabel }}</div>
 </div>

 <div>
 <small class="text-slate-500 block">Agama</small>
 <div>{{ optional($pemohon)->agama ?? data_get($dataSurat, 'agama') ?? '-' }}</div>
 </div>

 <div>
 <small class="text-slate-500 block">Pekerjaan</small>
 <div>{{ optional($pemohon)->pekerjaan ?? data_get($dataSurat, 'pekerjaan') ?? '-' }}</div>
 </div>

 <div>
 <small class="text-slate-500 block">Telepon</small>
 <div>{{ optional($pemohon)->telepon ?? data_get($dataSurat, 'telepon') ?? '-' }}</div>
 </div>

 <div>
 <small class="text-slate-500 block">Pejabat Penandatangan</small>
 <div>
 @if($permohonanSurat->penandatangan)
 <strong>{{ $permohonanSurat->penandatangan->nama_lengkap }}</strong>
 <div class="text-slate-500 small">{{ $permohonanSurat->penandatangan->jabatan->nama }}</div>
 @else
 <span class="text-danger">Belum dipilih</span>
 @endif
 </div>
 </div>

 <div>
 <small class="text-slate-500 block">Status</small>
 <div><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-{{ str_replace('text-', 'bg-', $permohonanSurat->status_badge_class) }} text-{{ $permohonanSurat->status_badge_class }} bg-opacity-20">{{ strtoupper($permohonanSurat->status) }}</span></div>
 </div>

 <div class="md:col-span-2">
 <small class="text-slate-500 block">Keperluan</small>
 <div class="border rounded-xl bg-slate-50 p-3">{!! nl2br(e($permohonanSurat->keperluan)) !!}</div>
 </div>

 <div class="md:col-span-2">
 <small class="text-slate-500 block">Alamat</small>
 <div class="border rounded-xl bg-slate-50 p-3">{{ optional($pemohon)->alamat ?? data_get($dataSurat, 'alamat') ?? '-' }}</div>
 </div>

 @if($isUsaha)
  <div class="md:col-span-2">
      <h6 class="font-semibold text-slate-800 mb-2 mt-4"><i class="fa-solid fa-store text-emerald-500 mr-2"></i>Detail Usaha</h6>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
              <small class="text-slate-500 block">Nama Usaha</small>
              <div class="font-medium">{{ data_get($dataSurat, 'nama_usaha', '-') }}</div>
          </div>
          <div>
              <small class="text-slate-500 block">Jenis Usaha</small>
              <div class="font-medium">{{ data_get($dataSurat, 'jenis_usaha', '-') }}</div>
          </div>
          <div class="md:col-span-2">
              <small class="text-slate-500 block">Alamat Usaha</small>
              <div class="font-medium">{{ data_get($dataSurat, 'alamat_usaha', '-') }}</div>
          </div>
          <div>
              <small class="text-slate-500 block">Lama Usaha</small>
              <div class="font-medium">{{ data_get($dataSurat, 'lama_usaha', '-') }}</div>
          </div>
          <div>
              <small class="text-slate-500 block">Keterangan Usaha</small>
              <div class="font-medium">{{ data_get($dataSurat, 'keterangan_usaha', '-') }}</div>
          </div>
      </div>
  </div>
  @else
 <div class="md:col-span-2">
 <small class="text-slate-500 block">Alamat Asal</small>
 <div class="border rounded-xl bg-slate-50 p-3">{{ data_get($dataSurat, 'alamat_asal') ?? '-' }}</div>
 </div>

 <div>
 <small class="text-slate-500 block">RT / RW</small>
 <div>{{ data_get($dataSurat, 'rt', '-') }} / {{ data_get($dataSurat, 'rw', '-') }}</div>
 </div>

 <div>
 <small class="text-slate-500 block">Lama Tinggal</small>
 <div>{{ data_get($dataSurat, 'lama_tinggal', '-') }}</div>
 </div>

 <div>
 <small class="text-slate-500 block">Status Tempat Tinggal</small>
 <div>{{ data_get($dataSurat, 'status_tempat_tinggal', '-') }}</div>
 </div>
 @endif

 <div class="w-full px-3 mt-2">
 <h6 class="mb-2">Dokumen Unggahan</h6>
 <div class="flex gap-2 flex-wrap">
 @php
 $files = [
 'dokumen_ktp' => 'KTP',
 'dokumen_kk' => 'KK',
 'dokumen_surat_pengantar' => 'Surat Pengantar RT/RW',
 ];
 @endphp

 @foreach($files as $field => $label)
 @if(!empty($dataSurat[$field]))
 <a href="{{ asset('storage/' . $dataSurat[$field]) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all !px-3 !py-1.5 !text-xs text-primary-600 border border-primary-600 hover:bg-primary-50 focus:outline-none active:scale-95 cursor-pointer" target="_blank" rel="noopener">Lihat {{ $label }}</a>
 @else
 <span class="text-slate-500 small">{{ $label }}: Belum diunggah</span>
 @endif
 @endforeach
 </div>
 </div>

 <div class="w-full px-3 mt-3">
 <small class="text-slate-500 block">Catatan Petugas</small>
 @if(!empty($permohonanSurat->catatan))
 <div class="border rounded-xl p-3 bg-amber-100 text-amber-700 bg-opacity-10">{!! nl2br(e($permohonanSurat->catatan)) !!}</div>
 @else
 <div class="text-slate-500">Tidak ada catatan.</div>
 @endif
 </div>

 </div>

 </div>

</div>
