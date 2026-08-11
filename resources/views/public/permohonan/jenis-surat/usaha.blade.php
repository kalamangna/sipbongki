@if($isUsaha)
    <div class="form-step hidden" data-step="3">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 mb-8 overflow-hidden">
            <div class="bg-slate-50 border-b border-slate-100 px-6 py-4">
                <strong class="text-slate-800">Langkah 3: Data Usaha</strong>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nama Usaha</label>
                        <input type="text" name="nama_usaha" id="nama_usaha" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('nama_usaha') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('nama_usaha') }}" placeholder="Contoh: Toko Kelontong Budi">
                        @error('nama_usaha')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Jenis Usaha</label>
                        <input type="text" name="jenis_usaha" id="jenis_usaha" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('jenis_usaha') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('jenis_usaha') }}" placeholder="Contoh: Perdagangan">
                        @error('jenis_usaha')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Alamat Usaha</label>
                        <textarea name="alamat_usaha" id="alamat_usaha" rows="2" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('alamat_usaha') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">{{ old('alamat_usaha') }}</textarea>
                        @error('alamat_usaha')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Lama Usaha</label>
                        <input type="text" name="lama_usaha" id="lama_usaha" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('lama_usaha') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('lama_usaha') }}" placeholder="Contoh: 5 Tahun">
                        @error('lama_usaha')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Keperluan</label>
                        <textarea name="keperluan" id="keperluan" rows="3" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('keperluan') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" placeholder="Contoh: Pengajuan izin usaha dagang/ Surat keterangan usaha untuk kebutuhan perbankan atau modal usaha">{{ old('keperluan') }}</textarea>
                        @error('keperluan')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-between items-center">
            <button type="button" class="prev-step px-6 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition-colors">Sebelumnya</button>
            <button type="button" class="next-step px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-all duration-200 hover:-translate-y-0.5">Lanjut ke Langkah 4</button>
        </div>
    </div>

    <div class="form-step hidden" data-step="4">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 mb-8 overflow-hidden">
            <div class="bg-slate-50 border-b border-slate-100 px-6 py-4">
                <strong class="text-slate-800">Langkah 4: Upload Dokumen</strong>
            </div>
            <div class="p-6">
                <p class="mb-6 text-slate-600">Unggah dokumen persyaratan berikut untuk Surat Keterangan Usaha:</p>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">KTP</label>
                        <input type="file" name="dokumen_ktp" class="w-full file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-light file:text-primary hover:file:bg-primary/20 transition-colors border border-slate-200 rounded-xl cursor-pointer @error('dokumen_ktp') border-red-300 @enderror">
                        @error('dokumen_ktp')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">KK</label>
                        <input type="file" name="dokumen_kk" class="w-full file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-light file:text-primary hover:file:bg-primary/20 transition-colors border border-slate-200 rounded-xl cursor-pointer @error('dokumen_kk') border-red-300 @enderror">
                        @error('dokumen_kk')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Surat Pengantar RT/RW</label>
                        <input type="file" name="dokumen_surat_pengantar" class="w-full file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-light file:text-primary hover:file:bg-primary/20 transition-colors border border-slate-200 rounded-xl cursor-pointer @error('dokumen_surat_pengantar') border-red-300 @enderror">
                        @error('dokumen_surat_pengantar')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Foto Tempat Usaha</label>
                        <input type="file" name="dokumen_tempat_usaha" class="w-full file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-light file:text-primary hover:file:bg-primary/20 transition-colors border border-slate-200 rounded-xl cursor-pointer @error('dokumen_tempat_usaha') border-red-300 @enderror">
                        @error('dokumen_tempat_usaha')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="mt-6 bg-slate-50 border border-slate-200 text-slate-600 rounded-xl p-4 text-sm">
                    Dokumen ini membantu proses verifikasi. Unggah file JPG, PNG, atau PDF maksimal 2MB.
                </div>
            </div>
        </div>
        <div class="flex justify-between items-center">
            <button type="button" class="prev-step px-6 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition-colors">Sebelumnya</button>
            <button type="button" class="next-step px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-all duration-200 hover:-translate-y-0.5">Lanjut ke Langkah 5</button>
        </div>
    </div>
@endif
