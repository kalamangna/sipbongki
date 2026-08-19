<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Kode --}}
    <div>
        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Kode <span class="text-red-500">*</span></label>
        <input type="text" name="kode" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" value="{{ old('kode', $lingkungan->kode ?? '') }}" placeholder="Contoh: LKG-01" required>
    </div>

    {{-- Nama Lingkungan --}}
    <div>
        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Nama Lingkungan <span class="text-red-500">*</span></label>
        <input type="text" name="nama" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" value="{{ old('nama', $lingkungan->nama ?? '') }}" placeholder="Masukkan nama lingkungan" required>
    </div>

    {{-- Kepala Lingkungan --}}
    <div>
        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Kepala Lingkungan</label>
        <select name="ketua_lingkungan" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
            <option value="">-- Pilih Kepala Lingkungan --</option>
            @foreach($kepalaLingkungans as $perangkat)
                <option value="{{ $perangkat->nama_lengkap }}" @selected(old('ketua_lingkungan', $lingkungan->ketua_lingkungan ?? '') == $perangkat->nama_lengkap)>
                    {{ $perangkat->nama_lengkap }}
                    @if($perangkat->jabatanStruktur)
                        ({{ $perangkat->jabatanStruktur->nama }})
                    @endif
                </option>
            @endforeach
        </select>
    </div>

    {{-- Telepon --}}
    <div>
        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Telepon</label>
        <input type="text" name="telepon" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" value="{{ old('telepon', $lingkungan->telepon ?? '') }}" placeholder="Contoh: 08123456789">
    </div>

    {{-- Keterangan --}}
    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Keterangan</label>
        <textarea name="keterangan" rows="3" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" placeholder="Tulis keterangan singkat (opsional)...">{{ old('keterangan', $lingkungan->keterangan ?? '') }}</textarea>
    </div>

    {{-- Status --}}
    <div>
        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Status</label>
        <select name="status" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
            <option value="1" {{ old('status', $lingkungan->status ?? 1) == 1 ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ old('status', $lingkungan->status ?? 1) == 0 ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </div>

</div>
