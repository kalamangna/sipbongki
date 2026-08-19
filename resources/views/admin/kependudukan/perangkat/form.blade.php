<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- KIRI: Informasi Utama --}}
    <div class="h-full">
        <div class="pb-3 border-b border-slate-100 mb-6 dark:border-slate-800">
            <h3 class="font-bold text-slate-800 text-base dark:text-slate-100">Informasi Utama</h3>
        </div>

        <div class="space-y-6">
            
            {{-- Nama Lengkap --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama_lengkap" placeholder="Masukkan nama lengkap sesuai KTP" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" value="{{ old('nama_lengkap', $perangkat->nama_lengkap ?? '') }}" required>
                @error('nama_lengkap')<div class="text-red-500 text-xs mt-1">{{ $message }}</div>@enderror
            </div>

            {{-- NIP --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">NIP (Nomor Induk Pegawai)</label>
                <input type="text" name="nip" placeholder="Contoh: 19800101 201001 1 001" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" value="{{ old('nip', $perangkat->nip ?? '') }}">
                @error('nip')<div class="text-red-500 text-xs mt-1">{{ $message }}</div>@enderror
            </div>

            {{-- Jabatan --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Jabatan Pokok <span class="text-red-500">*</span></label>
                <select name="jabatan_id" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" required>
                    <option value="">-- Pilih Jabatan Pokok --</option>
                    @foreach($jabatans as $jabatan)
                        <option value="{{ $jabatan->id }}" @selected(old('jabatan_id', $perangkat->jabatan_id ?? '') == $jabatan->id)>{{ $jabatan->nama }}</option>
                    @endforeach
                </select>
                @error('jabatan_id')<div class="text-red-500 text-xs mt-1">{{ $message }}</div>@enderror
            </div>

            {{-- Jabatan Struktural --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Jabatan pada Struktur Organisasi</label>
                <select name="jabatan_struktur_id" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                    <option value="">-- Tidak Tampil di Struktur --</option>
                    @foreach($jabatansStruktur as $jabatan)
                        <option value="{{ $jabatan->id }}" @selected(old('jabatan_struktur_id', $perangkat->jabatan_struktur_id ?? '') == $jabatan->id)>{{ $jabatan->nama }}</option>
                    @endforeach
                </select>
                @error('jabatan_struktur_id')<div class="text-red-500 text-xs mt-1">{{ $message }}</div>@enderror
            </div>

            {{-- Level Struktur Organisasi --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Level Struktur Organisasi</label>
                <select name="level" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                    <option value="99">-- Pilih Level --</option>
                    <option value="1" @selected(old('level', $perangkat->level ?? 99) == 1)>Lurah</option>
                    <option value="2" @selected(old('level', $perangkat->level ?? 99) == 2)>Sekretaris Lurah</option>
                    <option value="3" @selected(old('level', $perangkat->level ?? 99) == 3)>Kepala Seksi</option>
                    <option value="4" @selected(old('level', $perangkat->level ?? 99) == 4)>Kepala Lingkungan</option>
                    <option value="5" @selected(old('level', $perangkat->level ?? 99) == 5)>Staf</option>
                </select>
                @error('level')<div class="text-red-500 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            
            {{-- Foto Profil --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Foto Profil</label>
                <div class="flex items-center gap-4">
                    <div class="shrink-0">
                        @if(isset($perangkat) && $perangkat->foto)
                            <img id="previewFoto" src="{{ asset('storage/'.$perangkat->foto) }}" class="w-16 h-16 rounded-full object-cover ring-2 ring-slate-200 dark:ring-slate-700 shadow-sm">
                        @else
                            <img id="previewFoto" src="{{ asset('images/avatar-default.png') }}" class="w-16 h-16 rounded-full object-cover ring-2 ring-slate-200 dark:ring-slate-700 shadow-sm">
                        @endif
                    </div>
                    <div class="flex-1">
                        <input type="file" id="foto" name="foto" accept="image/*" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3 py-2 transition-colors shadow-sm cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-primary-light file:text-primary hover:file:bg-primary/20 file:cursor-pointer dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:file:bg-primary-950/60 dark:file:text-primary-300">
                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Format: JPG, PNG (Maks: 2MB). Kosongkan jika tidak ingin mengubah foto.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- KANAN: Data Pribadi & SK --}}
    <div class="space-y-6">
        
        <div>
            <div class="pb-3 border-b border-slate-100 mb-6 dark:border-slate-800">
                <h3 class="font-bold text-slate-800 text-base dark:text-slate-100">Data Pribadi</h3>
            </div>
            <div class="space-y-6">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- TTL --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" placeholder="Contoh: Makassar" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" value="{{ old('tempat_lahir', $perangkat->tempat_lahir ?? '') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" value="{{ old('tanggal_lahir', $perangkat->tanggal_lahir ?? '') }}">
                    </div>

                    {{-- Jenis Kelamin & Agama --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                            <option value="">-- Pilih --</option>
                            <option value="L" @selected(old('jenis_kelamin', $perangkat->jenis_kelamin ?? '')=='L')>Laki-laki</option>
                            <option value="P" @selected(old('jenis_kelamin', $perangkat->jenis_kelamin ?? '')=='P')>Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Agama</label>
                        <select name="agama" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                            <option value="">-- Pilih --</option>
                            @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu', 'Lainnya'] as $agm)
                                <option value="{{ $agm }}" @selected(old('agama', $perangkat->agama ?? '') == $agm)>{{ $agm }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    {{-- Pendidikan & Pangkat --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Pendidikan Terakhir</label>
                        <select name="pendidikan" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                            <option value="">-- Pilih --</option>
                            @foreach(['Tidak Sekolah', 'SD / Sederajat', 'SMP / Sederajat', 'SMA / SMK / MA', 'Diploma I (D1)', 'Diploma II (D2)', 'Diploma III (D3)', 'Diploma IV (D4)', 'Sarjana (S1)', 'Magister (S2)', 'Doktor (S3)'] as $pend)
                                <option value="{{ $pend }}" @selected(old('pendidikan', $perangkat->pendidikan ?? '') == $pend)>{{ $pend }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Pangkat / Golongan</label>
                        <input type="text" name="pangkat_golongan" placeholder="Contoh: Penata / IIIc" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" value="{{ old('pangkat_golongan', $perangkat->pangkat_golongan ?? '') }}">
                    </div>
                </div>

            </div>
        </div>
        
        <div>
            <div class="pb-3 border-b border-slate-100 mb-6 dark:border-slate-800">
                <h3 class="font-bold text-slate-800 text-base dark:text-slate-100">Status & Keputusan</h3>
            </div>
            <div class="space-y-6">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Nomor SK Pengangkatan</label>
                        <input type="text" name="no_sk_pengangkatan" placeholder="Masukkan nomor SK..." class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" value="{{ old('no_sk_pengangkatan', $perangkat->no_sk_pengangkatan ?? '') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Tanggal SK Pengangkatan</label>
                        <input type="date" name="tanggal_sk_pengangkatan" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" value="{{ old('tanggal_sk_pengangkatan', $perangkat->tanggal_sk_pengangkatan ?? '') }}">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Nomor SK Pemberhentian</label>
                        <input type="text" name="no_sk_pemberhentian" placeholder="Masukkan nomor SK..." class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" value="{{ old('no_sk_pemberhentian', $perangkat->no_sk_pemberhentian ?? '') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Tanggal SK Pemberhentian</label>
                        <input type="date" name="tanggal_sk_pemberhentian" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" value="{{ old('tanggal_sk_pemberhentian', $perangkat->tanggal_sk_pemberhentian ?? '') }}">
                    </div>
                </div>

                <div class="pt-2 border-t border-slate-100 dark:border-slate-800">
                    <label class="flex items-center gap-3 cursor-pointer p-3 rounded-xl bg-slate-50 hover:bg-slate-100 transition-colors border border-slate-200 mt-2 dark:bg-slate-800 dark:border-slate-700 dark:hover:bg-slate-700/60">
                        <input type="checkbox" name="aktif" value="1" class="w-5 h-5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-600 focus:ring-2 dark:border-slate-600 dark:bg-slate-900" @checked(old('aktif', $perangkat->aktif ?? true))>
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-slate-800 dark:text-slate-100">Masih Aktif Menjabat</span>
                            <span class="text-xs text-slate-500 dark:text-slate-400">Hilangkan centang apabila perangkat sudah tidak aktif.</span>
                        </div>
                    </label>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Keterangan</label>
                    <textarea name="keterangan" rows="3" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" placeholder="Contoh: Pindah tugas, mutasi, pensiun...">{{ old('keterangan', $perangkat->keterangan ?? '') }}</textarea>
                </div>

            </div>
        </div>

    </div>

</div>

<script>
document.getElementById('foto')?.addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewFoto').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>