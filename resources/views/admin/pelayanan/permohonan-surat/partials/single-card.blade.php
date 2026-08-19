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
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6 dark:bg-slate-900 dark:border-slate-800">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between dark:border-slate-800">
        <h3 class="font-bold text-slate-800 dark:text-slate-100">Informasi Surat</h3>
        <div class="text-xs font-mono font-semibold text-slate-600 dark:text-slate-400">
            #{{ $permohonanSurat->nomor_permohonan }}
        </div>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Jenis Surat</p>
                <p class="font-bold text-primary-700 text-base dark:text-primary-400">{{ optional($permohonanSurat->jenisSurat)->nama ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Tanggal Permohonan</p>
                <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $permohonanSurat->tanggal_permohonan->translatedFormat('d F Y') }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Nomor Surat</p>
                <p class="font-medium text-slate-900 text-base dark:text-slate-100">
                    @if($permohonanSurat->nomor_surat)
                        {{ $permohonanSurat->nomor_surat }}
                    @else
                        <span class="text-slate-400 italic text-sm dark:text-slate-500">Belum diterbitkan</span>
                    @endif
                </p>
            </div>
            <div class="sm:col-span-2">
                <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Keperluan</p>
                <p class="font-medium text-slate-900 text-base leading-relaxed dark:text-slate-100">{!! nl2br(e($permohonanSurat->keperluan)) !!}</p>
            </div>
        </div>
    </div>
</div>

{{-- 2. DATA PEMOHON --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6 dark:bg-slate-900 dark:border-slate-800">
    <div class="px-6 py-4 border-b border-slate-100 flex flex-wrap items-center justify-between gap-2 dark:border-slate-800">
        <h3 class="font-bold text-slate-800 dark:text-slate-100">Data Pemohon</h3>
        <div class="flex items-center gap-2">
            @if($pendudukAsli)
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 ring-1 ring-emerald-500/30 dark:bg-emerald-950/60 dark:text-emerald-300 dark:ring-emerald-800/40">
                    <i class="fa-solid fa-circle-check text-[10px] text-emerald-600 dark:text-emerald-400"></i>
                    Penduduk Bongki
                </span>
                @if(optional($pemohon)->aktif === false || optional($pemohon)->aktif === 0)
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-100 text-rose-800 ring-1 ring-rose-500/30 dark:bg-rose-950/60 dark:text-rose-300 dark:ring-rose-800/40">
                        <i class="fa-solid fa-circle-exclamation text-[10px] text-rose-600 dark:text-rose-400"></i>
                        Perlu Verifikasi
                    </span>
                @endif
            @else
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-900 ring-1 ring-amber-500/30 dark:bg-amber-950/60 dark:text-amber-300 dark:ring-amber-800/40">
                    <i class="fa-solid fa-circle-info text-[10px] text-amber-600 dark:text-amber-400"></i>
                    Penduduk Luar Bongki
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
                <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Nomor KK</p>
                <p class="font-mono font-medium text-slate-900 text-base dark:text-slate-100">{{ $noKk ?: '-' }}</p>
            </div>
            @endif
            
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">NIK</p>
                <p class="font-mono font-medium text-slate-900 text-base dark:text-slate-100">{{ optional($pemohon)->nik ?? data_get($dataSurat, 'nik') ?? '-' }}</p>
            </div>

            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Nama Lengkap</p>
                <p class="font-bold text-slate-900 text-base dark:text-slate-100">{{ optional($pemohon)->nama_lengkap ?? data_get($dataSurat, 'nama_lengkap') ?? '-' }}</p>
                @if($pendudukAsli)
                    @php $match = $compare('nama_lengkap'); @endphp
                    @if($match === true)
                        <div class="mt-1"><span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 tracking-wide uppercase dark:bg-emerald-950/60 dark:text-emerald-300">Nama Cocok</span></div>
                    @elseif($match === false)
                        <div class="mt-1"><span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700 tracking-wide uppercase dark:bg-rose-950/60 dark:text-rose-300">Nama Beda</span></div>
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
                <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Tempat, Tanggal Lahir</p>
                <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $tempatLahir ?: '-' }}, {{ $tglFormatted }}</p>
                @if($pendudukAsli)
                    @php 
                        $matchTL = $compare('tempat_lahir'); 
                        $matchTGL = $compare('tanggal_lahir'); 
                    @endphp
                    @if($matchTL === false || $matchTGL === false)
                        <div class="mt-1"><span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700 tracking-wide uppercase dark:bg-rose-950/60 dark:text-rose-300">Beda</span></div>
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
                <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Jenis Kelamin</p>
                <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $genderLabel ?: '-' }}</p>
            </div>
            @endif

            @php $agamaVal = optional($pemohon)->agama ?? data_get($dataSurat, 'agama'); @endphp
            @if($hasVal($agamaVal) || $pendudukAsli)
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Agama</p>
                <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $agamaVal ?: '-' }}</p>
            </div>
            @endif

            @php $pekerjaanVal = optional($pemohon)->pekerjaan ?? data_get($dataSurat, 'pekerjaan'); @endphp
            @if($hasVal($pekerjaanVal) || $pendudukAsli)
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Pekerjaan</p>
                <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $pekerjaanVal ?: '-' }}</p>
            </div>
            @endif

            @php $teleponVal = optional($pemohon)->telepon ?? data_get($dataSurat, 'telepon'); @endphp
            @if($hasVal($teleponVal) || $pendudukAsli)
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Telepon</p>
                <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $teleponVal ?: '-' }}</p>
            </div>
            @endif

            @php $statusPerkawinanVal = optional($pemohon)->status_perkawinan ?? data_get($dataSurat, 'status_perkawinan'); @endphp
            @if($hasVal($statusPerkawinanVal))
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Status Perkawinan</p>
                <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $statusPerkawinanVal }}</p>
            </div>
            @endif

            @php $pendidikanVal = optional($pemohon)->pendidikan ?? data_get($dataSurat, 'pendidikan'); @endphp
            @if($hasVal($pendidikanVal))
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Pendidikan</p>
                <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $pendidikanVal }}</p>
            </div>
            @endif

            @php
                $rtVal = optional($pemohon)->rt ?? data_get($dataSurat, 'rt');
                $rwVal = optional($pemohon)->rw ?? data_get($dataSurat, 'rw');
            @endphp
            @if(($hasVal($rtVal) || $hasVal($rwVal)) && !$isDomisili)
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">RT / RW</p>
                <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $rtVal ?: '-' }} / {{ $rwVal ?: '-' }}</p>
            </div>
            @endif

            <div class="sm:col-span-2">
                <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Alamat Lengkap</p>
                <p class="font-medium text-slate-900 text-base leading-relaxed dark:text-slate-100">{{ optional($pemohon)->alamat ?? data_get($dataSurat, 'alamat') ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>

{{-- 3. DETAIL KHUSUS SURAT --}}
@if($isUsaha || $isDomisili || $isKematian || $isOrangSama)
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6 dark:bg-slate-900 dark:border-slate-800">
    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800">
        @if($isUsaha)
            <h3 class="font-bold text-slate-800 dark:text-slate-100">Detail Usaha</h3>
        @elseif($isDomisili)
            <h3 class="font-bold text-slate-800 dark:text-slate-100">Detail Domisili</h3>
        @elseif($isKematian)
            <h3 class="font-bold text-slate-800 dark:text-slate-100">Detail Kematian</h3>
        @elseif($isOrangSama)
            <h3 class="font-bold text-slate-800 dark:text-slate-100">Detail Orang Yang Sama</h3>
        @endif
    </div>
    <div class="p-6">
        @if($isUsaha)
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Nama Usaha</p>
                    <p class="font-bold text-slate-900 text-base dark:text-slate-100">{{ data_get($dataSurat, 'nama_usaha', '-') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Jenis Usaha</p>
                    <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ data_get($dataSurat, 'jenis_usaha', '-') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Lama Usaha</p>
                    <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ data_get($dataSurat, 'lama_usaha', '-') }}</p>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Alamat Usaha</p>
                    <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ data_get($dataSurat, 'alamat_usaha', '-') }}</p>
                </div>
                @if(filled(data_get($dataSurat, 'keterangan_usaha')))
                <div class="sm:col-span-2">
                    <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Keterangan Tambahan</p>
                    <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ data_get($dataSurat, 'keterangan_usaha') }}</p>
                </div>
                @endif
            </div>
        @elseif($isDomisili)
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                @if(filled(data_get($dataSurat, 'alamat_asal')))
                <div class="sm:col-span-2">
                    <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Alamat Asal</p>
                    <p class="font-medium text-slate-900 text-base leading-relaxed dark:text-slate-100">{{ data_get($dataSurat, 'alamat_asal') }}</p>
                </div>
                @endif
                @if(filled(data_get($dataSurat, 'rt')) || filled(data_get($dataSurat, 'rw')))
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">RT / RW Domisili</p>
                    <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ data_get($dataSurat, 'rt', '-') }} / {{ data_get($dataSurat, 'rw', '-') }}</p>
                </div>
                @endif
                @if(filled(data_get($dataSurat, 'lama_tinggal')))
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Lama Tinggal</p>
                    <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ data_get($dataSurat, 'lama_tinggal') }}</p>
                </div>
                @endif
                @if(filled(data_get($dataSurat, 'status_tempat_tinggal')))
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Status Tempat Tinggal</p>
                    <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ data_get($dataSurat, 'status_tempat_tinggal') }}</p>
                </div>
                @endif
            </div>
        @elseif($isKematian)
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Waktu Meninggal</p>
                    <p class="font-medium text-slate-900 text-base dark:text-slate-100">
                        {{ data_get($dataSurat, 'hari_meninggal', '-') }}, 
                        {{ data_get($dataSurat, 'tanggal_meninggal') ? \Carbon\Carbon::parse(data_get($dataSurat, 'tanggal_meninggal'))->translatedFormat('d F Y') : '-' }} 
                        {{ data_get($dataSurat, 'jam_meninggal') ? 'Jam ' . data_get($dataSurat, 'jam_meninggal') : '' }}
                    </p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Tempat Meninggal</p>
                    <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ data_get($dataSurat, 'tempat_meninggal', '-') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Penyebab Kematian</p>
                    <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ data_get($dataSurat, 'penyebab_kematian', '-') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Hubungan Pelapor</p>
                    <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ data_get($dataSurat, 'hubungan_pelapor', '-') }}</p>
                </div>
                @if(optional($permohonanSurat)->pelapor)
                <div class="sm:col-span-2">
                    <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Nama Pelapor</p>
                    <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ $permohonanSurat->pelapor->nama_lengkap }} (NIK: {{ $permohonanSurat->pelapor->nik }})</p>
                </div>
                @endif
            </div>
        @elseif($isOrangSama)
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Nama Lain</p>
                    <p class="font-bold text-slate-900 text-base dark:text-slate-100">{{ data_get($dataSurat, 'nama_lain', '-') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Jenis Dokumen Pembanding</p>
                    <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ data_get($dataSurat, 'jenis_dokumen', '-') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Nomor Dokumen</p>
                    <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ data_get($dataSurat, 'nomor_dokumen', '-') }}</p>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">Keterangan Perbedaan</p>
                    <p class="font-medium text-slate-900 text-base dark:text-slate-100">{{ data_get($dataSurat, 'keterangan_perbedaan', '-') }}</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endif

{{-- 4. LAMPIRAN DOKUMEN --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6 dark:bg-slate-900 dark:border-slate-800">
    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800">
        <h3 class="font-bold text-slate-800 dark:text-slate-100">Lampiran Dokumen</h3>
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
                    <a href="{{ route('admin.permohonan-surat.document', [$permohonanSurat, $field]) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-primary-200 text-primary-700 hover:bg-primary-50 shadow-sm transition-all focus:outline-none dark:bg-slate-800 dark:border-primary-800/60 dark:text-primary-400 dark:hover:bg-slate-700" target="_blank" rel="noopener">
                        <i class="fa-solid fa-file-pdf"></i> Lihat {{ $label }}
                    </a>
                @else
                    <span class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-xl bg-slate-50 border border-slate-200 text-slate-500 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-500">
                        <i class="fa-solid fa-file-circle-xmark"></i> {{ $label }} Belum Diunggah
                    </span>
                @endif
            @endforeach
        </div>
    </div>
</div>
