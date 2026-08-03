@csrf

<div class="row">

    {{-- Pemohon --}}
    <div id="pemohon-field" class="col-md-6 mb-3">

        <label class="form-label">
            Pemohon <span class="text-danger">*</span>
        </label>

        <select
        id="penduduk_id"
        name="penduduk_id"
        class="form-select @error('penduduk_id') is-invalid @enderror">

            <option value="">-- Pilih Penduduk --</option>

            @foreach($penduduks as $penduduk)
                <option
                    value="{{ $penduduk->id }}"
                    @selected(old('penduduk_id', $permohonanSurat->penduduk_id ?? '') == $penduduk->id)>

                    {{ $penduduk->nik }} - {{ $penduduk->nama_lengkap }}

                </option>
            @endforeach

        </select>

        @error('penduduk_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Jenis Surat --}}
    <div class="col-md-6 mb-3">

        <label class="form-label">
            Jenis Surat <span class="text-danger">*</span>
        </label>

        <select
            name="jenis_surat_id"
            class="form-select @error('jenis_surat_id') is-invalid @enderror"
            required>

            <option value="">-- Pilih Jenis Surat --</option>

            @foreach($jenisSurats as $jenis)

                <option
                    value="{{ $jenis->id }}"
                    @selected(old('jenis_surat_id', $permohonanSurat->jenis_surat_id ?? '') == $jenis->id)>

                    {{ $jenis->nama }}

                </option>

            @endforeach

        </select>

        @error('jenis_surat_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>
    {{-- =========================================================
| DATA USAHA
| Hanya untuk Surat Keterangan Usaha
========================================================= --}}
<div id="usaha-fields" class="card border-0 shadow-sm mb-3" style="display:none;">

    <div class="card-header bg-light">
        <strong>Data Usaha</strong>
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Nama Usaha <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="nama_usaha"
                    class="form-control"
                    value="{{ old('nama_usaha', $permohonanSurat->data_surat['nama_usaha'] ?? '') }}">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Jenis Usaha <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="jenis_usaha"
                    class="form-control"
                    placeholder="Contoh : Warung Sembako"
                    value="{{ old('jenis_usaha', $permohonanSurat->data_surat['jenis_usaha'] ?? '') }}">

            </div>

        </div>

        <div class="row">

            <div class="col-md-8 mb-3">

                <label class="form-label">
                    Alamat Usaha
                </label>

                <textarea
                    name="alamat_usaha"
                    rows="2"
                    class="form-control">{{ old('alamat_usaha', $permohonanSurat->data_surat['alamat_usaha'] ?? '') }}</textarea>

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Lama Usaha
                </label>

                <input
                    type="text"
                    name="lama_usaha"
                    class="form-control"
                    placeholder="Contoh : 5 Tahun"
                    value="{{ old('lama_usaha', $permohonanSurat->data_surat['lama_usaha'] ?? '') }}">

            </div>

        </div>

    </div>

</div>

{{-- =========================================================
| DATA KEMATIAN
| Hanya untuk Surat Keterangan Kematian
========================================================= --}}

<div id="kematian-fields" class="mb-4" style="display:none;">

    {{-- =========================================================
    | DATA ALMARHUM / ALMARHUMAH
    ========================================================= --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-light">
            <strong>Data Almarhum</strong>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-12 mb-3">

                    <label class="form-label">
                        Almarhum 
                        <span class="text-danger">*</span>
                    </label>

                    <select
    id="penduduk_id_kematian"
    name="almarhum_id"
    class="form-select">

                        <option value="">-- Pilih Penduduk --</option>

                        @foreach($penduduks as $penduduk)

                            <option
                                value="{{ $penduduk->id }}"
                                @selected(old('penduduk_id') == $penduduk->id)>
                                

                                {{ $penduduk->nik }} - {{ $penduduk->nama_lengkap }}

                            </option>

                        @endforeach

                    </select>

                </div>
<div class="col-md-6 mb-3">

    <label class="form-label">
        Hari Meninggal
        <span class="text-danger">*</span>
    </label>

    <select
    name="hari_meninggal"
    class="form-select">

    <option value="">
        -- Pilih Hari --
    </option>

    <option value="Senin"
        @selected(old('hari_meninggal') == 'Senin')>
        Senin
    </option>

    <option value="Selasa"
        @selected(old('hari_meninggal') == 'Selasa')>
        Selasa
    </option>

    <option value="Rabu"
        @selected(old('hari_meninggal') == 'Rabu')>
        Rabu
    </option>

    <option value="Kamis"
        @selected(old('hari_meninggal') == 'Kamis')>
        Kamis
    </option>

    <option value="Jumat"
        @selected(old('hari_meninggal') == 'Jumat')>
        Jumat
    </option>

    <option value="Sabtu"
        @selected(old('hari_meninggal') == 'Sabtu')>
        Sabtu
    </option>

    <option value="Minggu"
        @selected(old('hari_meninggal') == 'Minggu')>
        Minggu
    </option>

</select>

</div>

<div class="col-md-6 mb-3">

    <label class="form-label">
        Tanggal Meninggal
        <span class="text-danger">*</span>
    </label>

    <input
        type="date"
        name="tanggal_meninggal"
        class="form-control"
        value="{{ old('tanggal_meninggal') }}">

</div>

<div class="col-md-6 mb-3">

    <label class="form-label">
        Jam Meninggal
    </label>

    <input
        type="time"
        name="jam_meninggal"
        class="form-control"
        value="{{ old('jam_meninggal') }}">

</div>

<div class="col-md-6 mb-3">

    <label class="form-label">
        Tempat Meninggal
        <span class="text-danger">*</span>
    </label>

    <input
        type="text"
        name="tempat_meninggal"
        class="form-control"
        value="{{ old('tempat_meninggal') }}">

</div>

<div class="col-12 mb-3">

    <label class="form-label">
        Penyebab Kematian
        <span class="text-danger">*</span>
    </label>

    <textarea
        name="penyebab_kematian"
        rows="3"
        class="form-control">{{ old('penyebab_kematian') }}</textarea>

</div>
            </div>

        </div>

    </div>

   

    {{-- =========================================================
    | DATA PELAPOR
    ========================================================= --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-light">
            <strong>Data Pelapor</strong>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Pelapor
                        <span class="text-danger">*</span>
                    </label>

                   <select
                        id="pelapor_id"
                        name="pelapor_id"
                        class="form-select">

                        <option value="">-- Pilih Penduduk --</option>

                        @foreach($penduduks as $penduduk)

                            <option
                                value="{{ $penduduk->id }}"
                                @selected(old('pelapor_id') == $penduduk->id)>

                                {{ $penduduk->nik }} - {{ $penduduk->nama_lengkap }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Hubungan dengan Almarhum / Almarhumah
                    </label>

                    <select
                        name="hubungan_pelapor"
                        class="form-select">

                        <option value="">-- Pilih Hubungan --</option>

                        <option value="Suami"
                        @selected(old('hubungan_pelapor') == 'Suami')>
                        Suami
                        </option>

                        <option value="Istri"
                        @selected(old('hubungan_pelapor') == 'Istri')>
                        Istri
                        </option>

                        <option value="Ayah"
                        @selected(old('hubungan_pelapor') == 'Ayah')>
                        Ayah
                        </option>

                        <option value="Ibu"
                        @selected(old('hubungan_pelapor') == 'Ibu')>
                        Ibu
                        </option>
                       
                       <option value="Anak"
                        @selected(old('hubungan_pelapor') == 'Anak')>
                        Anak
                        </option>
                       
                        <option value="Saudara"
                        @selected(old('hubungan_pelapor') == 'Saudara')>
                        Saudara
                        </option>

                        <option value="Keluarga"
                        @selected(old('hubungan_pelapor') == 'Keluarga')>
                        keluarga
                        </option>

                        <option value="Tetangga"
                        @selected(old('hubungan_pelapor') == 'Tetangga')>
                        Tetangga
                        </option>

                        <option value="Lainnya"
                        @selected(old('hubungan_pelapor') == 'Lainnya')>
                        Lainnya
                        </option>

                    </select>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- =========================================================
| DATA ORANG YANG SAMA
========================================================= --}}

<div id="orang-sama-fields" class="card border-0 shadow-sm mb-3" style="display:none;">

    <div class="card-header bg-light">
        <strong>
            Data Dokumen Orang Yang Sama
        </strong>
    </div>


    <div class="card-body">


        <div class="row">


            {{-- Nama dalam dokumen lain --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Nama Dalam Dokumen Lain
                    <span class="text-danger">*</span>
                </label>


                <input
                    type="text"
                    name="nama_lain"
                    class="form-control"
                    placeholder="Contoh: ABDUL RAHMAN"
                    value="{{ old('nama_lain', $permohonanSurat->data_surat['nama_lain'] ?? '') }}">


            </div>



            {{-- Jenis Dokumen --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Jenis Dokumen
                    <span class="text-danger">*</span>
                </label>


                <input
                    type="text"
                    name="jenis_dokumen"
                    class="form-control"
                    placeholder="Contoh: Sertifikat Hak Milik"
                    value="{{ old('jenis_dokumen', $permohonanSurat->data_surat['jenis_dokumen'] ?? '') }}">


            </div>


        </div>



        <div class="row">


            {{-- Nomor Dokumen --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Nomor Dokumen
                    <span class="text-danger">*</span>
                </label>


                <input
                    type="text"
                    name="nomor_dokumen"
                    class="form-control"
                    placeholder="Contoh: SHM No. 1234"
                    value="{{ old('nomor_dokumen', $permohonanSurat->data_surat['nomor_dokumen'] ?? '') }}">


            </div>



            {{-- Keterangan --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Keterangan Perbedaan
                </label>


                <input
                    type="text"
                    name="keterangan_perbedaan"
                    class="form-control"
                    placeholder="Contoh: Perbedaan penulisan nama"
                    value="{{ old('keterangan_perbedaan', $permohonanSurat->data_surat['keterangan_perbedaan'] ?? '') }}">


            </div>


        </div>


    </div>


</div>

<div class="row">

    {{-- Tanggal Permohonan --}}
    <div class="col-md-4 mb-3">

        <label class="form-label">
            Tanggal Permohonan
        </label>

        <input
            type="date"
            name="tanggal_permohonan"
            class="form-control @error('tanggal_permohonan') is-invalid @enderror"
            value="{{ old('tanggal_permohonan', isset($permohonanSurat) ? $permohonanSurat->tanggal_permohonan->format('Y-m-d') : date('Y-m-d')) }}">

        @error('tanggal_permohonan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

    {{-- Penandatangan --}}
    <div class="col-md-8 mb-5">

        <label class="form-label">
            Pejabat Penandatangan
            <span class="text-danger">*</span>
        </label>

        <select
            name="penandatangan_id"
            class="form-select @error('penandatangan_id') is-invalid @enderror"
            required>

            <option value="">
                -- Pilih Penandatangan --
            </option>

            @foreach($penandatangans as $item)

                <option
                    value="{{ $item->id }}"
                    @selected(old('penandatangan_id', $permohonanSurat->penandatangan_id ?? '') == $item->id)>

                    {{ $item->nama_lengkap }}
                    ({{ $item->jabatan->nama }})

                </option>

            @endforeach

        </select>

        @error('penandatangan_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

</div>

{{-- Keperluan --}}
<div class="mb-3">

    <label class="form-label">
        Keperluan
        <span class="text-danger">*</span>
    </label>

    <textarea
        name="keperluan"
        rows="4"
        class="form-control @error('keperluan') is-invalid @enderror"
        placeholder="Tuliskan keperluan permohonan surat...">{{ old('keperluan', $permohonanSurat->keperluan ?? '') }}</textarea>

    @error('keperluan')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>

{{-- Catatan --}}
<div class="mb-4">

    <label class="form-label">
        Catatan
    </label>

    <textarea
        name="catatan"
        rows="3"
        class="form-control @error('catatan') is-invalid @enderror"
        placeholder="Catatan tambahan (opsional)...">{{ old('catatan', $permohonanSurat->catatan ?? '') }}</textarea>

    @error('catatan')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>

<div class="d-flex justify-content-end">

    <a
        href="{{ route('admin.permohonan-surat.index') }}"
        class="btn btn-secondary me-2">

        <i class="fa-solid fa-arrow-left"></i>
        Kembali

    </a>

    <button
        type="submit"
        class="btn btn-primary">

        <i class="fa-solid fa-circle-check"></i>
        Simpan

    </button>

</div>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const jenisSurat = document.querySelector(
        'select[name="jenis_surat_id"]'
    );

    const usahaFields = document.getElementById(
        'usaha-fields'
    );

    const kematianFields = document.getElementById(
        'kematian-fields'
    );

    const orangSamaFields = document.getElementById(
        'orang-sama-fields'
    );

    const pemohonField = document.getElementById(
        'pemohon-field'
    );

    const pemohonSelect = document.querySelector(
        'select[name="penduduk_id"]'
    );

    const almarhumSelect = document.getElementById(
    'penduduk_id_kematian'
    );
    

    function toggleFields() {

        const selectedText =
            jenisSurat.options[jenisSurat.selectedIndex]
            ?.text
            .toLowerCase()
            .trim() || '';

        /*
        |--------------------------------------------------------------------------
        | DATA USAHA
        |--------------------------------------------------------------------------
        */

        if (selectedText.includes('usaha')) {

            usahaFields.style.display = 'block';

        } else {

            usahaFields.style.display = 'none';

        }

        /*
        |--------------------------------------------------------------------------
        | DATA KEMATIAN
        |--------------------------------------------------------------------------
        */

        if (selectedText.includes('kematian')) {

    kematianFields.style.display = 'block';

    if (pemohonField) {
        pemohonField.style.display = 'none';
    }

    if (pemohonSelect) {
        pemohonSelect.required = false;
    }

    if (almarhumSelect) {
        almarhumSelect.required = true;
    }

} else {

    kematianFields.style.display = 'none';

    if (pemohonField) {
        pemohonField.style.display = 'block';
    }

    if (pemohonSelect) {
        pemohonSelect.required = true;
    }

    if (almarhumSelect) {
        almarhumSelect.required = false;
    }

}

        /*
        |--------------------------------------------------------------------------
        | DATA ORANG YANG SAMA
        |--------------------------------------------------------------------------
        */

        if (selectedText.includes('orang yang sama')) {

            orangSamaFields.style.display = 'block';

        } else {

            orangSamaFields.style.display = 'none';

        }

    }

    /*
    |--------------------------------------------------------------------------
    | LOAD AWAL
    |--------------------------------------------------------------------------
    */

    toggleFields();

    /*
    |--------------------------------------------------------------------------
    | CHANGE JENIS SURAT
    |--------------------------------------------------------------------------
    */

    jenisSurat.addEventListener(
        'change',
        toggleFields
    );

});

</script>