{{-- 1. INFORMASI UTAMA & PEMOHON --}}
<div class="mb-8">
    <div class="pb-3 border-b border-slate-100 mb-5 dark:border-slate-800">
        <h3 class="font-bold text-slate-800 text-sm tracking-tight dark:text-slate-100">Informasi Utama & Pemohon</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        {{-- Jenis Surat --}}
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5 dark:text-slate-300">
                Jenis Surat <span class="text-red-500">*</span>
            </label>
            <select
                name="jenis_surat_id"
                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 {{ isset($permohonanSurat) ? 'pointer-events-none opacity-80 bg-slate-100 dark:bg-slate-900/60' : '' }}"
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
            <label class="block text-xs font-semibold text-slate-700 mb-1.5 dark:text-slate-300">
                Tanggal Permohonan <span class="text-red-500">*</span>
            </label>
            <input
                type="date"
                name="tanggal_permohonan"
                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
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
                    <div class="bg-slate-50/70 border border-slate-200/90 rounded-xl p-4 shadow-sm dark:bg-slate-800/60 dark:border-slate-700">
                        <div class="flex flex-wrap items-center justify-between gap-2 mb-3 pb-2.5 border-b border-slate-200/80 dark:border-slate-700">
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-200">Identitas Pemohon</span>
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 ring-1 ring-emerald-500/30 dark:bg-emerald-950/60 dark:text-emerald-300 dark:ring-emerald-800/40">
                                    <i class="fa-solid fa-circle-check text-[10px] text-emerald-600 dark:text-emerald-400"></i>
                                    Penduduk Bongki
                                </span>
                                @if(optional($penduduk)->aktif === false || optional($penduduk)->aktif === 0)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-100 text-rose-800 ring-1 ring-rose-500/30 dark:bg-rose-950/60 dark:text-rose-300 dark:ring-rose-800/40">
                                        <i class="fa-solid fa-circle-exclamation text-[10px] text-rose-600 dark:text-rose-400"></i>
                                        Perlu Verifikasi
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-left">
                            <div class="bg-white p-3 rounded-lg border border-slate-200/80 dark:bg-slate-800 dark:border-slate-700">
                                <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-0.5">NIK</span>
                                <span class="font-mono font-bold text-slate-900 text-sm dark:text-slate-100">{{ $penduduk->nik ?: ($dataSurat['manual_nik'] ?? '-') }}</span>
                            </div>
                            <div class="bg-white p-3 rounded-lg border border-slate-200/80 dark:bg-slate-800 dark:border-slate-700">
                                <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-0.5">Nama Lengkap</span>
                                <span class="font-bold text-slate-900 text-sm dark:text-slate-100">{{ $penduduk->nama_lengkap ?: ($dataSurat['manual_nama_lengkap'] ?? '-') }}</span>
                            </div>
                        </div>

                        <div class="mt-3 flex items-center justify-between gap-3 pt-2.5 border-t border-slate-200/70 text-xs dark:border-slate-700">
                            <span class="text-slate-500 dark:text-slate-400">
                                <i class="fa-solid fa-circle-info text-primary mr-1"></i> Data terhubung dengan master database kependudukan.
                            </span>
                            <a href="{{ route('admin.penduduk.edit', $penduduk->id) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 hover:text-primary hover:border-slate-300 shadow-sm transition-all dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700">
                                <i class="fa-solid fa-user-pen text-slate-400"></i> Edit di Master Penduduk <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-slate-400"></i>
                            </a>
                        </div>
                    </div>

                @else
                    {{-- PENDUDUK LUAR BONGKI (MANUAL) --}}
                    <input type="hidden" name="jenis_pemohon" value="manual">

                    <div class="bg-slate-50/70 border border-slate-200/90 rounded-xl p-4 shadow-sm dark:bg-slate-800/60 dark:border-slate-700">
                        <div class="flex flex-wrap items-center justify-between gap-2 mb-3 pb-2.5 border-b border-slate-200/80 dark:border-slate-700">
                            <span class="text-xs font-bold text-slate-800 dark:text-slate-200">Identitas Pemohon</span>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-900 ring-1 ring-amber-500/30 dark:bg-amber-950/60 dark:text-amber-300 dark:ring-amber-800/40">
                                <i class="fa-solid fa-circle-info text-[10px] text-amber-600 dark:text-amber-400"></i>
                                Penduduk Luar Bongki
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1 dark:text-slate-300">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="manual_nama_lengkap" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3.5 py-2 focus:ring-2 focus:ring-primary focus:outline-none dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" value="{{ old('manual_nama_lengkap', $dataSurat['manual_nama_lengkap'] ?? $dataSurat['nama_lengkap'] ?? $dataSurat['nama_pemohon'] ?? $dataSurat['nama_pemilik'] ?? $dataSurat['nama'] ?? '') }}" required>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1 dark:text-slate-300">NIK <span class="text-red-500">*</span></label>
                                <input type="text" name="manual_nik" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3.5 py-2 focus:ring-2 focus:ring-primary focus:outline-none font-mono dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" value="{{ old('manual_nik', $dataSurat['manual_nik'] ?? $dataSurat['nik'] ?? '') }}" required>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1 dark:text-slate-300">Jenis Kelamin</label>
                                @php $currentJk = old('manual_jenis_kelamin', $dataSurat['manual_jenis_kelamin'] ?? $dataSurat['jenis_kelamin'] ?? ''); @endphp
                                <select name="manual_jenis_kelamin" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3.5 py-2 focus:ring-2 focus:ring-primary focus:outline-none dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                                    <option value="">-- Pilih --</option>
                                    <option value="L" @selected($currentJk == 'L')>Laki-laki</option>
                                    <option value="P" @selected($currentJk == 'P')>Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1 dark:text-slate-300">Tempat, Tanggal Lahir</label>
                                <div class="grid grid-cols-2 gap-2">
                                    <input type="text" name="manual_tempat_lahir" placeholder="Tempat" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3 py-2 focus:ring-2 focus:ring-primary focus:outline-none dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" value="{{ old('manual_tempat_lahir', $dataSurat['manual_tempat_lahir'] ?? $dataSurat['tempat_lahir'] ?? '') }}">
                                    <input type="date" name="manual_tanggal_lahir" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3 py-2 focus:ring-2 focus:ring-primary focus:outline-none dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" value="{{ old('manual_tanggal_lahir', $dataSurat['manual_tanggal_lahir'] ?? $dataSurat['tanggal_lahir'] ?? '') }}">
                                </div>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-semibold text-slate-700 mb-1 dark:text-slate-300">Alamat Asal Lengkap</label>
                                <textarea name="manual_alamat" rows="2" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3.5 py-2 focus:ring-2 focus:ring-primary focus:outline-none dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">{{ old('manual_alamat', $dataSurat['manual_alamat'] ?? $dataSurat['alamat'] ?? $dataSurat['alamat_asal'] ?? $dataSurat['alamat_domisili'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        @else
            {{-- MODE CREATE: PILIH SUMBER DATA PEMOHON --}}
            <div class="md:col-span-2" id="pemohon-container">
                <label class="block text-xs font-semibold text-slate-700 mb-2 dark:text-slate-300">
                    Sumber Data Pemohon <span class="text-red-500">*</span>
                </label>
                
                <div class="flex flex-wrap gap-4 mb-3">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="jenis_pemohon" value="terdaftar" class="text-primary focus:ring-primary" checked onchange="togglePemohonSource()">
                        <span class="ml-2 text-sm text-slate-700 dark:text-slate-300 font-medium">Penduduk Bongki</span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="jenis_pemohon" value="manual" class="text-primary focus:ring-primary" {{ old('jenis_pemohon') == 'manual' ? 'checked' : '' }} onchange="togglePemohonSource()">
                        <span class="ml-2 text-sm text-slate-700 dark:text-slate-300 font-medium">Penduduk Luar Bongki (Manual)</span>
                    </label>
                </div>

                <div id="pemohon-field">
                    <select id="penduduk_id" name="penduduk_id" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
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

                <div id="manual-pemohon-fields" style="display: none;" class="bg-slate-50/70 p-4 rounded-xl border border-slate-200 mt-2 grid grid-cols-1 md:grid-cols-2 gap-3.5 dark:bg-slate-800/60 dark:border-slate-700">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1 dark:text-slate-300">Nama Lengkap</label>
                        <input type="text" name="manual_nama_lengkap" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3 py-2 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" value="{{ old('manual_nama_lengkap') }}">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1 dark:text-slate-300">NIK</label>
                        <input type="text" name="manual_nik" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3 py-2 font-mono dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" value="{{ old('manual_nik') }}">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1 dark:text-slate-300">Jenis Kelamin</label>
                        <select name="manual_jenis_kelamin" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3 py-2 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                            <option value="">-- Pilih --</option>
                            <option value="L" @selected(old('manual_jenis_kelamin') == 'L')>Laki-laki</option>
                            <option value="P" @selected(old('manual_jenis_kelamin') == 'P')>Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1 dark:text-slate-300">Tempat, Tanggal Lahir</label>
                        <div class="grid grid-cols-2 gap-2">
                            <input type="text" name="manual_tempat_lahir" placeholder="Tempat" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3 py-2 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" value="{{ old('manual_tempat_lahir') }}">
                            <input type="date" name="manual_tanggal_lahir" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3 py-2 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" value="{{ old('manual_tanggal_lahir') }}">
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-slate-700 mb-1 dark:text-slate-300">Alamat Asal Lengkap</label>
                        <textarea name="manual_alamat" rows="2" class="w-full bg-white border border-slate-200 text-sm rounded-xl px-3 py-2 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">{{ old('manual_alamat') }}</textarea>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- 2. FORM KHUSUS SPESIFIK JENIS SURAT --}}
{{-- Data Usaha (SKU) --}}
<div id="usaha-fields" class="mb-8" style="display:none;">
    <div class="pb-3 border-b border-slate-100 mb-5 dark:border-slate-800">
        <h3 class="font-bold text-slate-800 text-sm tracking-tight dark:text-slate-100">Rincian Data Usaha</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Usaha <span class="text-red-500">*</span></label>
            <input type="text" name="nama_usaha" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" placeholder="Contoh: Kios Berkah Mandiri" value="{{ old('nama_usaha', $permohonanSurat->data_surat['nama_usaha'] ?? '') }}">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Jenis Usaha <span class="text-red-500">*</span></label>
            <input type="text" name="jenis_usaha" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" placeholder="Contoh: Perdagangan Sembako" value="{{ old('jenis_usaha', $permohonanSurat->data_surat['jenis_usaha'] ?? '') }}">
        </div>
        <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Tempat Usaha</label>
            <textarea name="alamat_usaha" rows="2" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" placeholder="Alamat lengkap lokasi usaha">{{ old('alamat_usaha', $permohonanSurat->data_surat['alamat_usaha'] ?? '') }}</textarea>
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Lama Usaha</label>
            <input type="text" name="lama_usaha" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" placeholder="Contoh: 3 Tahun" value="{{ old('lama_usaha', $permohonanSurat->data_surat['lama_usaha'] ?? '') }}">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Keterangan Usaha</label>
            <input type="text" name="keterangan_usaha" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" placeholder="Contoh: Usaha aktif / berkembang" value="{{ old('keterangan_usaha', $permohonanSurat->data_surat['keterangan_usaha'] ?? '') }}">
        </div>
    </div>
