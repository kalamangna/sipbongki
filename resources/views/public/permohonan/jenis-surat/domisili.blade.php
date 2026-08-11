@unless($isUsaha)
    <div class="form-step hidden" data-step="3">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 mb-8 overflow-hidden">
            <div class="bg-slate-50 border-b border-slate-100 px-6 py-4">
                <strong class="text-slate-800">Langkah 3: Surat Keterangan Domisili</strong>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Jenis Surat</label>
                        <div class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-slate-700">{{ optional($jenisSurats->firstWhere('id', old('jenis_surat_id', $selected)))->nama ?? 'Surat Keterangan Domisili' }}</div>
                        @error('jenis_surat_id')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Alamat Domisili</label>
                        <textarea name="alamat" rows="3" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('alamat') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">{{ old('alamat') }}</textarea>
                        @error('alamat')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Keperluan</label>
                        <textarea name="keperluan" rows="4" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('keperluan') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">{{ old('keperluan') }}</textarea>
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
                <p class="mb-6 text-slate-600">Unggah dokumen persyaratan berikut untuk Surat Keterangan Domisili:</p>
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
                </div>
            </div>
        </div>
        <div class="flex justify-between items-center">
            <button type="button" class="prev-step px-6 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition-colors">Sebelumnya</button>
            <button type="button" class="next-step px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-all duration-200 hover:-translate-y-0.5">Lanjut ke Langkah 5</button>
        </div>
    </div>
@endunless
