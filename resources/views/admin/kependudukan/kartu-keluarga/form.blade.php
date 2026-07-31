<div class="row g-3">

    <div class="col-md-6">
        <label class="form-label">Nomor KK</label>
        <input
            type="text"
            name="no_kk"
            class="form-control"
            value="{{ old('no_kk', $kartuKeluarga->no_kk ?? '') }}"
            required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Kepala Keluarga</label>

        <select
            name="kepala_keluarga_id"
            class="form-select">

            <option value="">Pilih Kepala Keluarga</option>

            @foreach($penduduks as $penduduk)
                <option
                    value="{{ $penduduk->id }}"
                    {{ old('kepala_keluarga_id', $kartuKeluarga->kepala_keluarga_id ?? '') == $penduduk->id ? 'selected' : '' }}>
                    {{ $penduduk->nik }} -
                    {{ $penduduk->nama_lengkap }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-12">
        <label class="form-label">Alamat</label>

        <textarea
            name="alamat"
            class="form-control"
            rows="3">{{ old('alamat', $kartuKeluarga->alamat ?? '') }}</textarea>
    </div>

    <div class="col-md-3">
        <label class="form-label">RT</label>

        <input
            type="text"
            name="rt"
            class="form-control"
            value="{{ old('rt', $kartuKeluarga->rt ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label">RW</label>

        <input
            type="text"
            name="rw"
            class="form-control"
            value="{{ old('rw', $kartuKeluarga->rw ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label">Lingkungan</label>

        <select
            name="lingkungan_id"
            class="form-select">

            <option value="">Pilih Lingkungan</option>

            @foreach($lingkungans as $lingkungan)
                <option
                    value="{{ $lingkungan->id }}"
                    {{ old('lingkungan_id', $kartuKeluarga->lingkungan_id ?? '') == $lingkungan->id ? 'selected' : '' }}>
                    {{ $lingkungan->nama }}
                </option>
            @endforeach
        </select>
    </div>

</div>