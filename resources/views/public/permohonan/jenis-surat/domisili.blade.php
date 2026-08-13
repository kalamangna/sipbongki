@unless($isUsaha)
    <div class="form-step hidden" data-step="3">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 mb-8 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-bold text-slate-800">Langkah 3: Surat Keterangan Domisili</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Jenis Surat <span class="text-red-500">*</span></label>
                        <div class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-slate-700">{{ optional($jenisSurats->firstWhere('id', old('jenis_surat_id', $selected)))->nama ?? 'Surat Keterangan Domisili' }}</div>
                        @error('jenis_surat_id')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Status Tempat Tinggal <span class="text-red-500">*</span></label>
                        <select name="status_tempat_tinggal" required class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('status_tempat_tinggal') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                            <option value="">Pilih Status</option>
                            <option value="Milik Sendiri" {{ old('status_tempat_tinggal')=='Milik Sendiri'?'selected':'' }}>Milik Sendiri</option>
                            <option value="Kontrak" {{ old('status_tempat_tinggal')=='Kontrak'?'selected':'' }}>Kontrak</option>
                            <option value="Kos" {{ old('status_tempat_tinggal')=='Kos'?'selected':'' }}>Kos</option>
                            <option value="Menumpang" {{ old('status_tempat_tinggal')=='Menumpang'?'selected':'' }}>Menumpang</option>
                        </select>
                        @error('status_tempat_tinggal')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Lama Tinggal <span class="text-red-500">*</span></label>
                        <input type="text" name="lama_tinggal" required class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('lama_tinggal') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('lama_tinggal') }}" placeholder="Contoh: 2 Tahun">
                        @error('lama_tinggal')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Alamat Domisili <span class="text-red-500">*</span></label>
                        <textarea name="alamat_domisili" required rows="3" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('alamat_domisili') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" placeholder="Masukkan Alamat">{{ old('alamat_domisili') }}</textarea>
                        @error('alamat_domisili')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    <div class="grid grid-cols-2 gap-6 md:col-span-1">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">RT Domisili <span class="text-red-500">*</span></label>
                            <input type="text" name="rt_domisili" required class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('rt_domisili') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('rt_domisili') }}" placeholder="Contoh: 001">
                            @error('rt_domisili')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">RW Domisili <span class="text-red-500">*</span></label>
                            <input type="text" name="rw_domisili" required class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('rw_domisili') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('rw_domisili') }}" placeholder="Contoh: 001">
                            @error('rw_domisili')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Keperluan <span class="text-red-500">*</span></label>
                        <textarea name="keperluan" required rows="4" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('keperluan') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" placeholder="Masukkan Keperluan">{{ old('keperluan') }}</textarea>
                        @error('keperluan')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-between items-center">
            <button type="button" class="prev-step cursor-pointer px-6 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition-colors">Sebelumnya</button>
            <button type="button" class="next-step cursor-pointer px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-all duration-200 hover:-translate-y-0.5">Lanjut ke Langkah 4</button>
        </div>
    </div>

    <div class="form-step hidden" data-step="4">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 mb-8 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-bold text-slate-800">Langkah 4: Upload Dokumen</h3>
            </div>
            <div class="p-6">
                <p class="mb-6 text-slate-600">Unggah dokumen persyaratan berikut untuk Surat Keterangan Domisili:</p>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">KTP <span class="text-red-500">*</span></label>
                        <input required type="file" name="dokumen_ktp" class="w-full file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-light file:text-primary hover:file:bg-primary/20 transition-colors border border-slate-200 rounded-xl cursor-pointer @error('dokumen_ktp') border-red-300 @enderror">
                        @error('dokumen_ktp')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">KK <span class="text-red-500">*</span></label>
                        <input required type="file" name="dokumen_kk" class="w-full file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-light file:text-primary hover:file:bg-primary/20 transition-colors border border-slate-200 rounded-xl cursor-pointer @error('dokumen_kk') border-red-300 @enderror">
                        @error('dokumen_kk')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Surat Pengantar RT/RW <span class="text-red-500">*</span></label>
                        <input required type="file" name="dokumen_surat_pengantar" class="w-full file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-light file:text-primary hover:file:bg-primary/20 transition-colors border border-slate-200 rounded-xl cursor-pointer @error('dokumen_surat_pengantar') border-red-300 @enderror">
                        @error('dokumen_surat_pengantar')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-between items-center">
            <button type="button" class="prev-step cursor-pointer px-6 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition-colors">Sebelumnya</button>
            <button type="button" class="next-step cursor-pointer px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-all duration-200 hover:-translate-y-0.5">Lanjut ke Langkah 5</button>
        </div>
    </div>
@endunless
