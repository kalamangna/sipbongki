@csrf

<div class="flex flex-wrap -mx-3">

    <div class="col-lg-13">

        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm mb-2">

            <div class="px-6 py-4 border-b border-slate-200">
                <strong>Informasi Pejabat :</strong>
            </div>

            <div class="p-6">

                <div class="col-lg-12">
                    <label class="form-label">Nama Lengkap</label>

                    <input
                        type="text"
                        name="nama_lengkap"
                        class="form-control @error('nama_lengkap') is-invalid @enderror"
                        value="{{ old('nama_lengkap', $perangkat->nama_lengkap ?? '') }}"
                        required>

                    @error('nama_lengkap')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-6">

                    <label class="form-label">
                        NIP
                    </label>

                    <input
                        type="text"
                        name="nip"
                        class="form-control @error('nip') is-invalid @enderror"
                        value="{{ old('nip', $perangkat->nip ?? '') }}">

                    @error('nip')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Jabatan Persuratan
                    </label>

                    <select
                        name="jabatan_id"
                        class="form-select @error('jabatan_id') is-invalid @enderror">

                        <option value="">
                            -- Pilih Jabatan --
                        </option>

                        @foreach($jabatans as $jabatan)

                            <option
                                value="{{ $jabatan->id }}"
                                @selected(old('jabatan_id', $perangkat->jabatan_id ?? '') == $jabatan->id)>

                                {{ $jabatan->nama }}

                            </option>

                        @endforeach

                    </select>

                    @error('jabatan_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
<div class="mb-4">

    <label class="form-label">
        Jabatan Struktur Organisasi
    </label>

    <select
        name="jabatan_struktur_id"
        class="form-select @error('jabatan_struktur_id') is-invalid @enderror">

        <option value="">
            -- Pilih Jabatan Struktur Organisasi --
        </option>

        @foreach($jabatansStruktur as $jabatan)

            <option
                value="{{ $jabatan->id }}"
                @selected(old('jabatan_struktur_id', $perangkat->jabatan_struktur_id ?? '') == $jabatan->id)>

                {{ $jabatan->nama }}

            </option>

        @endforeach

    </select>

    @error('jabatan_struktur_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>
                    <div class="mb-4">

    <label class="form-label">
        Level Struktur Organisasi
    </label>

    <select
        name="level"
        class="form-select @error('level') is-invalid @enderror">

        <option value="99">
            -- Pilih Level --
        </option>

        <option value="1"
            @selected(old('level', $perangkat->level ?? 99) == 1)>
            Lurah
        </option>

        <option value="2"
            @selected(old('level', $perangkat->level ?? 99) == 2)>
            Sekretaris Lurah
        </option>

        <option value="3"
            @selected(old('level', $perangkat->level ?? 99) == 3)>
            Kepala Seksi
        </option>

        <option value="4"
            @selected(old('level', $perangkat->level ?? 99) == 4)>
            Kepala Lingkungan
        </option>

        <option value="5"
            @selected(old('level', $perangkat->level ?? 99) == 5)>
            Staf
        </option>

    </select>

    @error('level')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>

                </div>

                <div class="flex flex-wrap -mx-3">

                    <div class="w-full md:w-1/2 px-3">

                        <div class="mb-4">

                            <label class="form-label">
                                Jenis Kelamin
                            </label>

                            <select
                                name="jenis_kelamin"
                                class="form-select">

                                <option value="">
                                    -- Pilih Jenis Jelamin--
                                </option>

                                <option
                                    value="L"
                                    @selected(old('jenis_kelamin', $perangkat->jenis_kelamin ?? '')=='L')>

                                    Laki-laki

                                </option>

                                <option
                                    value="P"
                                    @selected(old('jenis_kelamin', $perangkat->jenis_kelamin ?? '')=='P')>

                                    Perempuan

                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="w-full md:w-1/2 px-3">

                        <div class="mb-4">

                            <label class="form-label">
                                Pendidikan Terakhir
                            </label>

                             <select
            name="pendidikan"
            class="form-select @error('pendidikan') is-invalid @enderror">

            <option value="">-- Pilih Pendidikan --</option>

            @php
                $pendidikan = [
                    'Tidak Sekolah',
                    'SD / Sederajat',
                    'SMP / Sederajat',
                    'SMA / SMK / MA',
                    'Diploma I (D1)',
                    'Diploma II (D2)',
                    'Diploma III (D3)',
                    'Diploma IV (D4)',
                    'Sarjana (S1)',
                    'Magister (S2)',
                    'Doktor (S3)',
                ];
            @endphp

            @foreach($pendidikan as $item)

                <option
                    value="{{ $item }}"
                    @selected(old('pendidikan', $perangkat->pendidikan ?? '') == $item)>

                    {{ $item }}

                </option>

            @endforeach

        </select>

        @error('pendidikan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

</div>

                <div class="flex flex-wrap -mx-3">

                    <div class="w-full md:w-1/2 px-3">

                        <div class="mb-4">

                            <label class="form-label">
                                Tempat Lahir
                            </label>

                            <input
                                type="text"
                                name="tempat_lahir"
                                class="form-control"
                                value="{{ old('tempat_lahir', $perangkat->tempat_lahir ?? '') }}">

                        </div>

                    </div>

                    <div class="w-full md:w-1/2 px-3">

                        <div class="mb-4">

                            <label class="form-label">
                                Tanggal Lahir
                            </label>

                            <input
                                type="date"
                                name="tanggal_lahir"
                                class="form-control"
                                value="{{ old('tanggal_lahir',
                                isset($perangkat)
                                ? optional($perangkat->tanggal_lahir)->format('Y-m-d')
                                : '') }}">

                        </div>

                    </div>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Nomor HP / WhatsApp
                    </label>

                    <input
                        type="text"
                        name="telepon"
                        class="form-control"
                        value="{{ old('telepon', $perangkat->telepon ?? '') }}">

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $perangkat->email ?? '') }}">

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Alamat
                    </label>

                    <textarea
                        name="alamat"
                        rows="3"
                        class="form-control">{{ old('alamat', $perangkat->alamat ?? '') }}</textarea>

                </div>

            </div>

        </div>

    </div>

