@csrf

@csrf

@if ($errors->any())
 <div class="p-4 mb-4 text-sm text-red-800 rounded-xl bg-red-50 border border-red-200">
 <strong>Terjadi kesalahan:</strong>
 <ul class="mb-0 mt-2">
 @foreach ($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>
 </div>
@endif

<div class="flex flex-wrap -mx-3">

 {{-- Pemohon --}}
 <div id="pemohon-field" class="w-full md:w-1/2 px-3 mb-4">

 <label class="form-label">
 Pemohon <span class="text-danger">*</span>
 </label>

 <select
 id="penduduk_id"
 name="penduduk_id"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error('penduduk_id') is-invalid @enderror">

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
 <div class="w-full md:w-1/2 px-3 mb-4">

 <label class="form-label">
 Jenis Surat <span class="text-danger">*</span>
 </label>

 <select
 name="jenis_surat_id"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error('jenis_surat_id') is-invalid @enderror"
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
<div id="usaha-fields" class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-4" style="display:none;">

 <div class="px-6 py-4 border-b border-slate-200 bg-light">
 <strong>Data Usaha</strong>
 </div>

 <div class="p-6">

 <div class="flex flex-wrap -mx-3">

 <div class="w-full md:w-1/2 px-3 mb-4">

 <label class="form-label">
 Nama Usaha <span class="text-danger">*</span>
 </label>

 <input
 type="text"
 name="nama_usaha"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 value="{{ old('nama_usaha', $permohonanSurat->data_surat['nama_usaha'] ?? '') }}">

 </div>

 <div class="w-full md:w-1/2 px-3 mb-4">

 <label class="form-label">
 Jenis Usaha <span class="text-danger">*</span>
 </label>

 <input
 type="text"
 name="jenis_usaha"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="Contoh : Warung Sembako"
 value="{{ old('jenis_usaha', $permohonanSurat->data_surat['jenis_usaha'] ?? '') }}">

 </div>

 </div>

 <div class="flex flex-wrap -mx-3">

 <div class="col-md-8 mb-4">

 <label class="form-label">
 Alamat Usaha
 </label>

 <textarea
 name="alamat_usaha"
 rows="2"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">{{ old('alamat_usaha', $permohonanSurat->data_surat['alamat_usaha'] ?? '') }}</textarea>

 </div>

 <div class="w-full md:w-1/3 px-3 mb-4">

 <label class="form-label">
 Lama Usaha
 </label>

 <input
 type="text"
 name="lama_usaha"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
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

<div id="kematian-fields" class="mb-6" style="display:none;">

 {{-- =========================================================
 | DATA ALMARHUM / ALMARHUMAH
 ========================================================= --}}
 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

 <div class="px-6 py-4 border-b border-slate-200 bg-light">
 <strong>Data Almarhum</strong>
 </div>

 <div class="p-6">

 <div class="flex flex-wrap -mx-3">

 <div class="w-full md:w-full px-3 mb-4">

 <label class="form-label">
 Almarhum 
 <span class="text-danger">*</span>
 </label>

 <select
 id="penduduk_id_kematian"
 name="almarhum_id"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">

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
<div class="w-full md:w-1/2 px-3 mb-4">

 <label class="form-label">
 Hari Meninggal
 <span class="text-danger">*</span>
 </label>

 <select
 name="hari_meninggal"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">

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

<div class="w-full md:w-1/2 px-3 mb-4">

 <label class="form-label">
 Tanggal Meninggal
 <span class="text-danger">*</span>
 </label>

 <input
 type="date"
 name="tanggal_meninggal"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 value="{{ old('tanggal_meninggal') }}">

</div>

<div class="w-full md:w-1/2 px-3 mb-4">

 <label class="form-label">
 Jam Meninggal
 </label>

 <input
 type="time"
 name="jam_meninggal"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 value="{{ old('jam_meninggal') }}">

</div>

<div class="w-full md:w-1/2 px-3 mb-4">

 <label class="form-label">
 Tempat Meninggal
 <span class="text-danger">*</span>
 </label>

 <input
 type="text"
 name="tempat_meninggal"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 value="{{ old('tempat_meninggal') }}">

</div>

<div class="w-full px-3 mb-4">

 <label class="form-label">
 Penyebab Kematian
 <span class="text-danger">*</span>
 </label>

 <textarea
 name="penyebab_kematian"
 rows="3"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">{{ old('penyebab_kematian') }}</textarea>

</div>
 </div>

 </div>

 </div>

 

 {{-- =========================================================
 | DATA PELAPOR
 ========================================================= --}}
 <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

 <div class="px-6 py-4 border-b border-slate-200 bg-light">
 <strong>Data Pelapor</strong>
 </div>

 <div class="p-6">

 <div class="flex flex-wrap -mx-3">

 <div class="w-full md:w-1/2 px-3 mb-4">

 <label class="form-label">
 Pelapor
 <span class="text-danger">*</span>
 </label>

 <select
 id="pelapor_id"
 name="pelapor_id"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">

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

 <div class="w-full md:w-1/2 px-3 mb-4">

 <label class="form-label">
 Hubungan dengan Almarhum / Almarhumah
 </label>

 <select
 name="hubungan_pelapor"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">

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

<div id="orang-sama-fields" class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-4" style="display:none;">

 <div class="px-6 py-4 border-b border-slate-200 bg-light">
 <strong>
 Data Dokumen Orang Yang Sama
 </strong>
 </div>


 <div class="p-6">


 <div class="flex flex-wrap -mx-3">


 {{-- Nama dalam dokumen lain --}}
 <div class="w-full md:w-1/2 px-3 mb-4">

 <label class="form-label">
 Nama Dalam Dokumen Lain
 <span class="text-danger">*</span>
 </label>


 <input
 type="text"
 name="nama_lain"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="Contoh: ABDUL RAHMAN"
 value="{{ old('nama_lain', $permohonanSurat->data_surat['nama_lain'] ?? '') }}">


 </div>



 {{-- Jenis Dokumen --}}
 <div class="w-full md:w-1/2 px-3 mb-4">

 <label class="form-label">
 Jenis Dokumen
 <span class="text-danger">*</span>
 </label>


 <input
 type="text"
 name="jenis_dokumen"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="Contoh: Sertifikat Hak Milik"
 value="{{ old('jenis_dokumen', $permohonanSurat->data_surat['jenis_dokumen'] ?? '') }}">


 </div>


 </div>



 <div class="flex flex-wrap -mx-3">


 {{-- Nomor Dokumen --}}
 <div class="w-full md:w-1/2 px-3 mb-4">

 <label class="form-label">
 Nomor Dokumen
 <span class="text-danger">*</span>
 </label>


 <input
 type="text"
 name="nomor_dokumen"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="Contoh: SHM No. 1234"
 value="{{ old('nomor_dokumen', $permohonanSurat->data_surat['nomor_dokumen'] ?? '') }}">


 </div>



 {{-- Keterangan --}}
 <div class="w-full md:w-1/2 px-3 mb-4">

 <label class="form-label">
 Keterangan Perbedaan
 </label>


 <input
 type="text"
 name="keterangan_perbedaan"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="Contoh: Perbedaan penulisan nama"
 value="{{ old('keterangan_perbedaan', $permohonanSurat->data_surat['keterangan_perbedaan'] ?? '') }}">


 </div>


 </div>


 </div>


</div>

{{-- =========================================================
| DATA DOMISILI
========================================================= --}}
<div id="domisili-fields"
 class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-4"
 style="display:none;">

 <div class="px-6 py-4 border-b border-slate-200 bg-light">
 <strong>Data Pemohon Domisili</strong>
 </div>

 <div class="p-6">

 <div class="flex flex-wrap -mx-3">

 <div class="w-full md:w-1/2 px-3 mb-4">
 <label class="form-label">Nama Lengkap</label>
 <input type="text"
 name="nama_lengkap"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 value="{{ old('nama_lengkap', $permohonanSurat->data_surat['nama_lengkap'] ?? '') }}">
 </div>

 <div class="w-full md:w-1/2 px-3 mb-4">
 <label class="form-label">NIK</label>
 <input type="text"
 name="nik"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 value="{{ old('nik', $permohonanSurat->data_surat['nik'] ?? '') }}">
 </div>

 <div class="w-full md:w-1/2 px-3 mb-4">
 <label class="form-label">Tempat Lahir</label>
 <input type="text"
 name="tempat_lahir"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 value="{{ old('tempat_lahir', $permohonanSurat->data_surat['tempat_lahir'] ?? '') }}">
 </div>

 <div class="w-full md:w-1/2 px-3 mb-4">
 <label class="form-label">Tanggal Lahir</label>
 <input type="date"
 name="tanggal_lahir"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 value="{{ old('tanggal_lahir', $permohonanSurat->data_surat['tanggal_lahir'] ?? '') }}">
 </div>

 <div class="w-full md:w-1/2 px-3 mb-4">
 <label class="form-label">Jenis Kelamin</label>

 <select name="jenis_kelamin" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">

 <option value="">-- Pilih --</option>

 <option value="L"
 @selected(old('jenis_kelamin', $permohonanSurat->data_surat['jenis_kelamin'] ?? '') == 'L')>
 Laki-laki
 </option>

 <option value="P"
 @selected(old('jenis_kelamin', $permohonanSurat->data_surat['jenis_kelamin'] ?? '') == 'P')>
 Perempuan
 </option>

 </select>

 </div>

 <div class="w-full md:w-1/2 px-3 mb-4">
 <label class="form-label">Agama</label>

 <select name="agama" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
 <option value="">-- Pilih Agama --</option>

 @foreach(\App\Models\Penduduk::agamaList() as $agama)
 <option value="{{ $agama }}"
 @selected(old('agama', $permohonanSurat->data_surat['agama'] ?? '') == $agama)>
 {{ $agama }}
 </option>
 @endforeach
 </select>
</div>

 <div class="w-full md:w-1/2 px-3 mb-4">
 <label class="form-label">Pekerjaan</label>

 <select name="pekerjaan" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
 <option value="">-- Pilih Pekerjaan --</option>

 @foreach(\App\Models\Penduduk::pekerjaanList() as $pekerjaan)
 <option value="{{ $pekerjaan }}"
 @selected(old('pekerjaan', $permohonanSurat->data_surat['pekerjaan'] ?? '') == $pekerjaan)>
 {{ $pekerjaan }}
 </option>
 @endforeach
 </select>
</div>

 <div class="w-full md:w-1/2 px-3 mb-4">
 <label class="form-label">Telepon</label>
 <input type="text"
 name="telepon"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 value="{{ old('telepon', $permohonanSurat->data_surat['telepon'] ?? '') }}">
 </div>

 {{-- RT --}}
<div class="w-full md:w-1/4 px-3 mb-4">
 <label class="form-label">RT</label>
 <input
 type="text"
 name="rt"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 value="{{ old('rt', $permohonanSurat->data_surat['rt'] ?? '') }}">
</div>

{{-- RW --}}
<div class="w-full md:w-1/4 px-3 mb-4">
 <label class="form-label">RW</label>
 <input
 type="text"
 name="rw"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 value="{{ old('rw', $permohonanSurat->data_surat['rw'] ?? '') }}">
</div>

{{-- Lama Tinggal --}}
<div class="w-full md:w-1/4 px-3 mb-4">
 <label class="form-label">Lama Tinggal</label>
 <input
 type="text"
 name="lama_tinggal"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="Contoh: 2 Tahun"
 value="{{ old('lama_tinggal', $permohonanSurat->data_surat['lama_tinggal'] ?? '') }}">
</div>

{{-- Status Tempat Tinggal --}}
<div class="w-full md:w-1/4 px-3 mb-4">
 <label class="form-label">Status Tempat Tinggal</label>

 <select
 name="status_tempat_tinggal"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">

 <option value="">-- Pilih Status --</option>

 <option value="Milik Sendiri"
 @selected(old('status_tempat_tinggal', $permohonanSurat->data_surat['status_tempat_tinggal'] ?? '') == 'Milik Sendiri')>
 Milik Sendiri
 </option>

 <option value="Kontrak"
 @selected(old('status_tempat_tinggal', $permohonanSurat->data_surat['status_tempat_tinggal'] ?? '') == 'Kontrak')>
 Kontrak
 </option>

 <option value="Kos"
 @selected(old('status_tempat_tinggal', $permohonanSurat->data_surat['status_tempat_tinggal'] ?? '') == 'Kos')>
 Kos
 </option>

 <option value="Menumpang"
 @selected(old('status_tempat_tinggal', $permohonanSurat->data_surat['status_tempat_tinggal'] ?? '') == 'Menumpang')>
 Menumpang
 </option>

 </select>
</div>

{{-- Alamat Asal --}}
<div class="w-full px-3 mb-4">
 <label class="form-label">Alamat Asal</label>

 <textarea
 name="alamat_asal"
 rows="3"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="Alamat sebelum berdomisili">{{ old('alamat_asal', $permohonanSurat->data_surat['alamat_asal'] ?? '') }}</textarea>
</div> 

 <div class="w-full px-3 mb-4">
 <label class="form-label">Alamat Domisili</label>

 <textarea
 name="alamat"
 rows="3"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">{{ old('alamat', $permohonanSurat->data_surat['alamat'] ?? '') }}</textarea>
 </div>

 </div>

 </div>

</div>


<div class="flex flex-wrap -mx-3" style="padding-left:5mm;">

 {{-- Tanggal Permohonan --}}
 <div class="w-full md:w-1/3 px-3 mb-4">

 <label class="form-label">
 Tanggal Permohonan
 </label>

 <input
 type="date"
 name="tanggal_permohonan"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error('tanggal_permohonan') is-invalid @enderror"
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
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error('penandatangan_id') is-invalid @enderror"
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
<div class="mb-4">

 <label class="form-label">
 Keperluan
 <span class="text-danger">*</span>
 </label>

 <textarea
 name="keperluan"
 rows="4"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error('keperluan') is-invalid @enderror"
 placeholder="Tuliskan keperluan permohonan surat...">{{ old('keperluan', $permohonanSurat->keperluan ?? '') }}</textarea>

 @error('keperluan')
 <div class="invalid-feedback">{{ $message }}</div>
 @enderror

</div>

{{-- Catatan --}}
<div class="mb-6">

 <label class="form-label">
 Catatan
 </label>

 <textarea
 name="catatan"
 rows="3"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error('catatan') is-invalid @enderror"
 placeholder="Catatan tambahan (opsional)...">{{ old('catatan', $permohonanSurat->catatan ?? '') }}</textarea>

 @error('catatan')
 <div class="invalid-feedback">{{ $message }}</div>
 @enderror

</div>

<div class="flex justify-end">

 <a
 href="{{ isset($permohonanSurat) && $permohonanSurat->exists
 ? route('admin.permohonan-surat.show', $permohonanSurat)
 : route('admin.permohonan-surat.index') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600 mr-2">

 <i class="fa-solid fa-arrow-left"></i>
 Kembali

 </a>

 <button
 type="submit"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

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

 const domisiliFields = document.getElementById('domisili-fields');

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

 // reset semua
 usahaFields.style.display = 'none';
 kematianFields.style.display = 'none';
 orangSamaFields.style.display = 'none';
 domisiliFields.style.display = 'none';

 pemohonField.style.display = 'block';
 pemohonSelect.required = true;

 if (almarhumSelect) {
 almarhumSelect.required = false;
 }

 // Surat Usaha
 if (selectedText.includes('usaha')) {
 usahaFields.style.display = 'block';
 }

 // Surat Orang Yang Sama
 if (selectedText.includes('orang yang sama')) {
 orangSamaFields.style.display = 'block';
 }

 // Surat Domisili
 if (selectedText.includes('domisili')) {

 domisiliFields.style.display = 'block';

 pemohonField.style.display = 'none';
 pemohonSelect.required = false;
 }

 // Surat Kematian
 if (selectedText.includes('kematian')) {

 kematianFields.style.display = 'block';

 pemohonField.style.display = 'none';
 pemohonSelect.required = false;

 if (almarhumSelect) {
 almarhumSelect.required = true;
 }
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