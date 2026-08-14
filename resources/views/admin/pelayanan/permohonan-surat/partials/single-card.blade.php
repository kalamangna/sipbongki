@php
    $pendudukAsli = $permohonanSurat->penduduk;
    $pemohon = $permohonanSurat->pemohon;
    $dataSurat = $permohonanSurat->data_surat ?? [];
    $isUsaha = $permohonanSurat->jenisSurat?->isUsaha() ?? false;
    $isDomisili = $permohonanSurat->jenisSurat?->isDomisili() ?? false;
    $isKematian = $permohonanSurat->jenisSurat?->isKematian() ?? false;
    $isOrangSama = $permohonanSurat->jenisSurat?->isOrangSama() ?? false;

    $compare = function ($field) use ($pendudukAsli, $dataSurat) {
        if (!$pendudukAsli) return null;
        $pendudukValue = data_get($pendudukAsli, $field);
        $formValue = data_get($dataSurat, $field);
        if (blank($pendudukValue) || blank($formValue)) return null;
        return trim(strtolower($pendudukValue)) === trim(strtolower($formValue));
    };
    
    $hasVal = fn($v) => filled($v) && trim((string)$v) !== '-' && trim((string)$v) !== '';
@endphp

{{-- 1. INFORMASI SURAT --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-primary-50 flex items-center justify-center text-primary-600">
                <i class="fa-solid fa-file-lines"></i>
            </div>
            <h3 class="font-bold text-slate-800">Informasi Surat</h3>
        </div>
        <div class="text-xs font-mono font-semibold text-slate-600">
            #{{ $permohonanSurat->nomor_permohonan }}
        </div>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Jenis Surat</p>
                <p class="font-bold text-primary-700 text-base">{{ optional($permohonanSurat->jenisSurat)->nama ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Tanggal Permohonan</p>
                <p class="font-medium text-slate-900 text-base">{{ $permohonanSurat->tanggal_permohonan->translatedFormat('d F Y') }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Nomor Surat</p>
                <p class="font-medium text-slate-900 text-base">
                    @if($permohonanSurat->nomor_surat)
                        {{ $permohonanSurat->nomor_surat }}
                    @else
                        <span class="text-slate-400 italic text-sm">Belum diterbitkan</span>
                    @endif
                </p>
            </div>
            <div class="sm:col-span-2">
                <p class="text-xs font-semibold text-slate-500 mb-1">Keperluan</p>
                <p class="font-medium text-slate-900 text-base leading-relaxed">{!! nl2br(e($permohonanSurat->keperluan)) !!}</p>
            </div>
        </div>
    </div>
</div>

{{-- 2. DATA PEMOHON --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-slate-100 flex flex-wrap items-center justify-between gap-2">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-sky-50 flex items-center justify-center text-sky-600">
                <i class="fa-solid fa-user"></i>
            </div>
            <h3 class="font-bold text-slate-800">Data Pemohon</h3>
        </div>
        <div>
            @if($pendudukAsli)
                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    Penduduk Bongki
                </span>
            @else
                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                    Penduduk Luar
                </span>
            @endif
        </div>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
            @php
                $noKk = data_get($pemohon, 'kartuKeluarga.no_kk') ?? data_get($pemohon, 'no_kk') ?? data_get($dataSurat, 'no_kk');
            @endphp
            @if($hasVal($noKk) || $pendudukAsli)
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Nomor KK</p>
                <p class="font-medium text-slate-900 text-base">{{ $noKk ?: '-' }}</p>
            </div>
            @endif
            
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">NIK</p>
                <p class="font-mono font-medium text-slate-900 text-base">{{ optional($pemohon)->nik ?? data_get($dataSurat, 'nik') ?? '-' }}</p>
            </div>

            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Nama Lengkap</p>
                <p class="font-bold text-slate-900 text-base">{{ optional($pemohon)->nama_lengkap ?? data_get($dataSurat, 'nama_lengkap') ?? '-' }}</p>
                @if($pendudukAsli)
                    @php $match = $compare('nama_lengkap'); @endphp
                    @if($match === true)
                        <div class="mt-1"><span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 tracking-wide uppercase">Nama Cocok</span></div>
                    @elseif($match === false)
                        <div class="mt-1"><span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700 tracking-wide uppercase">Nama Beda</span></div>
                    @endif
                @endif
            </div>

            @php
                $tempatLahir = optional($pemohon)->tempat_lahir ?? data_get($dataSurat, 'tempat_lahir');
                $tglLahir = optional($pemohon)->tanggal_lahir ?? data_get($dataSurat, 'tanggal_lahir');
                $tglFormatted = '-';
                if ($tglLahir) {
                    try {
                        $tglFormatted = \Carbon\Carbon::parse($tglLahir)->translatedFormat('d F Y');
                    } catch (\Exception $e) {
                        $tglFormatted = $tglLahir;
                    }
                }
            @endphp
            @if($hasVal($tempatLahir) || $hasVal($tglLahir) || $pendudukAsli)
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Tempat, Tanggal Lahir</p>
                <p class="font-medium text-slate-900 text-base">{{ $tempatLahir ?: '-' }}, {{ $tglFormatted }}</p>
                @if($pendudukAsli)
                    @php 
                        $matchTL = $compare('tempat_lahir'); 
                        $matchTGL = $compare('tanggal_lahir'); 
                    @endphp
                    @if($matchTL === false || $matchTGL === false)
                        <div class="mt-1"><span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700 tracking-wide uppercase">Beda</span></div>
                    @endif
                @endif
            </div>
            @endif

            @php
                $rawGender = optional($pemohon)->jenis_kelamin ?? data_get($dataSurat, 'jenis_kelamin') ?? null;
                $genderLabel = $rawGender === 'L' ? 'Laki-laki' : ($rawGender === 'P' ? 'Perempuan' : $rawGender);
            @endphp
            @if($hasVal($genderLabel) || $pendudukAsli)
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Jenis Kelamin</p>
                <p class="font-medium text-slate-900 text-base">{{ $genderLabel ?: '-' }}</p>
            </div>
            @endif

            @php $agamaVal = optional($pemohon)->agama ?? data_get($dataSurat, 'agama'); @endphp
            @if($hasVal($agamaVal) || $pendudukAsli)
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Agama</p>
                <p class="font-medium text-slate-900 text-base">{{ $agamaVal ?: '-' }}</p>
            </div>
            @endif

            @php $pekerjaanVal = optional($pemohon)->pekerjaan ?? data_get($dataSurat, 'pekerjaan'); @endphp
            @if($hasVal($pekerjaanVal) || $pendudukAsli)
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Pekerjaan</p>
                <p class="font-medium text-slate-900 text-base">{{ $pekerjaanVal ?: '-' }}</p>
            </div>
            @endif

            @php $teleponVal = optional($pemohon)->telepon ?? data_get($dataSurat, 'telepon'); @endphp
            @if($hasVal($teleponVal) || $pendudukAsli)
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Telepon</p>
                <p class="font-medium text-slate-900 text-base">{{ $teleponVal ?: '-' }}</p>
            </div>
            @endif

            @php $statusPerkawinanVal = optional($pemohon)->status_perkawinan ?? data_get($dataSurat, 'status_perkawinan'); @endphp
            @if($hasVal($statusPerkawinanVal))
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Status Perkawinan</p>
                <p class="font-medium text-slate-900 text-base">{{ $statusPerkawinanVal }}</p>
            </div>
            @endif

            @php $pendidikanVal = optional($pemohon)->pendidikan ?? data_get($dataSurat, 'pendidikan'); @endphp
            @if($hasVal($pendidikanVal))
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Pendidikan</p>
                <p class="font-medium text-slate-900 text-base">{{ $pendidikanVal }}</p>
            </div>
            @endif

            @php
                $rtVal = optional($pemohon)->rt ?? data_get($dataSurat, 'rt');
                $rwVal = optional($pemohon)->rw ?? data_get($dataSurat, 'rw');
            @endphp
            @if(($hasVal($rtVal) || $hasVal($rwVal)) && !$isDomisili)
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">RT / RW</p>
                <p class="font-medium text-slate-900 text-base">{{ $rtVal ?: '-' }} / {{ $rwVal ?: '-' }}</p>
            </div>
            @endif

            <div class="sm:col-span-2">
                <p class="text-xs font-semibold text-slate-500 mb-1">Alamat Lengkap</p>
                <p class="font-medium text-slate-900 text-base leading-relaxed">{{ optional($pemohon)->alamat ?? data_get($dataSurat, 'alamat') ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>

{{-- 3. DETAIL KHUSUS SURAT --}}
@if($isUsaha || $isDomisili || $isKematian || $isOrangSama)
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
        @if($isUsaha)
            <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600">
                <i class="fa-solid fa-store"></i>
            </div>
            <h3 class="font-bold text-slate-800">Detail Usaha</h3>
        @elseif($isDomisili)
            <div class="w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600">
                <i class="fa-solid fa-map-location-dot"></i>
            </div>
            <h3 class="font-bold text-slate-800">Detail Domisili</h3>
        @elseif($isKematian)
            <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-600">
                <i class="fa-solid fa-book-skull"></i>
            </div>
            <h3 class="font-bold text-slate-800">Detail Kematian</h3>
        @elseif($isOrangSama)
            <div class="w-8 h-8 rounded-full bg-purple-50 flex items-center justify-center text-purple-600">
                <i class="fa-solid fa-users-viewfinder"></i>
            </div>
            <h3 class="font-bold text-slate-800">Detail Orang Yang Sama</h3>
        @endif
    </div>
    <div class="p-6">
        @if($isUsaha)
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">Nama Usaha</p>
                    <p class="font-bold text-slate-900 text-base">{{ data_get($dataSurat, 'nama_usaha', '-') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">Jenis Usaha</p>
                    <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'jenis_usaha', '-') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">Lama Usaha</p>
                    <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'lama_usaha', '-') }}</p>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-xs font-semibold text-slate-500 mb-1">Alamat Usaha</p>
                    <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'alamat_usaha', '-') }}</p>
                </div>
                @if(filled(data_get($dataSurat, 'keterangan_usaha')))
                <div class="sm:col-span-2">
                    <p class="text-xs font-semibold text-slate-500 mb-1">Keterangan Tambahan</p>
                    <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'keterangan_usaha') }}</p>
                </div>
                @endif
            </div>
        @elseif($isDomisili)
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                @if(filled(data_get($dataSurat, 'alamat_asal')))
                <div class="sm:col-span-2">
                    <p class="text-xs font-semibold text-slate-500 mb-1">Alamat Asal</p>
                    <p class="font-medium text-slate-900 text-base leading-relaxed">{{ data_get($dataSurat, 'alamat_asal') }}</p>
                </div>
                @endif
                @if(filled(data_get($dataSurat, 'rt')) || filled(data_get($dataSurat, 'rw')))
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">RT / RW Domisili</p>
                    <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'rt', '-') }} / {{ data_get($dataSurat, 'rw', '-') }}</p>
                </div>
                @endif
                @if(filled(data_get($dataSurat, 'lama_tinggal')))
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">Lama Tinggal</p>
                    <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'lama_tinggal') }}</p>
                </div>
                @endif
                @if(filled(data_get($dataSurat, 'status_tempat_tinggal')))
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">Status Tempat Tinggal</p>
                    <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'status_tempat_tinggal') }}</p>
                </div>
                @endif
            </div>
        @elseif($isKematian)
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">Waktu Meninggal</p>
                    <p class="font-medium text-slate-900 text-base">
                        {{ data_get($dataSurat, 'hari_meninggal', '-') }}, 
                        {{ data_get($dataSurat, 'tanggal_meninggal') ? \Carbon\Carbon::parse(data_get($dataSurat, 'tanggal_meninggal'))->translatedFormat('d F Y') : '-' }} 
                        {{ data_get($dataSurat, 'jam_meninggal') ? 'Jam ' . data_get($dataSurat, 'jam_meninggal') : '' }}
                    </p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">Tempat Meninggal</p>
                    <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'tempat_meninggal', '-') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">Penyebab Kematian</p>
                    <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'penyebab_kematian', '-') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">Hubungan Pelapor</p>
                    <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'hubungan_pelapor', '-') }}</p>
                </div>
                @if(optional($permohonanSurat)->pelapor)
                <div class="sm:col-span-2">
                    <p class="text-xs font-semibold text-slate-500 mb-1">Nama Pelapor</p>
                    <p class="font-medium text-slate-900 text-base">{{ $permohonanSurat->pelapor->nama_lengkap }} (NIK: {{ $permohonanSurat->pelapor->nik }})</p>
                </div>
                @endif
            </div>
        @elseif($isOrangSama)
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">Nama Lain</p>
                    <p class="font-bold text-slate-900 text-base">{{ data_get($dataSurat, 'nama_lain', '-') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">Jenis Dokumen Pembanding</p>
                    <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'jenis_dokumen', '-') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">Nomor Dokumen</p>
                    <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'nomor_dokumen', '-') }}</p>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-xs font-semibold text-slate-500 mb-1">Keterangan Perbedaan</p>
                    <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'keterangan_perbedaan', '-') }}</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endif

