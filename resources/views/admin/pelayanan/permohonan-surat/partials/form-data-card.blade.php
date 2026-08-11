<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

 <div class="px-6 py-4 border-b border-slate-200 bg-white flex items-center">

 <i class="fa-solid fa-file-lines-fill text-primary mr-2"></i>

 <div>

 <h5 class="mb-0 font-semibold">
 Data Formulir Publik
 </h5>

 <small class="text-slate-500">
 Semua data yang diisi oleh masyarakat melalui website.
 </small>

 </div>

 </div>

 <div class="p-6">

 @php
 $dataSurat = $permohonanSurat->data_surat ?? [];
 @endphp

 @if(empty($dataSurat))
 <div class="text-center py-8">
 <i class="fa-solid fa-exclamation-circle text-secondary "></i>
 <h6 class="mt-3 mb-2">Tidak ada data formulir publik</h6>
 <p class="text-slate-500 mb-0">Warga belum mengisi data melalui website.</p>
 </div>
 @else
 @php
 $pemohon = $permohonanSurat->penduduk;
 $compare = function ($field) use ($pemohon, $dataSurat) {
 if (!$pemohon) {
 return null;
 }

 $pendudukValue = data_get($pemohon, $field);
 $formValue = data_get($dataSurat, $field);

 if (blank($pendudukValue) || blank($formValue)) {
 return null;
 }

 return trim(strtolower($pendudukValue)) === trim(strtolower($formValue));
 };
 @endphp

 @if($pemohon)
 <div class="p-4 mb-4 text-sm text-sky-800 rounded-xl bg-sky-50 border border-sky-200 border-0 mb-6">
 <div class="flex items-center gap-3">
 <i class="fa-solid fa-shield-check "></i>
 <div>
 <strong>Verifikasi Dokumen</strong>
 <p class="mb-0 text-slate-500">Bandingkan data formulir dengan data KTP/KK dan dokumen pengantar yang diunggah.</p>
 </div>
 </div>
 </div>
 @else
 <div class="p-4 mb-4 text-sm text-amber-800 rounded-xl bg-amber-50 border border-amber-200 border-0 mb-6">
 <div class="flex items-center gap-3">
 <i class="fa-solid fa-exclamation-triangle "></i>
 <div>
 <strong>Belum terdaftar di database</strong>
 <p class="mb-0 text-slate-500">Penduduk belum ditemukan. Verifikasi manual dokumen lebih penting.</p>
 </div>
 </div>
 </div>
 @endif

 <div class="flex flex-wrap -mx-3 gy-3">
 <div class="w-full md:w-1/2 px-3">
 <small class="text-slate-500 block">Nama Lengkap</small>
 <div class="flex items-center gap-2">
 <span class="font-semibold">{{ data_get($dataSurat, 'nama_lengkap', '-') }}</span>
 @if($pemohon !== null)
 @php $match = $compare('nama_lengkap'); @endphp
 @if($match === true)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Cocok</span>
 @elseif($match === false)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">Beda</span>
 @endif
 @endif
 </div>
 </div>
 <div class="w-full md:w-1/2 px-3">
 <small class="text-slate-500 block">NIK</small>
 <div class="flex items-center gap-2">
 <span class="font-semibold">{{ data_get($dataSurat, 'nik', '-') }}</span>
 @if($pemohon !== null)
 @php $match = $compare('nik'); @endphp
 @if($match === true)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Cocok</span>
 @elseif($match === false)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">Beda</span>
 @endif
 @endif
 </div>
 </div>
 <div class="w-full md:w-1/2 px-3">
 <small class="text-slate-500 block">Tempat Lahir</small>
 <div class="flex items-center gap-2">
 <span>{{ data_get($dataSurat, 'tempat_lahir', '-') }}</span>
 @if($pemohon !== null)
 @php $match = $compare('tempat_lahir'); @endphp
 @if($match === true)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Cocok</span>
 @elseif($match === false)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">Beda</span>
 @endif
 @endif
 </div>
 </div>
 <div class="w-full md:w-1/2 px-3">
 <small class="text-slate-500 block">Tanggal Lahir</small>
 <div class="flex items-center gap-2">
 <span>{{ data_get($dataSurat, 'tanggal_lahir', '-') }}</span>
 @if($pemohon !== null)
 @php $match = $compare('tanggal_lahir'); @endphp
 @if($match === true)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Cocok</span>
 @elseif($match === false)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">Beda</span>
 @endif
 @endif
 </div>
 </div>
 <div class="w-full md:w-1/2 px-3">
 <small class="text-slate-500 block">Jenis Kelamin</small>
 <div class="flex items-center gap-2">
 @gender(data_get($dataSurat, 'jenis_kelamin'))
 @if($pemohon !== null)
 @php $match = $compare('jenis_kelamin'); @endphp
 @if($match === true)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Cocok</span>
 @elseif($match === false)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">Beda</span>
 @endif
 @endif
 </div>
 </div>
 <div class="w-full md:w-1/2 px-3">
 <small class="text-slate-500 block">Agama</small>
 <div class="flex items-center gap-2">
 <span>{{ data_get($dataSurat, 'agama', '-') }}</span>
 @if($pemohon !== null)
 @php $match = $compare('agama'); @endphp
 @if($match === true)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Cocok</span>
 @elseif($match === false)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">Beda</span>
 @endif
 @endif
 </div>
 </div>
 <div class="w-full md:w-1/2 px-3">
 <small class="text-slate-500 block">Pekerjaan</small>
 <div class="flex items-center gap-2">
 <span>{{ data_get($dataSurat, 'pekerjaan', '-') }}</span>
 @if($pemohon !== null)
 @php $match = $compare('pekerjaan'); @endphp
 @if($match === true)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Cocok</span>
 @elseif($match === false)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">Beda</span>
 @endif
 @endif
 </div>
 </div>
 <div class="w-full md:w-1/2 px-3">
 <small class="text-slate-500 block">Telepon</small>
 <div class="flex items-center gap-2">
 <span>{{ data_get($dataSurat, 'telepon', '-') }}</span>
 @if($pemohon !== null)
 @php $match = $compare('telepon'); @endphp
 @if($match === true)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Cocok</span>
 @elseif($match === false)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">Beda</span>
 @endif
 @endif
 </div>
 </div>
 <div class="w-full md:w-1/3 px-3">
 <small class="text-slate-500 block">RT</small>
 <div class="flex items-center gap-2">
 <span>{{ data_get($dataSurat, 'rt', '-') }}</span>
 @if($pemohon !== null)
 @php $match = $compare('rt'); @endphp
 @if($match === true)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Cocok</span>
 @elseif($match === false)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">Beda</span>
 @endif
 @endif
 </div>
 </div>
 <div class="w-full md:w-1/3 px-3">
 <small class="text-slate-500 block">RW</small>
 <div class="flex items-center gap-2">
 <span>{{ data_get($dataSurat, 'rw', '-') }}</span>
 @if($pemohon !== null)
 @php $match = $compare('rw'); @endphp
 @if($match === true)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Cocok</span>
 @elseif($match === false)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">Beda</span>
 @endif
 @endif
 </div>
 </div>
 <div class="w-full md:w-1/3 px-3">
 <small class="text-slate-500 block">Lama Tinggal</small>
 <div class="flex items-center gap-2">
 <span>{{ data_get($dataSurat, 'lama_tinggal', '-') }}</span>
 @if($pemohon !== null)
 @php $match = $compare('lama_tinggal'); @endphp
 @if($match === true)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Cocok</span>
 @elseif($match === false)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">Beda</span>
 @endif
 @endif
 </div>
 </div>
 <div class="w-full md:w-1/2 px-3">
 <small class="text-slate-500 block">Status Tempat Tinggal</small>
 <div class="flex items-center gap-2">
 <span>{{ data_get($dataSurat, 'status_tempat_tinggal', '-') }}</span>
 @if($pemohon !== null)
 @php $match = $compare('status_tempat_tinggal'); @endphp
 @if($match === true)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Cocok</span>
 @elseif($match === false)
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">Beda</span>
 @endif
 @endif
 </div>
 </div>
 <div class="w-full px-3">
 <small class="text-slate-500 block">Alamat Asal</small>
 <div class="border rounded-3 p-3 bg-light">{{ data_get($dataSurat, 'alamat_asal', '-') }}</div>
 </div>
 <div class="w-full px-3">
 <small class="text-slate-500 block">Alamat Domisili</small>
 <div class="border rounded-3 p-3 bg-light">{{ data_get($dataSurat, 'alamat', '-') }}</div>
 </div>
 </div>

 <div class="mt-6">
 <h6 class="mb-4">Dokumen Upload</h6>
 <div class="flex flex-wrap -mx-3 gy-3">
 @php
 $files = [
 'dokumen_ktp' => 'KTP',
 'dokumen_kk' => 'KK',
 'dokumen_surat_pengantar' => 'Surat Pengantar RT/RW',
 ];
 @endphp

 @foreach($files as $field => $label)
 <div class="w-full px-3">
 <small class="text-slate-500 block">{{ $label }}</small>
 @if(!empty($dataSurat[$field]))
 <a href="{{ asset('storage/' . $dataSurat[$field]) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all !px-3 !py-1.5 !text-xs text-primary-600 border border-primary-600 hover:bg-primary-50" target="_blank" rel="noopener">
 Lihat {{ $label }}
 </a>
 @else
 <span class="text-slate-500">Belum diunggah</span>
 @endif
 </div>
 @endforeach
 </div>
 </div>
 @endif

 </div>

</div>
