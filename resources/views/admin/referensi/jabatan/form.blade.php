<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Nama Jabatan --}}
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Jabatan <span class="text-red-500">*</span></label>
        <input type="text" name="nama" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm" value="{{ old('nama', $jabatan->nama ?? '') }}" placeholder="Masukkan nama jabatan" required>
    </div>

    {{-- Slug --}}
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Slug</label>
        <input type="text" name="slug" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm" value="{{ old('slug', $jabatan->slug ?? '') }}" placeholder="contoh: kasi-pemerintahan">
    </div>

    {{-- Parent Jabatan --}}
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Parent Jabatan</label>
        <select name="parent_id" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">
            <option value="">-- Tidak Ada --</option>
            @foreach($parentJabatans as $parent)
                <option value="{{ $parent->id }}" @selected(old('parent_id', $jabatan->parent_id ?? '') == $parent->id)>
                    {{ $parent->nama }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Urutan --}}
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Urutan</label>
        <input type="number" min="1" name="urutan" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm" value="{{ old('urutan', $jabatan->urutan ?? 1) }}" placeholder="1">
    </div>

</div>

<div class="mt-6 pt-6 border-t border-slate-100">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        {{-- Penandatangan --}}
        <label class="flex items-center gap-3 cursor-pointer p-4 rounded-xl bg-slate-50 hover:bg-slate-100 transition-colors border border-slate-200">
            <input type="checkbox" name="is_penandatangan" value="1" class="w-5 h-5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-600 focus:ring-2" @checked(old('is_penandatangan', $jabatan->is_penandatangan ?? false))>
            <span class="text-sm font-bold text-slate-800">Jabatan Penandatangan</span>
        </label>
        
        {{-- Struktur Organisasi --}}
        <label class="flex items-center gap-3 cursor-pointer p-4 rounded-xl bg-slate-50 hover:bg-slate-100 transition-colors border border-slate-200">
            <input type="checkbox" name="is_struktur" value="1" class="w-5 h-5 rounded border-slate-300 text-sky-600 focus:ring-sky-600 focus:ring-2" @checked(old('is_struktur', $jabatan->is_struktur ?? false))>
            <span class="text-sm font-bold text-slate-800">Struktur Organisasi Web</span>
        </label>
        
        {{-- Aktif --}}
        <label class="flex items-center gap-3 cursor-pointer p-4 rounded-xl bg-slate-50 hover:bg-slate-100 transition-colors border border-slate-200">
            <input type="checkbox" name="aktif" value="1" class="w-5 h-5 rounded border-slate-300 text-primary-600 focus:ring-primary-600 focus:ring-2" @checked(old('aktif', $jabatan->aktif ?? true))>
            <span class="text-sm font-bold text-slate-800">Jabatan Aktif</span>
        </label>
    </div>
</div>