{{-- 4. LAMPIRAN DOKUMEN --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
        <div class="w-8 h-8 rounded-full bg-rose-50 flex items-center justify-center text-rose-600">
            <i class="fa-solid fa-file-pdf"></i>
        </div>
        <h3 class="font-bold text-slate-800">Lampiran Dokumen</h3>
    </div>
    <div class="p-6">
        <div class="flex flex-wrap gap-3">
            @php
                $files = [
                    'dokumen_ktp' => 'KTP',
                    'dokumen_kk' => 'Kartu Keluarga',
                    'dokumen_surat_pengantar' => 'Surat Pengantar RT/RW',
                ];
                if ($isUsaha) {
                    $files['dokumen_tempat_usaha'] = 'Foto Tempat Usaha';
                }
            @endphp

            @foreach($files as $field => $label)
                @if(!empty($dataSurat[$field]))
                    <a href="{{ asset('storage/' . $dataSurat[$field]) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-primary-200 text-primary-700 hover:bg-primary-50 shadow-sm transition-all focus:outline-none" target="_blank" rel="noopener">
                        <i class="fa-solid fa-file-pdf"></i> Lihat {{ $label }}
                    </a>
                @else
                    <span class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-xl bg-slate-50 border border-slate-200 text-slate-500">
                        <i class="fa-solid fa-file-circle-xmark"></i> {{ $label }} Belum Diunggah
                    </span>
                @endif
            @endforeach
        </div>
    </div>
</div>
