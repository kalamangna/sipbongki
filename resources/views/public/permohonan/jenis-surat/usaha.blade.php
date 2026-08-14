@if($isUsaha)
    <div class="form-step hidden" data-step="3">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 mb-8 overflow-hidden">
            <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-bold text-slate-800">Langkah 3: Data Usaha</h3>
            </div>
            <div class="p-5 sm:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nama Usaha <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_usaha" required id="nama_usaha" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('nama_usaha') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('nama_usaha') }}" placeholder="Contoh: Toko Kelontong Budi">
                        @error('nama_usaha')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Jenis Usaha <span class="text-red-500">*</span></label>
                        <input type="text" name="jenis_usaha" required id="jenis_usaha" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('jenis_usaha') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('jenis_usaha') }}" placeholder="Contoh: Perdagangan">
                        @error('jenis_usaha')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Alamat Usaha <span class="text-red-500">*</span></label>
                        <textarea required name="alamat_usaha" id="alamat_usaha" rows="2" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('alamat_usaha') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" placeholder="Masukkan Alamat Usaha">{{ old('alamat_usaha') }}</textarea>
                        @error('alamat_usaha')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Lama Usaha <span class="text-red-500">*</span></label>
                        <input required type="text" name="lama_usaha" id="lama_usaha" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('lama_usaha') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('lama_usaha') }}" placeholder="Contoh: 5 Tahun">
                        @error('lama_usaha')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Keperluan <span class="text-red-500">*</span></label>
                        <textarea name="keperluan" required id="keperluan" rows="3" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('keperluan') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" placeholder="Contoh: Pengajuan izin usaha dagang/ Surat keterangan usaha untuk kebutuhan perbankan atau modal usaha">{{ old('keperluan') }}</textarea>
                        @error('keperluan')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:items-center gap-3">
            <button type="button" class="prev-step cursor-pointer w-full sm:w-auto px-6 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition-colors text-center">Sebelumnya</button>
            <button type="button" class="next-step cursor-pointer w-full sm:w-auto px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-all duration-200 hover:-translate-y-0.5 text-center">Lanjut ke Langkah 4</button>
        </div>
    </div>

    <div class="form-step hidden" data-step="4">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 mb-8 overflow-hidden">
            <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-bold text-slate-800">Langkah 4: Upload Dokumen</h3>
            </div>
            <div class="p-5 sm:p-6">
                <p class="mb-6 text-sm sm:text-base text-slate-600">Unggah dokumen persyaratan berikut untuk Surat Keterangan Usaha:</p>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">KTP <span class="text-red-500">*</span></label>
                        <input required type="file" name="dokumen_ktp" class="w-full file:mr-3 sm:file:mr-4 file:py-2.5 file:px-3 sm:file:px-4 file:rounded-xl file:border-0 file:text-xs sm:file:text-sm file:font-semibold file:bg-primary-light file:text-primary hover:file:bg-primary/20 transition-colors border border-slate-200 rounded-xl cursor-pointer text-xs sm:text-sm text-slate-500 @error('dokumen_ktp') border-red-300 @enderror">
                        @error('dokumen_ktp')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">KK <span class="text-red-500">*</span></label>
                        <input required type="file" name="dokumen_kk" class="w-full file:mr-3 sm:file:mr-4 file:py-2.5 file:px-3 sm:file:px-4 file:rounded-xl file:border-0 file:text-xs sm:file:text-sm file:font-semibold file:bg-primary-light file:text-primary hover:file:bg-primary/20 transition-colors border border-slate-200 rounded-xl cursor-pointer text-xs sm:text-sm text-slate-500 @error('dokumen_kk') border-red-300 @enderror">
                        @error('dokumen_kk')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Surat Pengantar RT/RW <span class="text-red-500">*</span></label>
                        <input required type="file" name="dokumen_surat_pengantar" class="w-full file:mr-3 sm:file:mr-4 file:py-2.5 file:px-3 sm:file:px-4 file:rounded-xl file:border-0 file:text-xs sm:file:text-sm file:font-semibold file:bg-primary-light file:text-primary hover:file:bg-primary/20 transition-colors border border-slate-200 rounded-xl cursor-pointer text-xs sm:text-sm text-slate-500 @error('dokumen_surat_pengantar') border-red-300 @enderror">
                        @error('dokumen_surat_pengantar')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Foto Tempat Usaha <span class="text-red-500">*</span></label>
                        <input required type="file" name="dokumen_tempat_usaha" class="w-full file:mr-3 sm:file:mr-4 file:py-2.5 file:px-3 sm:file:px-4 file:rounded-xl file:border-0 file:text-xs sm:file:text-sm file:font-semibold file:bg-primary-light file:text-primary hover:file:bg-primary/20 transition-colors border border-slate-200 rounded-xl cursor-pointer text-xs sm:text-sm text-slate-500 @error('dokumen_tempat_usaha') border-red-300 @enderror">
                        @error('dokumen_tempat_usaha')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="mt-6 bg-slate-50 border border-slate-200 text-slate-600 rounded-xl p-4 text-sm">
                    Dokumen ini membantu proses verifikasi. Unggah file JPG, PNG, atau PDF maksimal 2MB.
                </div>
            </div>
        </div>
        <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:items-center gap-3">
            <button type="button" class="prev-step cursor-pointer w-full sm:w-auto px-6 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition-colors text-center">Sebelumnya</button>
            <button type="button" class="next-step cursor-pointer w-full sm:w-auto px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-all duration-200 hover:-translate-y-0.5 text-center">Lanjut ke Langkah 5</button>
        </div>
    </div>
@endif