</div>

{{-- Data Kematian --}}
<div id="kematian-fields" class="mb-8" style="display:none;">
    <div class="pb-3 border-b border-slate-100 mb-5 dark:border-slate-800">
        <h3 class="font-bold text-slate-800 text-sm tracking-tight dark:text-slate-100">Rincian Kematian & Pelapor</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Almarhum / Almarhumah <span class="text-red-500">*</span></label>
            <select id="penduduk_id_kematian" name="almarhum_id" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
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
            <select name="hari_meninggal" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                <option value="">-- Pilih Hari --</option>
                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                    <option value="{{ $hari }}" @selected(old('hari_meninggal', $permohonanSurat->data_surat['hari_meninggal'] ?? '') == $hari)>{{ $hari }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tanggal Meninggal <span class="text-red-500">*</span></label>
            <input type="date" name="tanggal_meninggal" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" value="{{ old('tanggal_meninggal', $permohonanSurat->data_surat['tanggal_meninggal'] ?? '') }}">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Jam Meninggal</label>
            <input type="time" name="jam_meninggal" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" value="{{ old('jam_meninggal', $permohonanSurat->data_surat['jam_meninggal'] ?? '') }}">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tempat Meninggal <span class="text-red-500">*</span></label>
            <input type="text" name="tempat_meninggal" placeholder="Contoh: RSUD Sinjai / Rumah Duka" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" value="{{ old('tempat_meninggal', $permohonanSurat->data_surat['tempat_meninggal'] ?? '') }}">
        </div>
        <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Penyebab Kematian <span class="text-red-500">*</span></label>
            <input type="text" name="penyebab_kematian" placeholder="Contoh: Sakit / Lanjut Usia" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" value="{{ old('penyebab_kematian', $permohonanSurat->data_surat['penyebab_kematian'] ?? '') }}">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Pelapor <span class="text-red-500">*</span></label>
            <select id="pelapor_id" name="pelapor_id" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
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
            <select name="hubungan_pelapor" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
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
    <div class="pb-3 border-b border-slate-100 mb-5 dark:border-slate-800">
        <h3 class="font-bold text-slate-800 text-sm tracking-tight dark:text-slate-100">Rincian Dokumen Orang Yang Sama</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Dalam Dokumen Lain <span class="text-red-500">*</span></label>
            <input type="text" name="nama_lain" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" placeholder="Contoh: ABDUL RAHMAN" value="{{ old('nama_lain', $permohonanSurat->data_surat['nama_lain'] ?? '') }}">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Jenis Dokumen <span class="text-red-500">*</span></label>
            <input type="text" name="jenis_dokumen" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" placeholder="Contoh: Ijazah / Sertifikat / Paspor" value="{{ old('jenis_dokumen', $permohonanSurat->data_surat['jenis_dokumen'] ?? '') }}">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor Dokumen <span class="text-red-500">*</span></label>
            <input type="text" name="nomor_dokumen" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" placeholder="Contoh: SHM No. 12345" value="{{ old('nomor_dokumen', $permohonanSurat->data_surat['nomor_dokumen'] ?? '') }}">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Keterangan Perbedaan</label>
            <input type="text" name="keterangan_perbedaan" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" placeholder="Contoh: Perbedaan ejaan huruf pada nama" value="{{ old('keterangan_perbedaan', $permohonanSurat->data_surat['keterangan_perbedaan'] ?? '') }}">
        </div>
    </div>
</div>

{{-- Data Domisili --}}
<div id="domisili-fields" class="mb-8" style="display:none;">
    <div class="pb-3 border-b border-slate-100 mb-5 dark:border-slate-800">
        <h3 class="font-bold text-slate-800 text-sm tracking-tight dark:text-slate-100">Rincian Domisili</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Lama Tinggal</label>
            <input type="text" name="lama_tinggal" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" placeholder="Contoh: 2 Tahun" value="{{ old('lama_tinggal', $permohonanSurat->data_surat['lama_tinggal'] ?? '') }}">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Status Tempat Tinggal</label>
            <select name="status_tempat_tinggal" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                <option value="">-- Pilih Status --</option>
                @foreach(['Milik Sendiri', 'Kontrak', 'Kos', 'Menumpang'] as $st)
                    <option value="{{ $st }}" @selected(old('status_tempat_tinggal', $permohonanSurat->data_surat['status_tempat_tinggal'] ?? '') == $st)>{{ $st }}</option>
                @endforeach
            </select>
        </div>
        <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Asal</label>
            <textarea name="alamat_asal" rows="2" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" placeholder="Alamat sebelum berdomisili">{{ old('alamat_asal', $permohonanSurat->data_surat['alamat_asal'] ?? '') }}</textarea>
        </div>
        <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Domisili di Bongki</label>
            <textarea name="alamat" rows="2" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" placeholder="Contoh: Jl. Sudirman No. 12, Lingkungan Lappa">{{ old('alamat', $permohonanSurat->data_surat['alamat'] ?? '') }}</textarea>
        </div>
    </div>
</div>

{{-- 3. INFORMASI PENANDATANGAN & KEPERLUAN --}}
<div class="mb-4">
    <div class="pb-3 border-b border-slate-100 mb-5 dark:border-slate-800">
        <h3 class="font-bold text-slate-800 text-sm tracking-tight dark:text-slate-100">Penandatangan & Keperluan Surat</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        {{-- Penandatangan --}}
        <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                Pejabat Penandatangan <span class="text-red-500">*</span>
            </label>
            <select
                name="penandatangan_id"
                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
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
                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
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
                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3.5 py-2.5 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
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