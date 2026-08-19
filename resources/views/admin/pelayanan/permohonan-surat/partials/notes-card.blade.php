<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6 dark:bg-slate-900 dark:border-slate-800">
    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800">
        <h3 class="font-bold text-slate-800 dark:text-slate-100">Catatan Khusus</h3>
    </div>
    <div class="p-6">
        <form action="{{ route('admin.permohonan-surat.update-note', $permohonanSurat) }}" method="POST">
            @csrf
            @method('PATCH')
            
            <div class="mb-4">
                <p class="text-xs font-semibold text-slate-500 mb-2 dark:text-slate-400">Catatan Internal / Pelayanan</p>
                <textarea name="catatan" rows="4" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500 @error('catatan') border-red-500 ring-1 ring-red-500 @enderror" placeholder="Tulis catatan internal atau informasi tambahan tentang pelayanan ini...">{{ old('catatan', $permohonanSurat->catatan) }}</textarea>
                @error('catatan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-slate-800 text-white hover:bg-slate-700 shadow-sm transition-all focus:outline-none active:scale-95 cursor-pointer dark:bg-primary-600 dark:hover:bg-primary-700">
                <i class="fa-solid fa-save"></i> Simpan Catatan
            </button>
        </form>
    </div>
</div>