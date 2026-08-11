{{-- ===========================
    DATA KARTU KELUARGA
=========================== --}}

<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

    <div class="px-6 py-4 border-b border-slate-200 bg-primary-100 text-primary-700 text-white">
        <h5 class="mb-0">
            <i class="bi bi-card-list mr-2"></i>
            Data Kartu Keluarga
        </h5>
    </div>

    <div class="p-6">

        <div class="flex flex-wrap -mx-3 g-3">

            {{-- Nomor KK --}}
            <div class="w-full md:w-1/2 px-3">
                <label class="form-label fw-semibold">
                    Nomor KK
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="no_kk"
                    class="form-control @error('no_kk') is-invalid @enderror"
                    value="{{ old('no_kk', $kartuKeluarga->no_kk ?? '') }}"
                    placeholder="Masukkan Nomor KK">

                @error('no_kk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Kepala Keluarga --}}
            <div class="w-full md:w-1/2 px-3">

                <label class="form-label fw-semibold">
                    Kepala Keluarga
                    <span class="text-danger">*</span>
                </label>

                <select
                    id="kepala_keluarga_id"
                    name="kepala_keluarga_id"
                    class="form-select @error('kepala_keluarga_id') is-invalid @enderror">

                    <option value="">
                        -- Pilih Kepala Keluarga --
                    </option>

                    @foreach($penduduks as $penduduk)

                        <option
    value="{{ $penduduk->id }}"
    data-nik="{{ $penduduk->nik }}"
    data-nama="{{ $penduduk->nama_lengkap }}"
    data-alamat="{{ $penduduk->alamat }}"
    data-rt="{{ $penduduk->rt }}"
    data-rw="{{ $penduduk->rw }}"
    data-lingkungan="{{ $penduduk->lingkungan_id }}"
    {{ old('kepala_keluarga_id', $kartuKeluarga->kepala_keluarga_id ?? '') == $penduduk->id ? 'selected' : '' }}>

    {{ $penduduk->nik }} - {{ $penduduk->nama_lengkap }}

</option>

                    @endforeach

                </select>

                @error('kepala_keluarga_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            {{-- Alamat --}}
            <div class="col-md-12">

                <label class="form-label fw-semibold">
                    Alamat
                </label>

                <textarea
                    id="alamat"
                    name="alamat"
                    rows="3"
                    class="form-control">{{ old('alamat', $kartuKeluarga->alamat ?? '') }}</textarea>

            </div>

            {{-- RT --}}
            <div class="col-md-2">

                <label class="form-label fw-semibold">
                    RT
                </label>

                <input
                    id="rt"
                    type="text"
                    name="rt"
                    class="form-control"
                    value="{{ old('rt', $kartuKeluarga->rt ?? '') }}">

            </div>

            {{-- RW --}}
            <div class="col-md-2">

                <label class="form-label fw-semibold">
                    RW
                </label>

                <input
                    id="rw"
                    type="text"
                    name="rw"
                    class="form-control"
                    value="{{ old('rw', $kartuKeluarga->rw ?? '') }}">

            </div>

            {{-- Lingkungan --}}
            <div class="col-md-8">

                <label class="form-label fw-semibold">
                    Lingkungan
                </label>

                <select
                    id="lingkungan_id"
                    name="lingkungan_id"
                    class="form-select">

                    <option value="">
                        -- Pilih Lingkungan --
                    </option>

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

    </div>

</div>

{{-- ===========================
    ANGGOTA KELUARGA
=========================== --}}

<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

    <div class="px-6 py-4 border-b border-slate-200 flex justify-start items-center gap-3">

        <div>

            <h5 class="mb-0">
                <i class="bi bi-people-fill mr-2"></i>
                Anggota Keluarga
            </h5>

            <small class="text-slate-500">
                Kepala keluarga akan otomatis menjadi anggota pertama.
            </small>

        </div>

        <button
            type="button"
            id="btnOpenAnggotaModal"
            class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

            <i class="bi bi-plus-circle"></i>
            Tambah Anggota

        </button>

    </div>

    <div class="p-6 p-0">

        <div class="overflow-x-auto w-full">

            <table class="w-full text-left border-collapse text-sm table-bordered table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th width="60">
                            No
                        </th>

                        <th width="170">
                            NIK
                        </th>

                        <th>
                            Nama
                        </th>

                        <th width="160">
                            Hubungan
                        </th>

                        <th width="80">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody id="anggotaTableBody">

                    {{-- Diisi melalui JavaScript --}}

                </tbody>

            </table>

        </div>

    </div>

</div>

<div id="anggotaHiddenInput"></div>

{{-- =========================================================
    MODAL TAMBAH ANGGOTA
========================================================= --}}

<div
    class="modal"
    id="modalAnggota"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header bg-primary-100 text-primary-700 text-white">

                <h5 class="modal-title">
                    Tambah Anggota Keluarga
                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <div class="flex flex-wrap -mx-3 g-3">

                    {{-- Penduduk --}}
                    <div class="col-md-12">

                        <label class="form-label fw-semibold">
                            Penduduk
                        </label>

                        <select
                            id="modalPenduduk"
                            class="form-select">

                            <option value="">
                                -- Pilih Penduduk --
                            </option>

                            @foreach($penduduks as $penduduk)

                                <option
                                    value="{{ $penduduk->id }}"
                                    data-nik="{{ $penduduk->nik }}"
                                    data-nama="{{ $penduduk->nama_lengkap }}"
                                    data-alamat="{{ $penduduk->alamat }}"
                                    data-rt="{{ $penduduk->rt }}"
                                    data-rw="{{ $penduduk->rw }}"
                                    data-lingkungan="{{ $penduduk->lingkungan_id }}"
                                    data-haskk="{{ $penduduk->kartu_keluarga_id ? 1 : 0 }}">

                                    {{ $penduduk->nik }}
                                    -
                                    {{ $penduduk->nama_lengkap }}

                                    @if($penduduk->kartu_keluarga_id)
                                        (Sudah punya KK)
                                    @endif

                                </option>

                            @endforeach

                        </select>

                        <small class="text-slate-500">
                            Penduduk yang sudah memiliki KK tetap dapat dipilih jika
                            <strong>Force Reassign</strong> diaktifkan.
                        </small>

                    </div>

                    {{-- Hubungan --}}
                    <div class="w-full md:w-1/2 px-3">

                        <label class="form-label fw-semibold">
                            Hubungan Keluarga
                        </label>

                        <select
                            id="modalHubungan"
                            class="form-select">

                            <option value="">
                                -- Pilih --
                            </option>

                          
                            <option value="Istri">
                                Istri
                            </option>

                            <option value="Suami">
                                Suami
                            </option>

                            <option value="Anak">
                                Anak
                            </option>

                            <option value="Orang Tua">
                                Orang Tua
                            </option>

                            <option value="Menantu">
                                Menantu
                            </option>

                            <option value="Cucu">
                                Cucu
                            </option>

                            <option value="Famili Lain">
                                Famili Lain
                            </option>

                            <option value="Lainnya">
                                Lainnya
                            </option>

                        </select>

                    </div>

                    {{-- Preview --}}
                    <div class="w-full md:w-1/2 px-3">

                        <label class="form-label fw-semibold">
                            Status
                        </label>

                        <div
                            id="statusPenduduk"
                            class="alert alert-secondary mb-0">

                            Belum memilih penduduk.

                        </div>

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary"
                    data-bs-dismiss="modal">

                    Batal

                </button>

                <button
                    type="button"
                    id="btnTambahAnggota"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

                    <i class="bi bi-plus-circle mr-1"></i>

                    Tambahkan

                </button>

            </div>

        </div>

    </div>

</div>

{{-- =========================================================
    OPSI REASSIGN
========================================================= --}}

<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mt-6">

    <div class="p-6">

        <div class="form-check">

            <input
                class="form-check-input"
                type="checkbox"
                name="force_reassign"
                id="force_reassign"
                value="1"
                {{ old('force_reassign') ? 'checked' : '' }}>

            <label
                class="form-check-label fw-semibold"
                for="force_reassign">

                Izinkan memindahkan anggota dari KK lain

            </label>

            <div class="text-slate-500 small mt-2">

                Jika dicentang, penduduk yang sudah menjadi anggota
                Kartu Keluarga lain dapat dipindahkan ke KK ini.
                Data KK lama akan diperbarui saat proses penyimpanan.

            </div>

        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const kepalaSelect = document.getElementById('kepala_keluarga_id');
    const modalPenduduk = document.getElementById('modalPenduduk');
    const modalHubungan = document.getElementById('modalHubungan');
    const btnTambah = document.getElementById('btnTambahAnggota');

    const tableBody = document.getElementById('anggotaTableBody');
    const hiddenInput = document.getElementById('anggotaHiddenInput');

    const alamat = document.getElementById('alamat');
    const rt = document.getElementById('rt');
    const rw = document.getElementById('rw');
    const lingkungan = document.getElementById('lingkungan_id');

    const statusPenduduk = document.getElementById('statusPenduduk');

    // Tom Select
new TomSelect('#modalPenduduk', {
    create: false,
    sortField: {
        field: "text",
        direction: "asc"
    },
    placeholder: "Cari NIK atau Nama Penduduk..."
});

    let anggota = [];

    /*
    |--------------------------------------------------------------------------
    | MODE EDIT
    |--------------------------------------------------------------------------
    */

    @if(isset($anggotaKeluarga) && $anggotaKeluarga->count())

    anggota = [

    @foreach($anggotaKeluarga as $item)
    {
        id: {{ $item->id }},
        nik: @json($item->nik),
        nama: @json($item->nama_lengkap),
        hubungan: @json($item->hubungan_keluarga),
    },
    @endforeach

    ];

    @endif


    /*
    |--------------------------------------------------------------------------
    | Hidden Input
    |--------------------------------------------------------------------------
    */

    function renderHiddenInput() {

        hiddenInput.innerHTML = '';

        anggota.forEach(function(item, index){

            hiddenInput.innerHTML += `
                <input
                    type="hidden"
                    name="anggota[${index}][penduduk_id]"
                    value="${item.id}">

                <input
                    type="hidden"
                    name="anggota[${index}][hubungan]"
                    value="${item.hubungan}">
            `;

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Render Table
    |--------------------------------------------------------------------------
    */

    function renderTable(){

        tableBody.innerHTML = '';

        if(anggota.length === 0){

            tableBody.innerHTML = `
                <tr>
                    <td colspan="5" class="text-center text-slate-500 py-4">
                        Belum ada anggota keluarga.
                    </td>
                </tr>
            `;

            renderHiddenInput();
            return;
        }

        anggota.forEach(function(item,index){

            tableBody.innerHTML += `
                <tr>

                    <td>${index+1}</td>

                    <td>${item.nik}</td>

                    <td>${item.nama}</td>

                    <td>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-primary-100 text-primary-700">
                            ${item.hubungan}
                        </span>
                    </td>

                    <td>

                        <button
                            type="button"
                            class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all !px-3 !py-1.5 !text-xs bg-rose-600 text-white hover:bg-rose-700 shadow-sm"
                            onclick="hapusAnggota(${item.id})">

                            Hapus

                        </button>

                    </td>

                </tr>
            `;

        });

        renderHiddenInput();

    }


    /*
    |--------------------------------------------------------------------------
    | Hapus Anggota
    |--------------------------------------------------------------------------
    */

    window.hapusAnggota = function(id){

        anggota = anggota.filter(function(item){

            return item.id != id;

        });

        renderTable();

    };

        /*
    |--------------------------------------------------------------------------
    | Status Penduduk
    |--------------------------------------------------------------------------
    */

    modalPenduduk.addEventListener('change', function () {

        if (!this.value) {

            statusPenduduk.className = 'alert alert-secondary';
            statusPenduduk.innerHTML = 'Belum memilih penduduk.';
            return;

        }

        const opt = this.options[this.selectedIndex];

        if (opt.dataset.haskk === "1") {

            statusPenduduk.className = 'alert alert-warning';
            statusPenduduk.innerHTML =
                '<strong>Perhatian!</strong><br>Penduduk ini sudah memiliki KK.';

        } else {

            statusPenduduk.className = 'alert alert-success';
            statusPenduduk.innerHTML = 'Penduduk siap ditambahkan.';

        }

    });


    /*
    |--------------------------------------------------------------------------
    | Tambah Anggota
    |--------------------------------------------------------------------------
    */

    btnTambah.addEventListener('click', function () {

        if (!modalPenduduk.value) {

            alert('Pilih penduduk.');
            return;

        }

        if (!modalHubungan.value) {

            alert('Pilih hubungan keluarga.');
            return;

        }

        const opt = modalPenduduk.options[modalPenduduk.selectedIndex];

        const id = parseInt(opt.value);

        if (anggota.some(item => item.id === id)) {

            alert('Penduduk sudah menjadi anggota.');
            return;

        }

        anggota.push({

            id: id,
            nik: opt.dataset.nik,
            nama: opt.dataset.nama,
            hubungan: modalHubungan.value

        });

        renderTable();

        bootstrap.Modal
            .getInstance(document.getElementById('modalAnggota'))
            .hide();

        modalPenduduk.value = '';
        modalHubungan.value = '';

        statusPenduduk.className = 'alert alert-secondary';
        statusPenduduk.innerHTML = 'Belum memilih penduduk.';

    });


    /*
    |--------------------------------------------------------------------------
    | Kepala Keluarga
    |--------------------------------------------------------------------------
    */

    kepalaSelect.addEventListener('change', function () {

        if (!this.value) return;

        const opt = this.options[this.selectedIndex];

        alamat.value = opt.dataset.alamat ?? '';
        rt.value = opt.dataset.rt ?? '';
        rw.value = opt.dataset.rw ?? '';
        lingkungan.value = opt.dataset.lingkungan ?? '';

        const id = parseInt(opt.value);

        // Hapus kepala keluarga lama
        anggota = anggota.filter(function(item){

            return item.hubungan !== 'Kepala Keluarga';

        });

      

        renderTable();

    });


    /*
    |--------------------------------------------------------------------------
    | Force Reassign
    |--------------------------------------------------------------------------
    */

    const force = document.getElementById('force_reassign');
    const btnOpenModal = document.getElementById('btnOpenAnggotaModal');

    if (force) {

        function toggleForce() {

            const enable = force.checked;

            modalPenduduk.querySelectorAll('option').forEach(function(opt){

                if (opt.dataset.haskk === "1") {

                    opt.disabled = !enable;

                }

            });

        }

        force.addEventListener('change', toggleForce);

        toggleForce();

    }

    if (btnOpenModal) {
        btnOpenModal.addEventListener('click', function () {
            const modalEl = document.getElementById('modalAnggota');
            const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl, {
                backdrop: false,
                keyboard: false,
            });
            modalInstance.show();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Render Awal
    |--------------------------------------------------------------------------
    */

    renderTable();

});
</script>