<div class="col-md-12">
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm mb-2">

    <div class="px-6 py-4 border-b border-slate-200">

        <strong>Foto Pejabat</strong>

    </div>

    <div class="p-6 text-center">

        @if(isset($perangkat) && $perangkat->foto)

            <img
                src="{{ asset('storage/'.$perangkat->foto) }}"
                class="img-thumbnail rounded-circle mb-4"
                id="previewFoto"
                style="width:165px;height:165px;object-fit:cover;">

        @else

            <img
    src="{{ asset('images/avatar-default.png') }}"
    class="img-thumbnail rounded-circle mb-2"
    id="previewFoto"
    style="width:165px;height:165px;object-fit:cover;">

        @endif

       <input
    type="file"
    name="foto"
    id="foto"
    class="form-control @error('foto') is-invalid @enderror"
    accept=".jpg,.jpeg,.png,.webp">

@error('foto')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror

        
    </div>

</div>

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">

        <div class="px-6 py-4 border-b border-slate-200">
            <strong>Status Jabatan</strong>
        </div>

        <div class="p-6">

            <div class="mb-4">

                <label class="form-label">
                    Tanggal Mulai Menjabat
                </label>

                <input
                    type="date"
                    name="tanggal_mulai_jabatan"
                    class="form-control @error('tanggal_mulai_jabatan') is-invalid @enderror"
                    value="{{ old('tanggal_mulai_jabatan',
                    isset($perangkat)
                    ? optional($perangkat->tanggal_mulai_jabatan)->format('Y-m-d')
                    : '') }}">

                @error('tanggal_mulai_jabatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="mb-4">

                <label class="form-label">
                    Status Keaktifan
                </label>

                <div class="form-check">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="aktif"
                        name="aktif"
                        value="1"
                        @checked(old('aktif', $perangkat->aktif ?? true))>

                    <label class="form-check-label" for="aktif">

                        Masih Aktif Menjabat

                    </label>

                </div>

                <small class="text-slate-500">

                    Hilangkan centang apabila perangkat sudah tidak aktif.

                </small>

            </div>

            <div class="mb-4">

                <label class="form-label">
                    Keterangan
                </label>

                <textarea
                    name="keterangan"
                    rows="5"
                    class="form-control @error('keterangan') is-invalid @enderror"
                    placeholder="Contoh: Pindah tugas, pensiun, mutasi, atau keterangan lainnya...">{{ old('keterangan', $perangkat->keterangan ?? '') }}</textarea>

                @error('keterangan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>

    </div>

</div>

</div>    

<div class="mt-3">

    <button class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

        <i class="bi bi-save"></i>

        Simpan

    </button>

    <a
        href="{{ isset($perangkat) && $perangkat->exists ? route('admin.perangkat.show', $perangkat) : route('admin.perangkat.index') }}"
        class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary">

        Kembali

    </a>

</div>
<script>

document
    .getElementById('foto')
    ?.addEventListener('change', function(event) {


        const file = event.target.files[0];


        if (file) {


            const reader = new FileReader();


            reader.onload = function(e) {


                document
                    .getElementById('previewFoto')
                    .src = e.target.result;


            };


            reader.readAsDataURL(file);

        }


    });

</script>