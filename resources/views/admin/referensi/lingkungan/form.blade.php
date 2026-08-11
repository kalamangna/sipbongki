<div class="flex flex-wrap -mx-3">

    <div class="col-md-4 mb-4">

        <label class="form-label">Kode</label>

        <input
            type="text"
            name="kode"
            class="form-control @error('kode') is-invalid @enderror"
            value="{{ old('kode', $lingkungan->kode ?? '') }}">

        @error('kode')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

    <div class="col-md-8 mb-4">

        <label class="form-label">Nama Lingkungan</label>

        <input
            type="text"
            name="nama"
            class="form-control @error('nama') is-invalid @enderror"
            value="{{ old('nama', $lingkungan->nama ?? '') }}">

        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

</div>

<div class="flex flex-wrap -mx-3">

    <div class="w-full md:w-1/2 px-3 mb-4">

        <label class="form-label">Kepala Lingkungan</label>

        <select
            name="ketua_lingkungan"
            class="form-select @error('ketua_lingkungan') is-invalid @enderror">

            <option value="">-- Pilih Kepala Lingkungan --</option>

            @foreach($kepalaLingkungans as $perangkat)
                <option
                    value="{{ $perangkat->nama_lengkap }}"
                    @selected(old('ketua_lingkungan', $lingkungan->ketua_lingkungan ?? '') == $perangkat->nama_lengkap)>
                    {{ $perangkat->nama_lengkap }}
                    @if($perangkat->jabatanStruktur)
                        ({{ $perangkat->jabatanStruktur->nama }})
                    @endif
                </option>
            @endforeach

        </select>

        @error('ketua_lingkungan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

    <div class="w-full md:w-1/2 px-3 mb-4">

        <label class="form-label">Telepon</label>

        <input
            type="text"
            name="telepon"
            class="form-control"
            value="{{ old('telepon', $lingkungan->telepon ?? '') }}">

    </div>

</div>

<div class="mb-4">

    <label class="form-label">Keterangan</label>

    <textarea
        name="keterangan"
        rows="4"
        class="form-control">{{ old('keterangan', $lingkungan->keterangan ?? '') }}</textarea>

</div>

<div class="mb-6">

    <label class="form-label">Status</label>

    <select name="status" class="form-select">

        <option value="1"
            {{ old('status', $lingkungan->status ?? 1) == 1 ? 'selected' : '' }}>
            Aktif
        </option>

        <option value="0"
            {{ old('status', $lingkungan->status ?? 1) == 0 ? 'selected' : '' }}>
            Nonaktif
        </option>

    </select>

</div>