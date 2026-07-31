<div class="row g-3">

    {{-- NIK --}}
    <div class="col-md-6">
        <label class="form-label">NIK <span class="text-danger">*</span></label>
        <input
            type="text"
            name="nik"
            class="form-control"
            value="{{ old('nik', $penduduk->nik ?? '') }}"
            maxlength="16"
            required>
    </div>

    {{-- Nama Lengkap --}}
    <div class="col-md-6">
        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
        <input
            type="text"
            name="nama_lengkap"
            class="form-control"
            value="{{ old('nama_lengkap', $penduduk->nama_lengkap ?? '') }}"
            required>
    </div>

    {{-- Jenis Kelamin --}}
    <div class="col-md-6">
        <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>

        <select name="jenis_kelamin" class="form-select" required>
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
    <div class="col-md-6">
        <label class="form-label">Lingkungan</label>

        <select name="lingkungan_id" class="form-select">
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
    <div class="col-md-6">
    <label class="form-label">
        Kartu Keluarga
    </label>

    <select
        name="kartu_keluarga_id"
        class="form-select">

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
<div class="col-md-6">

    <label class="form-label">

        Hubungan Dalam Keluarga

    </label>

    <select
        name="hubungan_keluarga"
        class="form-select">

        <option value="">
            Pilih Hubungan
        </option>

        <option value="Kepala Keluarga">Kepala Keluarga</option>
        <option value="Istri">Istri</option>
        <option value="Suami">Suami</option>
        <option value="Anak">Anak</option>
        <option value="Orang Tua">Orang Tua</option>
        <option value="Menantu">Menantu</option>
        <option value="Cucu">Cucu</option>
        <option value="Famili Lain">Famili Lain</option>

    </select>

</div>

    {{-- Tempat Lahir --}}
    <div class="col-md-6">
        <label class="form-label">Tempat Lahir</label>
        <input
            type="text"
            name="tempat_lahir"
            class="form-control"
            value="{{ old('tempat_lahir', $penduduk->tempat_lahir ?? '') }}">
    </div>

    {{-- Tanggal Lahir --}}
    <div class="col-md-6">
        <label class="form-label">Tanggal Lahir</label>
        <input
            type="date"
            name="tanggal_lahir"
            class="form-control"
            value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir ?? '') }}">
    </div>

    {{-- Agama --}}
    <div class="col-md-6">
    <label class="form-label">Agama</label>

    <select name="agama" class="form-select">
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
    <div class="col-md-6">
    <label class="form-label">Status Perkawinan</label>

    <select
        name="status_perkawinan"
        class="form-select">

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
    <div class="col-md-6">
    <label class="form-label">Pendidikan</label>

    <select name="pendidikan" class="form-select">
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
    <div class="col-md-6">
    <label class="form-label">Pekerjaan</label>

    <select name="pekerjaan" class="form-select">
        <option value="">Pilih Pekerjaan</option>

        @php
            $pekerjaanList = [
                'Belum/Tidak Bekerja',
                'Mengurus Rumah Tangga',
                'Pelajar/Mahasiswa',
                'Pensiunan',
                'Pegawai Negeri Sipil (PNS)',
                'Tentara Nasional Indonesia (TNI)',
                'Kepolisian RI (POLRI)',
                'Perdagangan',
                'Petani/Pekebun',
                'Peternak',
                'Nelayan/Perikanan',
                'Karyawan Swasta',
                'Wiraswasta',
                'Buruh Harian Lepas',
                'Guru',
                'Dosen',
                'Perawat',
                'Bidan',
                'Dokter',
                'Perangkat Desa/Kelurahan',
                'Lainnya',
            ];
        @endphp

        @foreach ($pekerjaanList as $item)
            <option value="{{ $item }}"
                {{ old('pekerjaan', $penduduk->pekerjaan ?? '') == $item ? 'selected' : '' }}>
                {{ $item }}
            </option>
        @endforeach
    </select>
</div>

    {{-- Alamat --}}
    <div class="col-12">
        <label class="form-label">Alamat</label>
        <textarea
            name="alamat"
            rows="3"
            class="form-control">{{ old('alamat', $penduduk->alamat ?? '') }}</textarea>
    </div>

    {{-- RT --}}
    <div class="col-md-3">
        <label class="form-label">RT</label>
        <input
            type="text"
            name="rt"
            class="form-control"
            value="{{ old('rt', $penduduk->rt ?? '') }}"
            placeholder="00">
    </div>

    {{-- RW --}}
    <div class="col-md-3">
        <label class="form-label">RW</label>
        <input
            type="text"
            name="rw"
            class="form-control"
            value="{{ old('rw', $penduduk->rw ?? '') }}"
            placeholder="00">
    </div>

    {{-- Telepon --}}
    <div class="col-md-6">
        <label class="form-label">No. Telepon</label>
        <input
            type="text"
            name="telepon"
            class="form-control"
            value="{{ old('telepon', $penduduk->telepon ?? '') }}">
    </div>

    {{-- Email --}}
    <div class="col-md-4">
        <label class="form-label">Email</label>
        <input
    type="email"
    name="email"
    class="form-control"
    value="{{ old('email', $penduduk->email ?? '') }}"

    {{-- Status Validasi --}}
    <div class="col-md-4">
        <label class="form-label">Status Validasi Alamat</label>

        <select name="status_validasi_alamat" class="form-select">
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
    <div class="col-md-4">
        <label class="form-label">Status Penduduk</label>

        <select name="aktif" class="form-select">
            <option value="1"
                {{ old('aktif', $penduduk->aktif ?? 1) == 1 ? 'selected' : '' }}>
                Aktif
            </option>

            <option value="0"
                {{ old('aktif', $penduduk->aktif ?? 1) == 0 ? 'selected' : '' }}>
                Tidak Aktif
            </option>
        </select>
    </div>

</div>