<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

    <div class="px-6 py-4 border-b border-slate-200 bg-white border-0 request-detail-card-header text-start">

        <h5 class="mb-0 request-detail-card-title">
            Detail Permohonan
        </h5>

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

        <div class="flex flex-wrap -mx-3 gy-3">

            <div class="w-full px-3">
                <small class="text-slate-500 d-block">Nomor Permohonan</small>
                <div class="request-detail-value request-number-text">{{ $permohonanSurat->nomor_permohonan }}</div>
            </div>

            <div class="w-full md:w-1/2 px-3">
                <small class="text-slate-500 d-block">Nomor Surat</small>
                <div class="request-detail-value">@if($permohonanSurat->nomor_surat){{ $permohonanSurat->nomor_surat }}@else<span class="text-slate-500">Belum diterbitkan</span>@endif</div>
            </div>

            <div class="w-full md:w-1/2 px-3">
                <small class="text-slate-500 d-block">Nomor KK</small>
                <div class="request-detail-value">{{ optional($pemohon)->no_kk ?? data_get($dataSurat, 'no_kk') ?? '-' }}</div>
            </div>

            <div class="w-full md:w-1/2 px-3">
                <small class="text-slate-500 d-block">Nama Lengkap</small>
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

            <div class="w-full md:w-1/2 px-3">
                <small class="text-slate-500 d-block">NIK</small>
                <div class="request-detail-value">{{ optional($pemohon)->nik ?? data_get($dataSurat, 'nik') ?? '-' }}</div>
            </div>

            <div class="w-full md:w-1/2 px-3">
                <small class="text-slate-500 d-block">Jenis Surat</small>
                <div>{{ $permohonanSurat->jenisSurat->nama }}</div>
            </div>

            <div class="w-full md:w-1/2 px-3">
                <small class="text-slate-500 d-block">Tanggal Permohonan</small>
                <div>{{ $permohonanSurat->tanggal_permohonan->translatedFormat('d F Y') }}</div>
            </div>

            <div class="w-full md:w-1/2 px-3">
                <small class="text-slate-500 d-block">Tempat Lahir</small>
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

            <div class="w-full md:w-1/2 px-3">
                <small class="text-slate-500 d-block">Tanggal Lahir</small>
                <div>{{ optional($pemohon)->tanggal_lahir?->translatedFormat('d F Y') ?? data_get($dataSurat, 'tanggal_lahir') ?? '-' }}</div>
            </div>

            <div class="w-full md:w-1/2 px-3">
                <small class="text-slate-500 d-block">Jenis Kelamin</small>
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

            <div class="w-full md:w-1/2 px-3">
                <small class="text-slate-500 d-block">Agama</small>
                <div>{{ optional($pemohon)->agama ?? data_get($dataSurat, 'agama') ?? '-' }}</div>
            </div>

            <div class="w-full md:w-1/2 px-3">
                <small class="text-slate-500 d-block">Pekerjaan</small>
                <div>{{ optional($pemohon)->pekerjaan ?? data_get($dataSurat, 'pekerjaan') ?? '-' }}</div>
            </div>

            <div class="w-full md:w-1/2 px-3">
                <small class="text-slate-500 d-block">Telepon</small>
                <div>{{ optional($pemohon)->telepon ?? data_get($dataSurat, 'telepon') ?? '-' }}</div>
            </div>

            <div class="w-full md:w-1/2 px-3">
                <small class="text-slate-500 d-block">Pejabat Penandatangan</small>
                <div>
                    @if($permohonanSurat->penandatangan)
                        <strong>{{ $permohonanSurat->penandatangan->nama_lengkap }}</strong>
                        <div class="text-slate-500 small">{{ $permohonanSurat->penandatangan->jabatan->nama }}</div>
                    @else
                        <span class="text-danger">Belum dipilih</span>
                    @endif
                </div>
            </div>

            <div class="w-full md:w-1/2 px-3">
                <small class="text-slate-500 d-block">Status</small>
                <div><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold rounded-pill px-3 py-2 bg-{{ $permohonanSurat->status_badge_class }}">{{ strtoupper($permohonanSurat->status) }}</span></div>
            </div>

            <div class="w-full px-3">
                <small class="text-slate-500 d-block">Keperluan</small>
                <div class="border rounded-3 bg-light p-3">{!! nl2br(e($permohonanSurat->keperluan)) !!}</div>
            </div>

            <div class="w-full px-3">
                <small class="text-slate-500 d-block">Alamat</small>
                <div class="border rounded-3 bg-light p-3">{{ optional($pemohon)->alamat ?? data_get($dataSurat, 'alamat') ?? '-' }}</div>
            </div>

            @unless($isUsaha)
                <div class="w-full px-3">
                    <small class="text-slate-500 d-block">Alamat Asal</small>
                    <div class="border rounded-3 bg-light p-3">{{ data_get($dataSurat, 'alamat_asal') ?? '-' }}</div>
                </div>

                <div class="col-md-4">
                    <small class="text-slate-500 d-block">RT / RW</small>
                    <div>{{ data_get($dataSurat, 'rt', '-') }} / {{ data_get($dataSurat, 'rw', '-') }}</div>
                </div>

                <div class="col-md-4">
                    <small class="text-slate-500 d-block">Lama Tinggal</small>
                    <div>{{ data_get($dataSurat, 'lama_tinggal', '-') }}</div>
                </div>

                <div class="col-md-4">
                    <small class="text-slate-500 d-block">Status Tempat Tinggal</small>
                    <div>{{ data_get($dataSurat, 'status_tempat_tinggal', '-') }}</div>
                </div>
            @endunless

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
                            <a href="{{ asset('storage/' . $dataSurat[$field]) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all !px-3 !py-1.5 !text-xs text-primary-600 border border-primary-600 hover:bg-primary-50" target="_blank" rel="noopener">Lihat {{ $label }}</a>
                        @else
                            <span class="text-slate-500 small">{{ $label }}: Belum diunggah</span>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="w-full px-3 mt-3">
                <small class="text-slate-500 d-block">Catatan Petugas</small>
                @if(!empty($permohonanSurat->catatan))
                    <div class="border rounded-3 p-3 bg-amber-100 text-amber-700 bg-opacity-10">{!! nl2br(e($permohonanSurat->catatan)) !!}</div>
                @else
                    <div class="text-slate-500">Tidak ada catatan.</div>
                @endif
            </div>

        </div>

    </div>

</div>
