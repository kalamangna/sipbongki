<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
        <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600">
            <i class="fa-solid fa-list-check"></i>
        </div>
        <h3 class="font-bold text-slate-800">Data Formulir Publik</h3>
    </div>
    
    <div class="p-6">
        @php
            $dataSurat = $permohonanSurat->data_surat ?? [];
        @endphp

        @if(empty($dataSurat))
            <div class="text-center py-8">
                <i class="fa-solid fa-circle-exclamation text-4xl text-slate-300 mb-4 block"></i>
                <h6 class="font-bold text-slate-700 mb-1">Tidak ada data formulir publik</h6>
                <p class="text-sm text-slate-500 mb-0">Warga belum mengisi data melalui website.</p>
            </div>
        @else
            @php
                $pemohon = $permohonanSurat->penduduk;
                $compare = function ($field) use ($pemohon, $dataSurat) {
                    if (!$pemohon) return null;
                    $pendudukValue = data_get($pemohon, $field);
                    $formValue = data_get($dataSurat, $field);
                    if (blank($pendudukValue) || blank($formValue)) return null;
                    return trim(strtolower($pendudukValue)) === trim(strtolower($formValue));
                };
            @endphp

            @if($pemohon)
                <div class="p-4 mb-6 rounded-xl bg-sky-50 border border-sky-100">
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-shield-check text-sky-600 mt-0.5 text-lg"></i>
                        <div>
                            <strong class="text-sm text-sky-800 block mb-0.5">Verifikasi Dokumen</strong>
                            <p class="text-sm text-sky-700 mb-0">Bandingkan data formulir dengan data KTP/KK dan dokumen pengantar yang diunggah.</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="p-4 mb-6 rounded-xl bg-amber-50 border border-amber-100">
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-triangle-exclamation text-amber-600 mt-0.5 text-lg"></i>
                        <div>
                            <strong class="text-sm text-amber-800 block mb-0.5">Belum terdaftar di database</strong>
                            <p class="text-sm text-amber-700 mb-0">Penduduk belum ditemukan. Verifikasi manual dokumen lebih penting.</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">Nama Lengkap</p>
                    <div class="flex flex-wrap items-center gap-2">
                        <p class="font-bold text-slate-900 text-base">{{ data_get($dataSurat, 'nama_lengkap', '-') }}</p>
                        @if($pemohon !== null)
                            @php $match = $compare('nama_lengkap'); @endphp
                            @if($match === true)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 tracking-wide uppercase">Cocok</span>
                            @elseif($match === false)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700 tracking-wide uppercase">Beda</span>
                            @endif
                        @endif
                    </div>
                </div>

                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">NIK</p>
                    <div class="flex flex-wrap items-center gap-2">
                        <p class="font-mono font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'nik', '-') }}</p>
                        @if($pemohon !== null)
                            @php $match = $compare('nik'); @endphp
                            @if($match === true)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 tracking-wide uppercase">Cocok</span>
                            @elseif($match === false)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700 tracking-wide uppercase">Beda</span>
                            @endif
                        @endif
                    </div>
                </div>

                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">Tempat Lahir</p>
                    <div class="flex flex-wrap items-center gap-2">
                        <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'tempat_lahir', '-') }}</p>
                        @if($pemohon !== null)
                            @php $match = $compare('tempat_lahir'); @endphp
                            @if($match === true)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 tracking-wide uppercase">Cocok</span>
                            @elseif($match === false)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700 tracking-wide uppercase">Beda</span>
                            @endif
                        @endif
                    </div>
                </div>

                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">Tanggal Lahir</p>
                    <div class="flex flex-wrap items-center gap-2">
                        @php
                            $tglSurat = data_get($dataSurat, 'tanggal_lahir');
                            $tglSuratFormatted = '-';
                            if ($tglSurat) {
                                try {
                                    $tglSuratFormatted = \Carbon\Carbon::parse($tglSurat)->translatedFormat('d F Y');
                                } catch (\Exception $e) {
                                    $tglSuratFormatted = $tglSurat;
                                }
                            }
                        @endphp
                        <p class="font-medium text-slate-900 text-base">{{ $tglSuratFormatted }}</p>
                        @if($pemohon !== null)
                            @php $match = $compare('tanggal_lahir'); @endphp
                            @if($match === true)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 tracking-wide uppercase">Cocok</span>
                            @elseif($match === false)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700 tracking-wide uppercase">Beda</span>
                            @endif
                        @endif
                    </div>
                </div>

                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">Jenis Kelamin</p>
                    <div class="flex flex-wrap items-center gap-2">
                        <p class="font-medium text-slate-900 text-base">
                            @php
                                $jk = data_get($dataSurat, 'jenis_kelamin');
                                if($jk === 'L') echo 'Laki-laki';
                                elseif($jk === 'P') echo 'Perempuan';
                                else echo $jk ?? '-';
                            @endphp
                        </p>
                        @if($pemohon !== null)
                            @php $match = $compare('jenis_kelamin'); @endphp
                            @if($match === true)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 tracking-wide uppercase">Cocok</span>
                            @elseif($match === false)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700 tracking-wide uppercase">Beda</span>
                            @endif
                        @endif
                    </div>
                </div>

                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">Agama</p>
                    <div class="flex flex-wrap items-center gap-2">
                        <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'agama', '-') }}</p>
                        @if($pemohon !== null)
                            @php $match = $compare('agama'); @endphp
                            @if($match === true)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 tracking-wide uppercase">Cocok</span>
                            @elseif($match === false)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700 tracking-wide uppercase">Beda</span>
                            @endif
                        @endif
                    </div>
                </div>

                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">Pekerjaan</p>
                    <div class="flex flex-wrap items-center gap-2">
                        <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'pekerjaan', '-') }}</p>
                        @if($pemohon !== null)
                            @php $match = $compare('pekerjaan'); @endphp
                            @if($match === true)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 tracking-wide uppercase">Cocok</span>
                            @elseif($match === false)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700 tracking-wide uppercase">Beda</span>
                            @endif
                        @endif
                    </div>
                </div>

                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">Telepon</p>
                    <div class="flex flex-wrap items-center gap-2">
                        <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'telepon', '-') }}</p>
                        @if($pemohon !== null)
                            @php $match = $compare('telepon'); @endphp
                            @if($match === true)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 tracking-wide uppercase">Cocok</span>
                            @elseif($match === false)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700 tracking-wide uppercase">Beda</span>
                            @endif
                        @endif
                    </div>
                </div>

                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">RT</p>
                    <div class="flex flex-wrap items-center gap-2">
                        <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'rt', '-') }}</p>
                        @if($pemohon !== null)
                            @php $match = $compare('rt'); @endphp
                            @if($match === true)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 tracking-wide uppercase">Cocok</span>
                            @elseif($match === false)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700 tracking-wide uppercase">Beda</span>
                            @endif
                        @endif
                    </div>
                </div>

                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">RW</p>
                    <div class="flex flex-wrap items-center gap-2">
                        <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'rw', '-') }}</p>
                        @if($pemohon !== null)
                            @php $match = $compare('rw'); @endphp
                            @if($match === true)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 tracking-wide uppercase">Cocok</span>
                            @elseif($match === false)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700 tracking-wide uppercase">Beda</span>
                            @endif
                        @endif
                    </div>
                </div>
                
                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">Lama Tinggal</p>
                    <div class="flex flex-wrap items-center gap-2">
                        <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'lama_tinggal', '-') }}</p>
                        @if($pemohon !== null)
                            @php $match = $compare('lama_tinggal'); @endphp
                            @if($match === true)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 tracking-wide uppercase">Cocok</span>
                            @elseif($match === false)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700 tracking-wide uppercase">Beda</span>
                            @endif
                        @endif
                    </div>
                </div>

                <div>
                    <p class="text-xs font-semibold text-slate-500 mb-1">Status Tempat Tinggal</p>
                    <div class="flex flex-wrap items-center gap-2">
                        <p class="font-medium text-slate-900 text-base">{{ data_get($dataSurat, 'status_tempat_tinggal', '-') }}</p>
                        @if($pemohon !== null)
                            @php $match = $compare('status_tempat_tinggal'); @endphp
                            @if($match === true)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 tracking-wide uppercase">Cocok</span>
                            @elseif($match === false)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700 tracking-wide uppercase">Beda</span>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <p class="text-xs font-semibold text-slate-500 mb-1">Alamat Asal</p>
                    <p class="font-medium text-slate-900 text-base leading-relaxed">{{ data_get($dataSurat, 'alamat_asal', '-') }}</p>
                </div>

                <div class="sm:col-span-2">
                    <p class="text-xs font-semibold text-slate-500 mb-1">Alamat Domisili</p>
                    <p class="font-medium text-slate-900 text-base leading-relaxed">{{ data_get($dataSurat, 'alamat', '-') }}</p>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-slate-100">
                <p class="text-xs font-semibold text-slate-500 mb-3">Dokumen Unggahan</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @php
                        $files = [
                            'dokumen_ktp' => 'KTP',
                            'dokumen_kk' => 'KK',
                            'dokumen_surat_pengantar' => 'Surat Pengantar RT/RW',
                        ];
                    @endphp

                    @foreach($files as $field => $label)
                        <div class="sm:col-span-2">
                            <p class="text-xs font-semibold text-slate-500 mb-1">{{ $label }}</p>
                            @if(!empty($dataSurat[$field]))
                                <a href="{{ asset('storage/' . $dataSurat[$field]) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-primary-200 text-primary-700 hover:bg-primary-50 transition-all shadow-sm focus:outline-none active:scale-95" target="_blank" rel="noopener">
                                    <i class="fa-solid fa-file-pdf"></i> Lihat {{ $label }}
                                </a>
                            @else
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 text-xs font-medium rounded-xl bg-slate-50 text-slate-500 border border-slate-100">
                                    <i class="fa-solid fa-file-circle-xmark"></i> Belum diunggah
                                </span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
