{{-- ===========================
    DATA KARTU KELUARGA
=========================== --}}

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-8">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">
        <h3 class="font-bold text-slate-800 text-base mb-0">
            <i class="fa-solid fa-address-card text-primary-600 mr-2"></i>
            Data Kartu Keluarga
        </h3>
    </div>

    <div class="p-6 md:p-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Nomor KK --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nomor KK <span class="text-red-500">*</span></label>
                <input type="text" name="no_kk" placeholder="Contoh: 7371110000000000" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm" value="{{ old('no_kk', $kartuKeluarga->no_kk ?? '') }}" required>
                @error('no_kk')<div class="text-red-500 text-xs mt-1">{{ $message }}</div>@enderror
            </div>

            {{-- Kepala Keluarga --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kepala Keluarga <span class="text-red-500">*</span></label>
                <select id="kepala_keluarga_id" name="kepala_keluarga_id" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm" required>
                    <option value="">-- Pilih Kepala Keluarga --</option>
                    @foreach($penduduks as $penduduk)
                        <option value="{{ $penduduk->id }}"
                            data-nik="{{ $penduduk->nik }}"
                            data-nama="{{ $penduduk->nama_lengkap }}"
                            data-alamat="{{ $penduduk->alamat }}"
                            data-rt="{{ $penduduk->rt }}"
                            data-rw="{{ $penduduk->rw }}"
                            data-lingkungan="{{ $penduduk->lingkungan_id }}"
                            @selected(old('kepala_keluarga_id', $kartuKeluarga->kepala_keluarga_id ?? '') == $penduduk->id)>
                            {{ $penduduk->nik }} - {{ $penduduk->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
                @error('kepala_keluarga_id')<div class="text-red-500 text-xs mt-1">{{ $message }}</div>@enderror
            </div>

            {{-- Alamat --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat</label>
                <textarea id="alamat" name="alamat" placeholder="Masukkan nama jalan, lorong, atau patokan rumah..." rows="3" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">{{ old('alamat', $kartuKeluarga->alamat ?? '') }}</textarea>
                @error('alamat')<div class="text-red-500 text-xs mt-1">{{ $message }}</div>@enderror
            </div>

            {{-- RT --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">RT</label>
                <input type="text" id="rt" name="rt" placeholder="00" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm" value="{{ old('rt', $kartuKeluarga->rt ?? '') }}">
                @error('rt')<div class="text-red-500 text-xs mt-1">{{ $message }}</div>@enderror
            </div>

            {{-- RW --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">RW</label>
                <input type="text" id="rw" name="rw" placeholder="00" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm" value="{{ old('rw', $kartuKeluarga->rw ?? '') }}">
                @error('rw')<div class="text-red-500 text-xs mt-1">{{ $message }}</div>@enderror
            </div>

            {{-- Lingkungan --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Lingkungan</label>
                <select id="lingkungan_id" name="lingkungan_id" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">
                    <option value="">-- Pilih Lingkungan --</option>
                    @foreach($lingkungans as $lingkungan)
                        <option value="{{ $lingkungan->id }}" @selected(old('lingkungan_id', $kartuKeluarga->lingkungan_id ?? '') == $lingkungan->id)>
                            {{ $lingkungan->nama }}
                        </option>
                    @endforeach
                </select>
                @error('lingkungan_id')<div class="text-red-500 text-xs mt-1">{{ $message }}</div>@enderror
            </div>

        </div>

    </div>

</div>

{{-- ===========================
    ANGGOTA KELUARGA
=========================== --}}

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">

    <div class="px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 bg-slate-50/50">
        <h3 class="font-bold text-slate-800 text-base mb-0">
            <i class="fa-solid fa-users text-sky-600 mr-2"></i>
            Anggota Keluarga
        </h3>
        
        <button type="button" data-modal-target="modalAnggota" data-modal-toggle="modalAnggota" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-semibold rounded-lg bg-sky-50 text-sky-700 hover:bg-sky-100 transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            <i class="fa-solid fa-plus"></i> Tambah Anggota
        </button>
    </div>

    <div class="overflow-x-auto w-full">
        <table class="w-full text-sm text-left text-slate-600">
            <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/50 border-b border-slate-100">
                <tr>
                    <th width="60" class="px-6 py-4 text-center">No</th>
                    <th width="170" class="px-6 py-4">NIK</th>
                    <th class="px-6 py-4">Nama</th>
                    <th width="160" class="px-6 py-4">Hubungan</th>
                    <th width="80" class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="anggotaTableBody" class="divide-y divide-slate-100">
                {{-- Diisi melalui JavaScript --}}
            </tbody>
        </table>
    </div>

</div>

<div id="anggotaHiddenInput"></div>

{{-- =========================================================
    MODAL TAMBAH ANGGOTA
========================================================= --}}

<div id="modalAnggota" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50 text-slate-800">
                <h5 class="font-bold text-lg mb-0">Tambah Anggota Keluarga</h5>
                <button type="button" class="text-slate-400 hover:text-slate-600 transition-colors" data-modal-hide="modalAnggota">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Penduduk</label>
                        <select id="modalPenduduk" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">
                            <option value="">-- Pilih Penduduk --</option>
                            @foreach($penduduks as $penduduk)
                                <option value="{{ $penduduk->id }}"
                                    data-nik="{{ $penduduk->nik }}"
                                    data-nama="{{ $penduduk->nama_lengkap }}"
                                    data-haskk="{{ $penduduk->kartu_keluarga_id ? '1' : '0' }}">
                                    {{ $penduduk->nik }} - {{ $penduduk->nama_lengkap }}
                                    {{ $penduduk->kartu_keluarga_id ? '(Sudah ada KK)' : '' }}
                                </option>
                            @endforeach
                        </select>
                        <div class="mt-2">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" id="force_reassign" class="w-4 h-4 rounded border-slate-300 text-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-500">
                                <span class="text-xs text-slate-500">Tampilkan penduduk yang sudah memiliki KK</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Hubungan Keluarga</label>
                        <select id="modalHubungan" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">
                            <option value="">-- Pilih Hubungan --</option>
                            @foreach([
                                'Suami', 'Istri', 'Anak', 'Menantu', 'Cucu', 
                                'Orang Tua', 'Mertua', 'Famili Lain', 'Pembantu', 'Lainnya'
                            ] as $hub)
                                <option value="{{ $hub }}">{{ $hub }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="px-6 py-4 border-t border-slate-100 flex justify-end gap-3 bg-slate-50">
                <button type="button" data-modal-hide="modalAnggota" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 shadow-sm transition-all focus:outline-none">
                    Batal
                </button>
                <button type="button" id="btnTambahAnggotaModal" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-primary-500 cursor-pointer">
                    <i class="fa-solid fa-plus"></i> Tambah ke List
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const kepalaKeluargaSelect = document.getElementById('kepala_keluarga_id');
    const alamatInput          = document.getElementById('alamat');
    const rtInput              = document.getElementById('rt');
    const rwInput              = document.getElementById('rw');
    const lingkunganSelect     = document.getElementById('lingkungan_id');

    @php
        $defaultAnggota = [];
        if (isset($anggotaKeluarga)) {
            $defaultAnggota = $anggotaKeluarga->map(function($a) {
                return [
                    'penduduk_id' => $a->id,
                    'nik' => $a->nik,
                    'nama' => $a->nama_lengkap,
                    'hubungan' => $a->hubungan_keluarga
                ];
            })->toArray();
        }
    @endphp
    let anggota = @json(old('anggota', $defaultAnggota));

    /*
    |--------------------------------------------------------------------------
    | Data dari Server (jika edit atau validasi gagal)
    |--------------------------------------------------------------------------
    */
    if (anggota.length > 0) {
        // Jika dari old(), kita hanya punya penduduk_id dan hubungan. Kita butuh nik dan nama.
        anggota = anggota.map(function(item) {
            if (!item.id && item.penduduk_id) item.id = item.penduduk_id;
            
            if (!item.nik || !item.nama) {
                // Cari dari opsi select
                let opt = document.querySelector(`#modalPenduduk option[value="${item.id}"]`);
                if (opt) {
                    item.nik = opt.dataset.nik;
                    item.nama = opt.dataset.nama;
                }
            }
            return item;
        });
    } else {
        @if(isset($anggotaKeluarga) && $anggotaKeluarga->count() > 0)
            anggota = [
                @foreach($anggotaKeluarga as $ag)
                {
                    id: '{{ $ag->id }}',
                    nik: '{{ $ag->nik }}',
                    nama: '{{ addslashes($ag->nama_lengkap) }}',
                    hubungan: '{{ $ag->hubungan_keluarga }}'
                },
                @endforeach
            ];
        @endif
    }


    /*
    |--------------------------------------------------------------------------
    | Render Table
    |--------------------------------------------------------------------------
    */
    function renderTable() {

        const tbody = document.getElementById('anggotaTableBody');
        const hiddenDiv = document.getElementById('anggotaHiddenInput');
        
        tbody.innerHTML = '';
        hiddenDiv.innerHTML = '';

        if (anggota.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-400">
                        <i class="fa-solid fa-users-slash text-3xl mb-3 text-slate-300"></i>
                        <p class="text-sm">Belum ada data anggota keluarga</p>
                    </td>
                </tr>
            `;
            return;
        }

        anggota.forEach(function (item, index) {

            // Render Row
            const tr = document.createElement('tr');
            tr.className = "hover:bg-slate-50/80 transition-colors";
            tr.innerHTML = `
                <td class="px-6 py-4 text-center text-slate-500">${index + 1}</td>
                <td class="px-6 py-4 font-mono text-slate-700">${item.nik}</td>
                <td class="px-6 py-4 font-bold text-slate-900">${item.nama}</td>
                <td class="px-6 py-4">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700 tracking-wide">
                        ${item.hubungan}
                    </span>
                </td>
                <td class="px-6 py-4 text-center">
                    <button type="button" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 hover:text-rose-700 transition-colors shadow-sm focus:outline-none" onclick="removeAnggota(${index})" ${item.hubungan === 'Kepala Keluarga' ? 'disabled title="Kepala keluarga tidak bisa dihapus dari sini"' : ''}>
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            `;

            tbody.appendChild(tr);

            // Render Hidden Inputs for Form Submission
            hiddenDiv.innerHTML += `
                <input type="hidden" name="anggota[${index}][penduduk_id]" value="${item.id}">
                <input type="hidden" name="anggota[${index}][hubungan]" value="${item.hubungan}">
            `;
        });
    }


    /*
    |--------------------------------------------------------------------------
    | Tambah Anggota (Via Modal)
    |--------------------------------------------------------------------------
    */
    const modalPenduduk = document.getElementById('modalPenduduk');
    const modalHubungan = document.getElementById('modalHubungan');
    const btnTambahModal = document.getElementById('btnTambahAnggotaModal');

    btnTambahModal.addEventListener('click', function () {

        const pendudukId = modalPenduduk.value;
        const hubungan   = modalHubungan.value;

        if (!pendudukId || !hubungan) {
            alert('Pilih penduduk dan hubungan keluarga!');
            return;
        }

        const selectedOption = modalPenduduk.options[modalPenduduk.selectedIndex];
        const nik  = selectedOption.dataset.nik;
        const nama = selectedOption.dataset.nama;

        // Cek duplikasi di array
        const exists = anggota.find(a => a.id == pendudukId);
        if (exists) {
            alert('Penduduk ini sudah ada dalam daftar anggota keluarga.');
            return;
        }

        anggota.push({
            id: pendudukId,
            nik: nik,
            nama: nama,
            hubungan: hubungan
        });

        renderTable();

        // Reset modal form
        modalPenduduk.value = '';
        modalHubungan.value = '';

        // Tutup Modal via Flowbite (klik tombol silang secara programatis)
        document.querySelector('[data-modal-hide="modalAnggota"]').click();
    });

    
    /*
    |--------------------------------------------------------------------------
    | Hapus Anggota
    |--------------------------------------------------------------------------
    */
    window.removeAnggota = function (index) {
        if (anggota[index].hubungan === 'Kepala Keluarga') {
            alert('Tidak bisa menghapus Kepala Keluarga. Ubah pilihan Kepala Keluarga di form atas.');
            return;
        }

        anggota.splice(index, 1);
        renderTable();
    };


    /*
    |--------------------------------------------------------------------------
    | Sinkronisasi Kepala Keluarga
    |--------------------------------------------------------------------------
    */
    kepalaKeluargaSelect.addEventListener('change', function () {
        
        const selectedOption = this.options[this.selectedIndex];
        const id = this.value;

        if (!id) return;

        // Auto-fill alamat dll jika masih kosong
        if (!alamatInput.value) alamatInput.value = selectedOption.dataset.alamat || '';
        if (!rtInput.value)     rtInput.value     = selectedOption.dataset.rt || '';
        if (!rwInput.value)     rwInput.value     = selectedOption.dataset.rw || '';
        if (!lingkunganSelect.value) lingkunganSelect.value = selectedOption.dataset.lingkungan || '';

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

    /*
    |--------------------------------------------------------------------------
    | Render Awal
    |--------------------------------------------------------------------------
    */
    renderTable();

});
</script>