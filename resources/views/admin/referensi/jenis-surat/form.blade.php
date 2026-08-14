<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Kode Surat --}}
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kode Surat <span class="text-red-500">*</span></label>
        <input type="text" name="kode" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm" value="{{ old('kode', $jenisSurat->kode ?? '') }}" placeholder="Contoh: SKU / SKTM" required>
    </div>

    {{-- Kode Nomor Surat --}}
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kode Nomor Surat</label>
        <input type="text" name="kode_nomor" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm" value="{{ old('kode_nomor', $jenisSurat->kode_nomor ?? '') }}" placeholder="Contoh: 500.2 / 470">
        <p class="mt-1 text-xs text-slate-500">Digunakan pada nomor surat. Contoh: 470/001/KLB/VII/2026</p>
    </div>

    {{-- Nomor Urut Awal --}}
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nomor Urut Awal</label>
        <input type="number" min="0" name="nomor_urut" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm" value="{{ old('nomor_urut', $jenisSurat->nomor_urut ?? 0) }}" placeholder="Contoh: 0">
        <p class="mt-1 text-xs text-slate-500">Nomor terakhir yang telah digunakan.</p>
    </div>

    {{-- Nama Surat --}}
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Surat <span class="text-red-500">*</span></label>
        <input type="text" name="nama" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm" value="{{ old('nama', $jenisSurat->nama ?? '') }}" placeholder="Contoh: Surat Keterangan Usaha" required>
    </div>

    {{-- Persyaratan Layanan --}}
    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Persyaratan Layanan</label>
        <textarea rows="4" name="deskripsi" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm" placeholder="Contoh: KTP, KK, dan surat pengantar RT/RW.">{{ old('deskripsi', $jenisSurat->deskripsi ?? '') }}</textarea>
        <p class="mt-1 text-xs text-slate-500">Masukkan persyaratan singkat yang akan ditampilkan pada kartu layanan di halaman utama website.</p>
    </div>

</div>

<div class="mt-6 pt-6 border-t border-slate-100">
    <div class="grid grid-cols-1 gap-4">
        {{-- Aktif --}}
        <label class="flex items-center gap-3 cursor-pointer p-4 rounded-xl bg-slate-50 hover:bg-slate-100 transition-colors border border-slate-200 w-fit">
            <input type="checkbox" name="aktif" value="1" class="w-5 h-5 rounded border-slate-300 text-primary-600 focus:ring-primary-600 focus:ring-2" @checked(old('aktif', $jenisSurat->aktif ?? true))>
            <span class="text-sm font-bold text-slate-800 pr-4">Status Aktif</span>
        </label>
    </div>
</div>