<div class="row">

    <div class="col-md-6">

        <div class="mb-3">

            <label class="form-label">
                Nama Jabatan
            </label>

            <input
                type="text"
                name="nama"
                class="form-control @error('nama') is-invalid @enderror"
                value="{{ old('nama', $jabatan->nama ?? '') }}"
                placeholder="Masukkan nama jabatan">

            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

    </div>

    <div class="col-md-6">

        <div class="mb-3">

            <label class="form-label">
                Slug
            </label>

            <input
                type="text"
                name="slug"
                class="form-control @error('slug') is-invalid @enderror"
                value="{{ old('slug', $jabatan->slug ?? '') }}"
                placeholder="contoh: kasi-pemerintahan">

            @error('slug')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-6">

        <div class="mb-3">

            <label class="form-label">
                Parent Jabatan
            </label>

            <select
                name="parent_id"
                class="form-select @error('parent_id') is-invalid @enderror">

                <option value="">
                    -- Tidak Ada --
                </option>

                @foreach($parentJabatans as $parent)

                    <option
                        value="{{ $parent->id }}"
                        @selected(old('parent_id', $jabatan->parent_id ?? '') == $parent->id)>

                        {{ $parent->nama }}

                    </option>

                @endforeach

            </select>

            @error('parent_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

    </div>

    <div class="col-md-3">

        <div class="mb-3">

            <label class="form-label">
                Urutan
            </label>

            <input
                type="number"
                min="1"
                name="urutan"
                class="form-control @error('urutan') is-invalid @enderror"
                value="{{ old('urutan', $jabatan->urutan ?? 1) }}"
                placeholder="1">

            @error('urutan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

    </div>

</div>

<hr>

<div class="row">

    <div class="col-md-4">

        <div class="form-check mb-3">

            <input
                class="form-check-input"
                type="checkbox"
                id="is_penandatangan"
                name="is_penandatangan"
                value="1"
                @checked(old('is_penandatangan', $jabatan->is_penandatangan ?? false))>

            <label
                class="form-check-label"
                for="is_penandatangan">

                Jabatan Penandatangan

            </label>

        </div>

    </div>

    <div class="col-md-4">

        <div class="form-check mb-3">

            <input
                class="form-check-input"
                type="checkbox"
                id="is_struktur"
                name="is_struktur"
                value="1"
                @checked(old('is_struktur', $jabatan->is_struktur ?? false))>

            <label
                class="form-check-label"
                for="is_struktur">

                Struktur Organisasi Website

            </label>

        </div>

    </div>

    <div class="col-md-4">

        <div class="form-check mb-3">

            <input
                class="form-check-input"
                type="checkbox"
                id="aktif"
                name="aktif"
                value="1"
                @checked(old('aktif', $jabatan->aktif ?? true))>

            <label
                class="form-check-label"
                for="aktif">

                Jabatan Aktif

            </label>

        </div>

    </div>

</div>

<hr>

<div class="d-flex gap-2">

    <button
        type="submit"
        class="btn btn-primary">

        <i class="fa-solid fa-circle-check"></i>
        Simpan

    </button>

    <a
        href="{{ route('admin.jabatan.index') }}"
        class="btn btn-secondary">

        <i class="fa-solid fa-arrow-left"></i>
        Kembali

    </a>

</div>