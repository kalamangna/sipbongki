<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- NIK --}}
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">NIK <span class="text-red-500">*</span></label>
        <input
            type="text"
            name="nik" placeholder="Contoh: 7371112233445566"
            class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
            value="{{ old('nik', $penduduk->nik ?? '') }}"
            maxlength="16"
            required>
    </div>

    {{-- Nama Lengkap --}}
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Nama Lengkap <span class="text-red-500">*</span></label>
        <input
            type="text"
            name="nama_lengkap" placeholder="Masukkan nama lengkap sesuai KTP"
            class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
            value="{{ old('nama_lengkap', $penduduk->nama_lengkap ?? '') }}"
            required>
    </div>

    {{-- Jenis Kelamin --}}
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Jenis Kelamin <span class="text-red-500">*</span></label>

        <select name="jenis_kelamin" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" required>
            <option value="">Pilih</option>
            <option value="L"
                {{ old('jenis_kelamin', $penduduk->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>
                Laki-laki
            </option>
            <option value="P"
                {{ old('jenis_kelamin', $penduduk->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>
                Perempuan
            </option>
        </select>
    </div>

    {{-- Lingkungan --}}
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Lingkungan</label>

        <select name="lingkungan_id" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
            <option value="">Pilih Lingkungan</option>

            @foreach($lingkungans as $lingkungan)
                <option
                    value="{{ $lingkungan->id }}"
                    {{ old('lingkungan_id', $penduduk->lingkungan_id ?? '') == $lingkungan->id ? 'selected' : '' }}>
                    {{ $lingkungan->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
    <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">
        Kartu Keluarga
    </label>

    <select
        name="kartu_keluarga_id"
        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">

        <option value="">
            Pilih Kartu Keluarga
        </option>

        @foreach($kartuKeluargas as $kk)

            <option
                value="{{ $kk->id }}"
                {{ old('kartu_keluarga_id', $penduduk->kartu_keluarga_id ?? '') == $kk->id ? 'selected' : '' }}>

                {{ $kk->no_kk }}
                @if($kk->kepalaKeluarga)
                    - {{ $kk->kepalaKeluarga->nama_lengkap }}
                @endif

            </option>

        @endforeach

    </select>
</div>

<div>
    <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">
        Hubungan Dalam Keluarga
    </label>

    <select name="hubungan_keluarga" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">

        <option value="">Pilih Hubungan</option>

        <option value="Kepala Keluarga"
            {{ old('hubungan_keluarga', $penduduk->hubungan_keluarga ?? '') == 'Kepala Keluarga' ? 'selected' : '' }}>
            Kepala Keluarga
        </option>

        <option value="Istri"
            {{ old('hubungan_keluarga', $penduduk->hubungan_keluarga ?? '') == 'Istri' ? 'selected' : '' }}>
            Istri
        </option>

        <option value="Suami"
            {{ old('hubungan_keluarga', $penduduk->hubungan_keluarga ?? '') == 'Suami' ? 'selected' : '' }}>
            Suami
        </option>

        <option value="Anak"
            {{ old('hubungan_keluarga', $penduduk->hubungan_keluarga ?? '') == 'Anak' ? 'selected' : '' }}>
            Anak
        </option>

        <option value="Orang Tua"
            {{ old('hubungan_keluarga', $penduduk->hubungan_keluarga ?? '') == 'Orang Tua' ? 'selected' : '' }}>
            Orang Tua
        </option>

        <option value="Menantu"
            {{ old('hubungan_keluarga', $penduduk->hubungan_keluarga ?? '') == 'Menantu' ? 'selected' : '' }}>
            Menantu
        </option>

        <option value="Cucu"
            {{ old('hubungan_keluarga', $penduduk->hubungan_keluarga ?? '') == 'Cucu' ? 'selected' : '' }}>
            Cucu
        </option>

        <option value="Famili Lain"
            {{ old('hubungan_keluarga', $penduduk->hubungan_keluarga ?? '') == 'Famili Lain' ? 'selected' : '' }}>
            Famili Lain
        </option>

    </select>
</div>

    {{-- Tempat Lahir --}}
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Tempat Lahir</label>
        <input
            type="text"
            name="tempat_lahir" placeholder="Contoh: Makassar"
            class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
            value="{{ old('tempat_lahir', $penduduk->tempat_lahir ?? '') }}">
    </div>

   {{-- Tanggal Lahir --}}
<div>
    <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Tanggal Lahir</label>

    <input
        type="date"
        name="tanggal_lahir"
        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
        value="{{ old('tanggal_lahir', optional($penduduk->tanggal_lahir)->format('Y-m-d')) }}">
</div>

    {{-- Agama --}}
    <div>
    <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Agama</label>

    <select name="agama" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
        <option value="">Pilih Agama</option>

        <option value="Islam"
            {{ old('agama', $penduduk->agama ?? '') == 'Islam' ? 'selected' : '' }}>
            Islam
        </option>

        <option value="Kristen"
            {{ old('agama', $penduduk->agama ?? '') == 'Kristen' ? 'selected' : '' }}>
            Kristen
        </option>

        <option value="Katolik"
            {{ old('agama', $penduduk->agama ?? '') == 'Katolik' ? 'selected' : '' }}>
            Katolik
        </option>

        <option value="Hindu"
            {{ old('agama', $penduduk->agama ?? '') == 'Hindu' ? 'selected' : '' }}>
            Hindu
        </option>

        <option value="Buddha"
            {{ old('agama', $penduduk->agama ?? '') == 'Buddha' ? 'selected' : '' }}>
            Buddha
        </option>

        <option value="Konghucu"
            {{ old('agama', $penduduk->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>
            Konghucu
        </option>
    </select>
</div>

    {{-- Status Perkawinan --}}
    <div>
    <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Status Perkawinan</label>

    <select
        name="status_perkawinan"
        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">

        <option value="">Pilih Status</option>

        <option value="Belum Kawin"
            {{ old('status_perkawinan', $penduduk->status_perkawinan ?? '') == 'Belum Kawin' ? 'selected' : '' }}>
            Belum Kawin
        </option>

        <option value="Kawin"
            {{ old('status_perkawinan', $penduduk->status_perkawinan ?? '') == 'Kawin' ? 'selected' : '' }}>
            Kawin
        </option>

        <option value="Cerai Hidup"
            {{ old('status_perkawinan', $penduduk->status_perkawinan ?? '') == 'Cerai Hidup' ? 'selected' : '' }}>
            Cerai Hidup
        </option>

        <option value="Cerai Mati"
            {{ old('status_perkawinan', $penduduk->status_perkawinan ?? '') == 'Cerai Mati' ? 'selected' : '' }}>
            Cerai Mati
        </option>
    </select>
</div>

    {{-- Pendidikan --}}
    <div>
    <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Pendidikan</label>

    <select name="pendidikan" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
        <option value="">Pilih Pendidikan</option>

        @php
            $pendidikanList = [
                'Tidak/Belum Sekolah',
                'Belum Tamat SD/Sederajat',
                'SD/Sederajat',
                'SMP/Sederajat',
                'SMA/Sederajat',
                'Diploma I',
                'Diploma II',
                'Diploma III',
                'Diploma IV/S1',
                'S2',
                'S3',
            ];
        @endphp

        @foreach ($pendidikanList as $item)
            <option value="{{ $item }}"
                {{ old('pendidikan', $penduduk->pendidikan ?? '') == $item ? 'selected' : '' }}>
                {{ $item }}
            </option>
        @endforeach
    </select>
</div>

    {{-- Pekerjaan --}}
    <div>
    <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Pekerjaan</label>

    <select name="pekerjaan" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
        <option value="">Pilih Pekerjaan</option>

        @foreach(\App\Models\Penduduk::pekerjaanList() as $item)
            <option value="{{ $item }}"
                {{ old('pekerjaan', $penduduk->pekerjaan ?? '') == $item ? 'selected' : '' }}>
                {{ $item }}
            </option>
        @endforeach
    </select>
</div>

    {{-- Alamat --}}
    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Alamat</label>
        <textarea
            name="alamat" placeholder="Masukkan nama jalan, lorong, atau patokan rumah..."
            rows="3"
            class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">{{ old('alamat', $penduduk->alamat ?? '') }}</textarea>
    </div>

    {{-- RT --}}
    <div  >
        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">RT</label>
        <input
            type="text"
            name="rt"
            class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
            value="{{ old('rt', $penduduk->rt ?? '') }}"
            placeholder="00">
    </div>

    {{-- RW --}}
    <div  >
        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">RW</label>
        <input
            type="text"
            name="rw"
            class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
            value="{{ old('rw', $penduduk->rw ?? '') }}"
            placeholder="00">
    </div>

    {{-- Telepon --}}
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">No. Telepon</label>
        <input
            type="text"
            name="telepon" placeholder="Contoh: 081234567890"
            class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
            value="{{ old('telepon', $penduduk->telepon ?? '') }}">
    </div>

 {{-- Email --}}
<div  >
    <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Email</label>
    <input
        type="email"
        name="email" placeholder="Contoh: email@domain.com"
        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
        value="{{ old('email', $penduduk->email ?? '') }}">
</div>

{{-- Status Validasi --}}
<div  >
    <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Status Validasi Alamat</label>

    <select name="status_validasi_alamat" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
        <option value="Valid"
            {{ old('status_validasi_alamat', $penduduk->status_validasi_alamat ?? '') == 'Valid' ? 'selected' : '' }}>
            Valid
        </option>

        <option value="Perlu Verifikasi"
            {{ old('status_validasi_alamat', $penduduk->status_validasi_alamat ?? 'Perlu Verifikasi') == 'Perlu Verifikasi' ? 'selected' : '' }}>
            Perlu Verifikasi
        </option>
    </select>
</div>

{{-- Status Penduduk --}}
<div  >
    <label class="block text-sm font-semibold text-slate-700 mb-1.5 dark:text-slate-300">Status Penduduk</label>

    <select name="aktif" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
        <option value="1"
            {{ old('aktif', $penduduk->aktif ?? 1) == 1 ? 'selected' : '' }}>
            Aktif
        </option>

        <option value="0"
            {{ old('aktif', $penduduk->aktif ?? 1) == 0 ? 'selected' : '' }}>
            Tidak Aktif
        </option>
    </select>
</div></div>
