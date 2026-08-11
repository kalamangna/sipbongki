<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">
            Pemohon <span class="text-danger">*</span>
        </label>
        <select
            id="penduduk_id"
            name="penduduk_id"
            class="form-select @error('penduduk_id') is-invalid @enderror"
            required>
            <option value="">-- Pilih Penduduk --</option>
            @foreach($penduduks as $penduduk)
                <option
                    value="{{ $penduduk->id }}"
                    @selected(old('penduduk_id') == $penduduk->id)>
                    {{ $penduduk->nik }} - {{ $penduduk->nama_lengkap }}
                </option>
            @endforeach
        </select>

        @error('penduduk_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">
            Jenis Surat <span class="text-danger">*</span>
        </label>
        <select
            id="jenis_surat_id"
            name="jenis_surat_id"
            class="form-select @error('jenis_surat_id') is-invalid @enderror"
            required>
            <option value="">-- Pilih Jenis Surat --</option>
            @foreach($jenisSurats as $jenis)
                <option
                    value="{{ $jenis->id }}"
                    @selected(old('jenis_surat_id') == $jenis->id)>
                    {{ $jenis->nama }}
                </option>
            @endforeach
        </select>

        @error('jenis_surat_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">
            Keperluan <span class="text-danger">*</span>
        </label>
        <textarea
            name="keperluan"
            rows="4"
            class="form-control @error('keperluan') is-invalid @enderror"
            placeholder="Tuliskan keperluan permohonan surat..."
            required>{{ old('keperluan') }}</textarea>

        @error('keperluan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
