@csrf

<div class="card shadow-sm">

    <div class="card-body">

        <div class="row g-3">

            {{-- =========================
                 KODE SURAT
            ========================== --}}
            <div class="col-md-4">

                <label class="form-label">
                    Kode Surat <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="kode"
                    class="form-control @error('kode') is-invalid @enderror"
                    value="{{ old('kode', $jenisSurat->kode ?? '') }}"
                    placeholder="Contoh : SKTM">

                @error('kode')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            {{-- =========================
                 KODE NOMOR
            ========================== --}}
            <div class="col-md-4">

                <label class="form-label">
                    Kode Nomor Surat
                </label>

                <input
                    type="text"
                    name="kode_nomor"
                    class="form-control @error('kode_nomor') is-invalid @enderror"
                    value="{{ old('kode_nomor', $jenisSurat->kode_nomor ?? '') }}"
                    placeholder="Contoh : 470">

                <div class="form-text">

                    Digunakan pada nomor surat.
                    Contoh:
                    470/001/KLB/VII/2026

                </div>

                @error('kode_nomor')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            {{-- =========================
                 NOMOR URUT
            ========================== --}}
            <div class="col-md-4">

                <label class="form-label">
                    Nomor Urut Awal
                </label>

                <input
                    type="number"
                    min="0"
                    name="nomor_urut"
                    class="form-control @error('nomor_urut') is-invalid @enderror"
                    value="{{ old('nomor_urut', $jenisSurat->nomor_urut ?? 0) }}">

                <div class="form-text">

                    Nomor terakhir yang telah digunakan.

                </div>

                @error('nomor_urut')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            {{-- =========================
                 NAMA SURAT
            ========================== --}}
            <div class="col-12">

                <label class="form-label">
                    Nama Surat <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="nama"
                    class="form-control @error('nama') is-invalid @enderror"
                    value="{{ old('nama', $jenisSurat->nama ?? '') }}"
                    placeholder="Masukkan nama surat">

                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

{{-- =========================
     PERSYARATAN LAYANAN
     (Ditampilkan pada card layanan di website)
========================== --}}
<div class="col-12">

    <label class="form-label">
        Persyaratan Layanan
    </label>

    <textarea
        rows="4"
        name="deskripsi"
        class="form-control @error('deskripsi') is-invalid @enderror"
        placeholder="Contoh: KTP, KK, dan surat pengantar RT/RW.">{{ old('deskripsi', $jenisSurat->deskripsi ?? '') }}</textarea>

    <div class="form-text">
        Masukkan persyaratan singkat yang akan ditampilkan pada kartu layanan di halaman utama website.
    </div>

    @error('deskripsi')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>

            {{-- =========================
                 TEMPLATE VIEW
            ========================== --}}
            <div class="col-12">

                <label class="form-label">
                    Template View
                </label>

                <input
                    type="text"
                    name="template_view"
                    class="form-control @error('template_view') is-invalid @enderror"
                    value="{{ old('template_view', $jenisSurat->template_view ?? '') }}"
                    placeholder="admin.pelayanan.surat.domisili">

                <div class="form-text">

                    Gunakan nama Blade Laravel.

                    Contoh:

                    <strong>admin.pelayanan.surat.domisili</strong>

                </div>

                @error('template_view')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            {{-- =========================
                 STATUS
            ========================== --}}
            <div class="col-12">

                <div class="form-check">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="aktif"
                        name="aktif"
                        value="1"
                        {{ old('aktif', $jenisSurat->aktif ?? true) ? 'checked' : '' }}>

                    <label
                        class="form-check-label"
                        for="aktif">

                        Aktif

                    </label>

                </div>

            </div>

        </div>

    </div>

    <div class="card-footer bg-white d-flex justify-content-end gap-2">

        <a
            href="{{ route('admin.jenis-surat.index') }}"
            class="btn btn-secondary">

            Kembali

        </a>

        <button
            type="submit"
            class="btn btn-primary">

            <i class="fa-solid fa-circle-check"></i>

            Simpan

        </button>

    </div>

</div>