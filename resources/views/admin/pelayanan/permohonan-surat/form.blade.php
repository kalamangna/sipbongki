{{-- 1. INFORMASI UTAMA & PEMOHON --}}
<div class="mb-8">
    <div class="pb-3 border-b border-slate-100 flex items-center gap-2.5 mb-5">
        <div class="w-7 h-7 rounded-lg bg-primary-50 text-primary flex items-center justify-center text-xs">
            <i class="fa-solid fa-file-lines"></i>
        </div>
        <h3 class="font-bold text-slate-800 text-sm tracking-tight">Informasi Utama & Pemohon</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        {{-- Jenis Surat --}}
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                Jenis Surat <span class="text-red-500">*</span>
            </label>
            <select
                name="jenis_surat_id"
                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-3.5 py-2.5 transition-colors shadow-sm {{ isset($permohonanSurat) ? 'pointer-events-none opacity-80 bg-slate-100' : '' }}"
                {{ isset($permohonanSurat) ? 'tabindex="-1"' : '' }}
                required>
                <option value="">-- Pilih Jenis Surat --</option>
                @foreach($jenisSurats as $jenis)
                    <option value="{{ $jenis->id }}" @selected(old('jenis_surat_id', $permohonanSurat->jenis_surat_id ?? '') == $jenis->id)>
                        {{ $jenis->nama }}
                    </option>
                @endforeach
            </select>
            @error('jenis_surat_id')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tanggal Permohonan --}}
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                Tanggal Permohonan <span class="text-red-500">*</span>
            </label>
            <input
                type="date"
                name="tanggal_permohonan"
                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-3.5 py-2.5 transition-colors shadow-sm"
                value="{{ old('tanggal_permohonan', isset($permohonanSurat) ? $permohonanSurat->tanggal_permohonan->format('Y-m-d') : date('Y-m-d')) }}"
                required>
            @error('tanggal_permohonan')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>

        @if(isset($permohonanSurat))
            @php
                $penduduk = $permohonanSurat->penduduk;
                $dataSurat = $permohonanSurat->data_surat ?? [];
                $isManual = empty($permohonanSurat->penduduk_id) || !$penduduk;
            @endphp

            {{-- MODE EDIT: TAMPILAN SUMBER DATA PEMOHON --}}
            <div class="md:col-span-2" id="pemohon-container">
                @if(!$isManual && $penduduk)
                    <input type="hidden" name="penduduk_id" value="{{ $penduduk->id }}">
                    <input type="hidden" name="jenis_pemohon" value="terdaftar">

                    {{-- PENDUDUK BONGKI --}}
                    <div class="bg-slate-50/70 border border-slate-200/90 rounded-xl p-4 shadow-sm">
                        <div class="flex flex-wrap items-center justify-between gap-2 mb-3 pb-2.5 border-b border-slate-200/80">
                            <span class="text-xs font-bold text-slate-700">Identitas Pemohon (Penduduk Bongki)</span>
                            <div>
                                @if($penduduk->aktif)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <i class="fa-solid fa-circle-check mr-1.5 text-emerald-500"></i> Terdaftar
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-sky-50 text-sky-700 border border-sky-200">
                                        <i class="fa-solid fa-clock mr-1.5 text-sky-500"></i> Belum Verifikasi
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 text-left">
                            <div class="bg-white p-3 rounded-lg border border-slate-200/80">
                                <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400 block mb-0.5">NIK</span>
                                <span class="font-mono font-bold text-slate-900 text-sm">{{ $penduduk->nik ?: ($dataSurat['manual_nik'] ?? '-') }}</span>
                            </div>
                            <div class="bg-white p-3 rounded-lg border border-slate-200/80 sm:col-span-2">
                                <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400 block mb-0.5">Nama Lengkap</span>
                                <span class="font-bold text-slate-900 text-sm">{{ $penduduk->nama_lengkap ?: ($dataSurat['manual_nama_lengkap'] ?? '-') }}</span>
                            </div>
                            <div class="bg-white p-3 rounded-lg border border-slate-200/80">
                                <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400 block mb-0.5">Jenis Kelamin</span>
                                @php $jk = $penduduk->jenis_kelamin ?: ($dataSurat['manual_jenis_kelamin'] ?? '-'); @endphp
                                <span class="font-medium text-slate-800 text-xs">{{ $jk === 'L' ? 'Laki-laki' : ($jk === 'P' ? 'Perempuan' : $jk) }}</span>
                            </div>
                            <div class="bg-white p-3 rounded-lg border border-slate-200/80">
                                <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400 block mb-0.5">Tempat, Tgl Lahir</span>
                                @php 
                                    $tglLahir = optional($penduduk->tanggal_lahir)->translatedFormat('d M Y') ?: ($dataSurat['manual_tanggal_lahir'] ?? '-');
                                    $tempatLahir = $penduduk->tempat_lahir ?: ($dataSurat['manual_tempat_lahir'] ?? '-');
                                @endphp
                                <span class="font-medium text-slate-800 text-xs">{{ $tempatLahir }}, {{ $tglLahir }}</span>
                            </div>
                            <div class="bg-white p-3 rounded-lg border border-slate-200/80">
                                <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400 block mb-0.5">No. Telepon / WA</span>
                                <span class="font-medium text-slate-800 text-xs">{{ $penduduk->telepon ?: ($dataSurat['telepon'] ?? ($dataSurat['manual_telepon'] ?? '-')) }}</span>
                            </div>
                            <div class="bg-white p-3 rounded-lg border border-slate-200/80 sm:col-span-3">
                                <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400 block mb-0.5">Alamat & Lingkungan</span>
                                <span class="font-medium text-slate-800 text-xs">
                                    {{ $penduduk->alamat ?: ($dataSurat['manual_alamat'] ?? '-') }} 
                                    @if($penduduk->lingkungan || !empty($penduduk->rt) || !empty($penduduk->rw))
                                        <span class="text-slate-500">(Lingkungan {{ optional($penduduk->lingkungan)->nama ?? '-' }}, RT {{ $penduduk->rt ?: ($dataSurat['manual_rt'] ?? '-') }} / RW {{ $penduduk->rw ?: ($dataSurat['manual_rw'] ?? '-') }})</span>
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="mt-3 flex items-center justify-between gap-3 pt-2.5 border-t border-slate-200/70 text-xs">
                            <span class="text-slate-500">
                                <i class="fa-solid fa-circle-info text-primary mr-1"></i> Data terhubung dengan master database kependudukan.
                            </span>
                            <a href="{{ route('admin.penduduk.edit', $penduduk->id) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 hover:text-primary hover:border-slate-300 shadow-sm transition-all">
                                <i class="fa-solid fa-user-pen text-slate-400"></i> Edit di Master Penduduk <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-slate-400"></i>
                            </a>
                        </div>
                    </div>

                @else
                    {{-- PENDUDUK LUAR BONGKI (MANUAL) --}}
                    <input type="hidden" name="jenis_pemohon" value="manual">

                    <div class="bg-amber-50/40 border border-amber-200/80 rounded-xl p-4 shadow-sm">
                        <div class="flex flex-wrap items-center justify-between gap-2 mb-3 pb-2.5 border-b border-amber-200/70">
                            <span class="text-xs font-bold text-slate-800">Identitas Pemohon (Warga Luar Bongki)</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 border border-amber-300">
                                <i class="fa-solid fa-location-dot mr-1.5 text-amber-600"></i> Pengisian Manual
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="manual_nama_lengkap" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3.5 py-2 focus:ring-2 focus:ring-primary focus:outline-none" value="{{ old('manual_nama_lengkap', $dataSurat['manual_nama_lengkap'] ?? '') }}" required>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">NIK <span class="text-red-500">*</span></label>
                                <input type="text" name="manual_nik" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3.5 py-2 focus:ring-2 focus:ring-primary focus:outline-none font-mono" value="{{ old('manual_nik', $dataSurat['manual_nik'] ?? '') }}" required>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Jenis Kelamin</label>
                                <select name="manual_jenis_kelamin" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3.5 py-2 focus:ring-2 focus:ring-primary focus:outline-none">
                                    <option value="">-- Pilih --</option>
                                    <option value="L" @selected(old('manual_jenis_kelamin', $dataSurat['manual_jenis_kelamin'] ?? '') == 'L')>Laki-laki</option>
                                    <option value="P" @selected(old('manual_jenis_kelamin', $dataSurat['manual_jenis_kelamin'] ?? '') == 'P')>Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Tempat, Tanggal Lahir</label>
                                <div class="grid grid-cols-2 gap-2">
                                    <input type="text" name="manual_tempat_lahir" placeholder="Tempat" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3 py-2 focus:ring-2 focus:ring-primary focus:outline-none" value="{{ old('manual_tempat_lahir', $dataSurat['manual_tempat_lahir'] ?? '') }}">
                                    <input type="date" name="manual_tanggal_lahir" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3 py-2 focus:ring-2 focus:ring-primary focus:outline-none" value="{{ old('manual_tanggal_lahir', $dataSurat['manual_tanggal_lahir'] ?? '') }}">
                                </div>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Alamat Asal Lengkap</label>
                                <textarea name="manual_alamat" rows="2" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3.5 py-2 focus:ring-2 focus:ring-primary focus:outline-none">{{ old('manual_alamat', $dataSurat['manual_alamat'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        @else
            {{-- MODE CREATE: PILIH SUMBER DATA PEMOHON --}}
            <div class="md:col-span-2" id="pemohon-container">
                <label class="block text-xs font-semibold text-slate-700 mb-2">
                    Sumber Data Pemohon <span class="text-red-500">*</span>
                </label>
                
                <div class="flex flex-wrap gap-4 mb-3">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="jenis_pemohon" value="terdaftar" class="text-primary focus:ring-primary" checked onchange="togglePemohonSource()">
                        <span class="ml-2 text-sm text-slate-700 font-medium">Penduduk Bongki</span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="jenis_pemohon" value="manual" class="text-primary focus:ring-primary" {{ old('jenis_pemohon') == 'manual' ? 'checked' : '' }} onchange="togglePemohonSource()">
                        <span class="ml-2 text-sm text-slate-700 font-medium">Penduduk Luar Bongki (Manual)</span>
                    </label>
                </div>

                <div id="pemohon-field">
                    <select id="penduduk_id" name="penduduk_id" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-3.5 py-2.5 transition-colors shadow-sm">
                        <option value="">-- Pilih Penduduk --</option>
                        @foreach($penduduks as $penduduk)
                            <option value="{{ $penduduk->id }}" @selected(old('penduduk_id') == $penduduk->id)>
                                {{ $penduduk->nik }} - {{ $penduduk->nama_lengkap }} ({{ optional($penduduk->lingkungan)->nama ?? 'Bongki' }})
                            </option>
                        @endforeach
                    </select>
                    @error('penduduk_id')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div id="manual-pemohon-fields" style="display: none;" class="bg-slate-50/70 p-4 rounded-xl border border-slate-200 mt-2 grid grid-cols-1 md:grid-cols-2 gap-3.5">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="manual_nama_lengkap" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3 py-2" value="{{ old('manual_nama_lengkap') }}">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">NIK</label>
                        <input type="text" name="manual_nik" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3 py-2 font-mono" value="{{ old('manual_nik') }}">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Jenis Kelamin</label>
                        <select name="manual_jenis_kelamin" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3 py-2">
                            <option value="">-- Pilih --</option>
                            <option value="L" @selected(old('manual_jenis_kelamin') == 'L')>Laki-laki</option>
                            <option value="P" @selected(old('manual_jenis_kelamin') == 'P')>Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Tempat, Tanggal Lahir</label>
                        <div class="grid grid-cols-2 gap-2">
                            <input type="text" name="manual_tempat_lahir" placeholder="Tempat" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3 py-2" value="{{ old('manual_tempat_lahir') }}">
                            <input type="date" name="manual_tanggal_lahir" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3 py-2" value="{{ old('manual_tanggal_lahir') }}">
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Alamat Asal Lengkap</label>
                        <textarea name="manual_alamat" rows="2" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3 py-2">{{ old('manual_alamat') }}</textarea>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- 2. FORM KHUSUS SPESIFIK JENIS SURAT --}}
{{-- Data Usaha (SKU) --}}
<div id="usaha-fields" class="mb-8" style="display:none;">
    <div class="pb-3 border-b border-slate-100 flex items-center gap-2.5 mb-5">
        <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs">
            <i class="fa-solid fa-store"></i>
        </div>
        <h3 class="font-bold text-slate-800 text-sm tracking-tight">Rincian Data Usaha</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Usaha <span class="text-red-500">*</span></label>
            <input type="text" name="nama_usaha" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-3.5 py-2.5 transition-colors shadow-sm" placeholder="Contoh: Kios Berkah Mandiri" value="{{ old('nama_usaha', $permohonanSurat->data_surat['nama_usaha'] ?? '') }}">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Jenis Usaha <span class="text-red-500">*</span></label>
            <input type="text" name="jenis_usaha" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-3.5 py-2.5 transition-colors shadow-sm" placeholder="Contoh: Perdagangan Sembako" value="{{ old('jenis_usaha', $permohonanSurat->data_surat['jenis_usaha'] ?? '') }}">
        </div>
        <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Tempat Usaha</label>
            <textarea name="alamat_usaha" rows="2" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-3.5 py-2.5 transition-colors shadow-sm" placeholder="Alamat lengkap lokasi usaha">{{ old('alamat_usaha', $permohonanSurat->data_surat['alamat_usaha'] ?? '') }}</textarea>
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Lama Usaha</label>
            <input type="text" name="lama_usaha" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-3.5 py-2.5 transition-colors shadow-sm" placeholder="Contoh: 3 Tahun" value="{{ old('lama_usaha', $permohonanSurat->data_surat['lama_usaha'] ?? '') }}">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Keterangan Usaha</label>
            <input type="text" name="keterangan_usaha" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-3.5 py-2.5 transition-colors shadow-sm" placeholder="Contoh: Usaha aktif / berkembang" value="{{ old('keterangan_usaha', $permohonanSurat->data_surat['keterangan_usaha'] ?? '') }}">
        </div>
    </div>
