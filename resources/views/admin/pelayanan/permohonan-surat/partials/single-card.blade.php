<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
        <div class="w-8 h-8 rounded-full bg-primary-50 flex items-center justify-center text-primary-600">
            <i class="fa-solid fa-file-lines"></i>
        </div>
        <h3 class="font-bold text-slate-800">Detail Permohonan</h3>
    </div>
    <div class="p-6">
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

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
            <div class="sm:col-span-2">
                <p class="text-xs font-semibold text-slate-500 mb-1">Nomor Permohonan</p>
                <p class="text-2xl font-mono font-bold text-slate-900">{{ $permohonanSurat->nomor_permohonan }}</p>
            </div>
            
            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Nomor Surat</p>
                <p class="font-medium text-slate-900 text-base">
                    @if($permohonanSurat->nomor_surat)
                        {{ $permohonanSurat->nomor_surat }}
                    @else
                        <span class="text-slate-400 italic font-normal">Belum diterbitkan</span>
                    @endif
                </p>
            </div>

            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Nomor KK</p>
                <p class="font-medium text-slate-900 text-base">{{ optional($pemohon)->no_kk ?? data_get($dataSurat, 'no_kk') ?? '-' }}</p>
            </div>

            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Nama Lengkap</p>
                <p class="font-bold text-slate-900 text-base">{{ optional($pemohon)->nama_lengkap ?? data_get($dataSurat, 'nama_lengkap') ?? '-' }}</p>
                @if($pemohon)
                    @php $match = $compare('nama_lengkap'); @endphp
                    @if($match === true)
                        <div class="mt-1.5"><span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 tracking-wide uppercase">Nama Cocok</span></div>
                    @elseif($match === false)
                        <div class="mt-1.5"><span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700 tracking-wide uppercase">Nama Beda</span></div>
                    @endif
                @endif
            </div>

            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">NIK</p>
                <p class="font-mono font-medium text-slate-900 text-base">{{ optional($pemohon)->nik ?? data_get($dataSurat, 'nik') ?? '-' }}</p>
            </div>

            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Jenis Surat</p>
                <p class="font-medium text-slate-900 text-base">{{ optional($permohonanSurat->jenisSurat)->nama ?? '-' }}</p>
            </div>

            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Tanggal Permohonan</p>
                <p class="font-medium text-slate-900 text-base">{{ $permohonanSurat->tanggal_permohonan->translatedFormat('d F Y') }}</p>
            </div>

            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Tempat, Tanggal Lahir</p>
                <p class="font-medium text-slate-900 text-base">
                    {{ optional($pemohon)->tempat_lahir ?? data_get($dataSurat, 'tempat_lahir') ?? '-' }}, {{ optional($pemohon)->tanggal_lahir?->translatedFormat('d F Y') ?? data_get($dataSurat, 'tanggal_lahir') ?? '-' }}
                </p>
                @if($pemohon)
                    @php 
                        $matchTL = $compare('tempat_lahir'); 
                        $matchTGL = $compare('tanggal_lahir'); 
                    @endphp
                    @if($matchTL === false || $matchTGL === false)
                        <div class="mt-1.5"><span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700 tracking-wide uppercase">Beda</span></div>
                    @endif
                @endif
            </div>

            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Jenis Kelamin</p>
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
                <p class="font-medium text-slate-900 text-base">{{ $genderLabel }}</p>
            </div>

            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Agama</p>
                <p class="font-medium text-slate-900 text-base">{{ optional($pemohon)->agama ?? data_get($dataSurat, 'agama') ?? '-' }}</p>
            </div>

            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Pekerjaan</p>
                <p class="font-medium text-slate-900 text-base">{{ optional($pemohon)->pekerjaan ?? data_get($dataSurat, 'pekerjaan') ?? '-' }}</p>
            </div>

            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Telepon</p>
                <p class="font-medium text-slate-900 text-base">{{ optional($pemohon)->telepon ?? data_get($dataSurat, 'telepon') ?? '-' }}</p>
            </div>

            <div>
                <p class="text-xs font-semibold text-slate-500 mb-1">Pejabat Penandatangan</p>
                <div>
                    @if($permohonanSurat->penandatangan)
                        <p class="font-bold text-slate-900 text-base mb-0.5">{{ $permohonanSurat->penandatangan->nama_lengkap }}</p>
                        <p class="text-xs text-slate-500">{{ $permohonanSurat->penandatangan->jabatan->nama }}</p>
                    @else
                        <span class="text-rose-500 italic font-normal text-base">Belum dipilih</span>
                    @endif
                </div>
            </div>

            <div class="sm:col-span-2">
                <p class="text-xs font-semibold text-slate-500 mb-1">Status</p>
                <div>
                    @php
                        $statusColors = [
                            'menunggu' => 'bg-amber-100 text-amber-700',
                            'diproses' => 'bg-sky-100 text-sky-700',
                            'selesai' => 'bg-emerald-100 text-emerald-700',
                            'ditolak' => 'bg-rose-100 text-rose-700',
                        ];
                        $colorClass = $statusColors[strtolower($permohonanSurat->status)] ?? 'bg-slate-100 text-slate-700';
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold tracking-wide {{ $colorClass }} uppercase">
                        {{ $permohonanSurat->status }}
                    </span>
                </div>
            </div>

            <div class="sm:col-span-2">
                <p class="text-xs font-semibold text-slate-500 mb-1">Keperluan</p>
                <div class="font-medium text-slate-900 text-base leading-relaxed">{!! nl2br(e($permohonanSurat->keperluan)) !!}</div>
            </div>

            <div class="sm:col-span-2">
                <p class="text-xs font-semibold text-slate-500 mb-1">Alamat</p>
                <div class="font-medium text-slate-900 text-base leading-relaxed">{{ optional($pemohon)->alamat ?? data_get($dataSurat, 'alamat') ?? '-' }}</div>
            </div>

            @if($isUsaha)
                <div class="sm:col-span-2 mt-4 pt-6 border-t border-slate-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600">
                            <i class="fa-solid fa-store"></i>
                        </div>
                        <h3 class="font-bold text-slate-800">Detail Usaha</h3>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">Nama Usaha</p>
                            <p class="font-bold text-slate-900 text-base">{{ data_get($dataSurat, 'nama_usaha', '-') }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">Jenis Usaha</p>
                            <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'jenis_usaha', '-') }}</p>
                        </div>
                        <div class="sm:col-span-2">
                            <p class="text-xs font-semibold text-slate-500 mb-1">Alamat Usaha</p>
                            <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'alamat_usaha', '-') }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">Lama Usaha</p>
                            <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'lama_usaha', '-') }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">Keterangan Usaha</p>
                            <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'keterangan_usaha', '-') }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="sm:col-span-2 mt-4 pt-6 border-t border-slate-100">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                        <div class="sm:col-span-2">
                            <p class="text-xs font-semibold text-slate-500 mb-1">Alamat Asal</p>
                            <p class="font-medium text-slate-900 text-base leading-relaxed">{{ data_get($dataSurat, 'alamat_asal') ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">RT / RW</p>
                            <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'rt', '-') }} / {{ data_get($dataSurat, 'rw', '-') }}</p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">Lama Tinggal</p>
                            <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'lama_tinggal', '-') }}</p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-1">Status Tempat Tinggal</p>
                            <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'status_tempat_tinggal', '-') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="sm:col-span-2 mt-4 pt-6 border-t border-slate-100">
                <p class="text-xs font-semibold text-slate-500 mb-3">Dokumen Unggahan</p>
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
                            <a href="{{ asset('storage/' . $dataSurat[$field]) }}" class="inline-flex items-center justify-center gap-2 px-3 py-1.5 text-xs font-semibold rounded-xl bg-white border border-primary-200 text-primary-700 hover:bg-primary-50 transition-all shadow-sm active:scale-95 focus:outline-none" target="_blank" rel="noopener">
                                <i class="fa-solid fa-file-pdf"></i> Lihat {{ $label }}
                            </a>
                        @else
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 text-xs font-medium rounded-xl bg-slate-50 text-slate-500 border border-slate-100">
                                <i class="fa-solid fa-file-circle-xmark"></i> {{ $label }}: Belum diunggah
                            </span>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="sm:col-span-2 mt-4 pt-6 border-t border-slate-100">
                <p class="text-xs font-semibold text-slate-500 mb-2">Catatan Petugas</p>
                @if(!empty($permohonanSurat->catatan))
                    <div class="rounded-xl p-4 bg-amber-50 border border-amber-100 text-amber-800 text-sm leading-relaxed">{!! nl2br(e($permohonanSurat->catatan)) !!}</div>
                @else
                    <div class="text-slate-400 text-sm italic">Tidak ada catatan.</div>
                @endif
            </div>

        </div>
    </div>
</div>