</div>

{{-- Data Kematian --}}
<div id="kematian-fields" class="mb-8" style="display:none;">
    <div class="pb-3 border-b border-slate-100 flex items-center gap-2.5 mb-5">
        <div class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center text-xs">
            <i class="fa-solid fa-ribbon"></i>
        </div>
        <h3 class="font-bold text-slate-800 text-sm tracking-tight">Rincian Kematian & Pelapor</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Almarhum / Almarhumah <span class="text-red-500">*</span></label>
            <select id="penduduk_id_kematian" name="almarhum_id" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-3.5 py-2.5 transition-colors shadow-sm">
                <option value="">-- Pilih Penduduk --</option>
                @foreach($penduduks as $p)
                    <option value="{{ $p->id }}" @selected(old('almarhum_id', $permohonanSurat->penduduk_id ?? '') == $p->id)>
                        {{ $p->nik }} - {{ $p->nama_lengkap }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Hari Meninggal <span class="text-red-500">*</span></label>
            <select name="hari_meninggal" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-3.5 py-2.5 transition-colors shadow-sm">
                <option value="">-- Pilih Hari --</option>
                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                    <option value="{{ $hari }}" @selected(old('hari_meninggal', $permohonanSurat->data_surat['hari_meninggal'] ?? '') == $hari)>{{ $hari }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tanggal Meninggal <span class="text-red-500">*</span></label>
            <input type="date" name="tanggal_meninggal" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-3.5 py-2.5 transition-colors shadow-sm" value="{{ old('tanggal_meninggal', $permohonanSurat->data_surat['tanggal_meninggal'] ?? '') }}">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Jam Meninggal</label>
            <input type="time" name="jam_meninggal" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-3.5 py-2.5 transition-colors shadow-sm" value="{{ old('jam_meninggal', $permohonanSurat->data_surat['jam_meninggal'] ?? '') }}">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tempat Meninggal <span class="text-red-500">*</span></label>
            <input type="text" name="tempat_meninggal" placeholder="Contoh: RSUD Sinjai / Rumah Duka" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-3.5 py-2.5 transition-colors shadow-sm" value="{{ old('tempat_meninggal', $permohonanSurat->data_surat['tempat_meninggal'] ?? '') }}">
        </div>
        <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Penyebab Kematian <span class="text-red-500">*</span></label>
            <input type="text" name="penyebab_kematian" placeholder="Contoh: Sakit / Lanjut Usia" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-3.5 py-2.5 transition-colors shadow-sm" value="{{ old('penyebab_kematian', $permohonanSurat->data_surat['penyebab_kematian'] ?? '') }}">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Pelapor <span class="text-red-500">*</span></label>
            <select id="pelapor_id" name="pelapor_id" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-3.5 py-2.5 transition-colors shadow-sm">
                <option value="">-- Pilih Penduduk Pelapor --</option>
                @foreach($penduduks as $p)
                    <option value="{{ $p->id }}" @selected(old('pelapor_id', $permohonanSurat->pelapor_id ?? '') == $p->id)>
                        {{ $p->nik }} - {{ $p->nama_lengkap }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Hubungan dengan Almarhum</label>
            <select name="hubungan_pelapor" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-3.5 py-2.5 transition-colors shadow-sm">
                <option value="">-- Pilih Hubungan --</option>
                @foreach(['Suami', 'Istri', 'Ayah', 'Ibu', 'Anak', 'Saudara', 'Keluarga', 'Tetangga', 'Lainnya'] as $hub)
                    <option value="{{ $hub }}" @selected(old('hubungan_pelapor', $permohonanSurat->data_surat['hubungan_pelapor'] ?? '') == $hub)>{{ $hub }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

{{-- Data Orang Yang Sama --}}
<div id="orang-sama-fields" class="mb-8" style="display:none;">
    <div class="pb-3 border-b border-slate-100 flex items-center gap-2.5 mb-5">
        <div class="w-7 h-7 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center text-xs">
            <i class="fa-solid fa-id-card-clip"></i>
        </div>
        <h3 class="font-bold text-slate-800 text-sm tracking-tight">Rincian Dokumen Orang Yang Sama</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Dalam Dokumen Lain <span class="text-red-500">*</span></label>
            <input type="text" name="nama_lain" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-3.5 py-2.5 transition-colors shadow-sm" placeholder="Contoh: ABDUL RAHMAN" value="{{ old('nama_lain', $permohonanSurat->data_surat['nama_lain'] ?? '') }}">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Jenis Dokumen <span class="text-red-500">*</span></label>
            <input type="text" name="jenis_dokumen" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-3.5 py-2.5 transition-colors shadow-sm" placeholder="Contoh: Ijazah / Sertifikat / Paspor" value="{{ old('jenis_dokumen', $permohonanSurat->data_surat['jenis_dokumen'] ?? '') }}">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor Dokumen <span class="text-red-500">*</span></label>
            <input type="text" name="nomor_dokumen" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-3.5 py-2.5 transition-colors shadow-sm" placeholder="Contoh: SHM No. 12345" value="{{ old('nomor_dokumen', $permohonanSurat->data_surat['nomor_dokumen'] ?? '') }}">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Keterangan Perbedaan</label>
            <input type="text" name="keterangan_perbedaan" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-3.5 py-2.5 transition-colors shadow-sm" placeholder="Contoh: Perbedaan ejaan huruf pada nama" value="{{ old('keterangan_perbedaan', $permohonanSurat->data_surat['keterangan_perbedaan'] ?? '') }}">
        </div>
    </div>
</div>

{{-- Data Domisili --}}
<div id="domisili-fields" class="mb-8" style="display:none;">
    <div class="pb-3 border-b border-slate-100 flex items-center gap-2.5 mb-5">
        <div class="w-7 h-7 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center text-xs">
            <i class="fa-solid fa-house-chimney-user"></i>
        </div>
        <h3 class="font-bold text-slate-800 text-sm tracking-tight">Rincian Domisili</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Lama Tinggal</label>
            <input type="text" name="lama_tinggal" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-3.5 py-2.5 transition-colors shadow-sm" placeholder="Contoh: 2 Tahun" value="{{ old('lama_tinggal', $permohonanSurat->data_surat['lama_tinggal'] ?? '') }}">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Status Tempat Tinggal</label>
            <select name="status_tempat_tinggal" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-3.5 py-2.5 transition-colors shadow-sm">
                <option value="">-- Pilih Status --</option>
                @foreach(['Milik Sendiri', 'Kontrak', 'Kos', 'Menumpang'] as $st)
                    <option value="{{ $st }}" @selected(old('status_tempat_tinggal', $permohonanSurat->data_surat['status_tempat_tinggal'] ?? '') == $st)>{{ $st }}</option>
                @endforeach
            </select>
        </div>
        <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Asal</label>
            <textarea name="alamat_asal" rows="2" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-3.5 py-2.5 transition-colors shadow-sm" placeholder="Alamat sebelum berdomisili">{{ old('alamat_asal', $permohonanSurat->data_surat['alamat_asal'] ?? '') }}</textarea>
        </div>
        <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Domisili di Bongki</label>
            <textarea name="alamat" rows="2" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 px-3.5 py-2.5 transition-colors shadow-sm" placeholder="Contoh: Jl. Sudirman No. 12, Lingkungan Lappa">{{ old('alamat', $permohonanSurat->data_surat['alamat'] ?? '') }}</textarea>
        </div>
    </div>
</div>

{{-- 3. INFORMASI PENANDATANGAN & KEPERLUAN --}}
<div class="mb-4">
    <div class="pb-3 border-b border-slate-100 flex items-center gap-2.5 mb-5">
        <div class="w-7 h-7 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center text-xs">
            <i class="fa-solid fa-signature"></i>
        </div>
        <h3 class="font-bold text-slate-800 text-sm tracking-tight">Penandatangan & Keperluan Surat</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        {{-- Penandatangan --}}
        <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                Pejabat Penandatangan <span class="text-red-500">*</span>
            </label>
            <select
                name="penandatangan_id"
                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-3.5 py-2.5 transition-colors shadow-sm"
                required>
                <option value="">-- Pilih Pejabat Penandatangan --</option>
                @php
                    $defaultPenandatanganId = $permohonanSurat->penandatangan_id ?? '';
                    if (empty($defaultPenandatanganId)) {
                        $lurah = $penandatangans->first(function($p) {
                            $jabatan = trim(strtolower($p->jabatan->nama ?? ''));
                            return $jabatan === 'lurah' || str_starts_with($jabatan, 'plt. lurah') || str_starts_with($jabatan, 'plt lurah');
                        });
                        $defaultPenandatanganId = $lurah ? $lurah->id : '';
                    }
                @endphp
                @foreach($penandatangans as $item)
                    <option value="{{ $item->id }}" @selected(old('penandatangan_id', $defaultPenandatanganId) == $item->id)>
                        {{ $item->nama_lengkap }} ({{ $item->jabatan->nama }})
                    </option>
                @endforeach
            </select>
            @error('penandatangan_id')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Keperluan --}}
        <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                Keperluan Surat <span class="text-red-500">*</span>
            </label>
            <textarea
                name="keperluan"
                rows="3"
                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-3.5 py-2.5 transition-colors shadow-sm"
                placeholder="Tuliskan keperluan penerbitan surat..."
                required>{{ old('keperluan', $permohonanSurat->keperluan ?? '') }}</textarea>
            @error('keperluan')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Catatan --}}
        <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                Catatan Internal (Opsional)
            </label>
            <textarea
                name="catatan"
                rows="2"
                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-3.5 py-2.5 transition-colors shadow-sm"
                placeholder="Catatan tambahan untuk permohonan ini...">{{ old('catatan', $permohonanSurat->catatan ?? '') }}</textarea>
            @error('catatan')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const jenisSurat = document.querySelector('select[name="jenis_surat_id"]');
    const usahaFields = document.getElementById('usaha-fields');
    const kematianFields = document.getElementById('kematian-fields');
    const orangSamaFields = document.getElementById('orang-sama-fields');
    const domisiliFields = document.getElementById('domisili-fields');
    const pemohonContainer = document.getElementById('pemohon-container');
    const pemohonField = document.getElementById('pemohon-field');
    const manualPemohonFields = document.getElementById('manual-pemohon-fields');
    const pemohonSelect = document.querySelector('select[name="penduduk_id"]');
    const almarhumSelect = document.getElementById('penduduk_id_kematian');

    window.togglePemohonSource = function() {
        const radio = document.querySelector('input[name="jenis_pemohon"]:checked');
        if (!radio || !pemohonField || !manualPemohonFields) return;
        const val = radio.value;
        if (val === 'manual') {
            pemohonField.style.display = 'none';
            manualPemohonFields.style.display = 'grid';
            if (pemohonSelect) pemohonSelect.required = false;
        } else {
            pemohonField.style.display = 'block';
            manualPemohonFields.style.display = 'none';
            if (pemohonSelect) pemohonSelect.required = true;
        }
    };

    function toggleFields() {
        if (!jenisSurat) return;
        const selectedText = jenisSurat.options[jenisSurat.selectedIndex]?.text.toLowerCase().trim() || '';

        // Reset semua field spesifik
        if (usahaFields) usahaFields.style.display = 'none';
        if (kematianFields) kematianFields.style.display = 'none';
        if (orangSamaFields) orangSamaFields.style.display = 'none';
        if (domisiliFields) domisiliFields.style.display = 'none';

        if (pemohonContainer) pemohonContainer.style.display = 'block';
        togglePemohonSource();

        if (almarhumSelect) almarhumSelect.required = false;

        // Surat Usaha
        if (selectedText.includes('usaha')) {
            if (usahaFields) usahaFields.style.display = 'block';
        }

        // Surat Orang Yang Sama
        if (selectedText.includes('orang yang sama')) {
            if (orangSamaFields) orangSamaFields.style.display = 'block';
        }

        // Surat Domisili
        if (selectedText.includes('domisili')) {
            if (domisiliFields) domisiliFields.style.display = 'block';
        }

        // Surat Kematian
        if (selectedText.includes('kematian')) {
            if (kematianFields) kematianFields.style.display = 'block';
            if (pemohonContainer) pemohonContainer.style.display = 'none';
            if (pemohonSelect) pemohonSelect.required = false;
            if (almarhumSelect) almarhumSelect.required = true;
        }
    }

    toggleFields();
    if (jenisSurat) {
        jenisSurat.addEventListener('change', toggleFields);
    }
});
</script>