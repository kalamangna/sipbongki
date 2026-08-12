





    
    

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">
 <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-file-lines text-primary-600 mr-2"></i>Informasi Utama</h3>
 </div>
 <div class="p-6">
 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

 {{-- Jenis Surat --}}
 <div >

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Jenis Surat <span class="text-red-500">*</span>
 </label>

 <select
 name="jenis_surat_id"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
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
 <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
 @enderror

 </div>

 {{-- Pemohon --}}
 <div id="pemohon-field">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Pemohon <span class="text-red-500">*</span>
 </label>

 <select
 id="penduduk_id"
 name="penduduk_id"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">

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
 <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
 @enderror
 </div>
 </div>
</div>
</div>
 {{-- =========================================================
| DATA USAHA
| Hanya untuk Surat Keterangan Usaha
========================================================= --}}
<div id="usaha-fields" class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6" style="display:none;">

 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">
 <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-store text-emerald-500 mr-2"></i>Data Usaha</h3>
 </div>

 <div class="p-6">

 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

 <div >

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Nama Usaha <span class="text-red-500">*</span>
 </label>

 <input
 type="text"
 name="nama_usaha"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 placeholder="Contoh : Warung Kelontong Berkah"
 value="{{ old('nama_usaha', $permohonanSurat->data_surat['nama_usaha'] ?? '') }}">

 </div>

 <div >

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Jenis Usaha <span class="text-red-500">*</span>
 </label>

 <input
 type="text"
 name="jenis_usaha"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 placeholder="Contoh : Perdagangan Sembako"
 value="{{ old('jenis_usaha', $permohonanSurat->data_surat['jenis_usaha'] ?? '') }}">

 </div>

 <div class="md:col-span-2">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Alamat Usaha
 </label>

 <textarea
 name="alamat_usaha"
 rows="2"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 placeholder="Contoh : Jl. Merdeka No. 123, RT 01/RW 02">{{ old('alamat_usaha', $permohonanSurat->data_surat['alamat_usaha'] ?? '') }}</textarea>

 </div>

 <div >

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Lama Usaha
 </label>

 <input
 type="text"
 name="lama_usaha"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 placeholder="Contoh : 5 Tahun"
 value="{{ old('lama_usaha', $permohonanSurat->data_surat['lama_usaha'] ?? '') }}">

 </div>

 <div >

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Keterangan Usaha
 </label>

 <input
 type="text"
 name="keterangan_usaha"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 placeholder="Contoh : Sedang berjalan / Berkembang"
 value="{{ old('keterangan_usaha', $permohonanSurat->data_surat['keterangan_usaha'] ?? '') }}">

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
 <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">

 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">
 <h3 class="font-bold text-slate-800 text-base mb-0">Data Almarhum</h3>
 </div>

 <div class="p-6">

 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

 <div  class="md:col-span-2">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Almarhum 
 <span class="text-red-500">*</span>
 </label>

 <select
 id="penduduk_id_kematian"
 name="almarhum_id"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">

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
<div >

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Hari Meninggal
 <span class="text-red-500">*</span>
 </label>

 <select
 name="hari_meninggal"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">

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

<div >

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Tanggal Meninggal
 <span class="text-red-500">*</span>
 </label>

 <input
 type="date"
 name="tanggal_meninggal"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 value="{{ old('tanggal_meninggal') }}">

</div>

<div >

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Jam Meninggal
 </label>

 <input
 type="time"
 name="jam_meninggal"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 value="{{ old('jam_meninggal') }}">

</div>

<div >

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Tempat Meninggal
 <span class="text-red-500">*</span>
 </label>

 <input
 type="text"
 name="tempat_meninggal"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 placeholder="Contoh: RSUD / Rumah"
 value="{{ old('tempat_meninggal') }}">

</div>

<div  class="md:col-span-2">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Penyebab Kematian
 <span class="text-red-500">*</span>
 </label>

 <textarea
 name="penyebab_kematian"
 rows="3"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 placeholder="Contoh: Sakit / Kecelakaan / Lanjut Usia">{{ old('penyebab_kematian') }}</textarea>

</div>
 </div>

 </div>

 </div>

 

 {{-- =========================================================
 | DATA PELAPOR
 ========================================================= --}}
 <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">
 <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-user-check text-sky-500 mr-2"></i>Data Pelapor</h3>
 </div>

 <div class="p-6">

 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

 <div >

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Pelapor
 <span class="text-red-500">*</span>
 </label>

 <select
 id="pelapor_id"
 name="pelapor_id"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">

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

 <div >

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Hubungan dengan Almarhum / Almarhumah
 </label>

 <select
 name="hubungan_pelapor"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">

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

<div id="orang-sama-fields" class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6" style="display:none;">

 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">
 <strong>
 Data Dokumen Orang Yang Sama
 </strong>
 </div>


 <div class="p-6">


 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


 {{-- Nama dalam dokumen lain --}}
 <div >

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Nama Dalam Dokumen Lain
 <span class="text-red-500">*</span>
 </label>


 <input
 type="text"
 name="nama_lain"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 placeholder="Contoh: ABDUL RAHMAN"
 value="{{ old('nama_lain', $permohonanSurat->data_surat['nama_lain'] ?? '') }}">


 </div>



 {{-- Jenis Dokumen --}}
 <div >

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Jenis Dokumen
 <span class="text-red-500">*</span>
 </label>


 <input
 type="text"
 name="jenis_dokumen"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 placeholder="Contoh: Sertifikat Hak Milik"
 value="{{ old('jenis_dokumen', $permohonanSurat->data_surat['jenis_dokumen'] ?? '') }}">

 </div>





 {{-- Nomor Dokumen --}}
 <div >

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Nomor Dokumen
 <span class="text-red-500">*</span>
 </label>


 <input
 type="text"
 name="nomor_dokumen"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 placeholder="Contoh: SHM No. 1234"
 value="{{ old('nomor_dokumen', $permohonanSurat->data_surat['nomor_dokumen'] ?? '') }}">


 </div>



 {{-- Keterangan --}}
 <div >

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Keterangan Perbedaan
 </label>


 <input
 type="text"
 name="keterangan_perbedaan"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
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
 class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6"
 style="display:none;">

 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">
 <h3 class="font-bold text-slate-800 text-base mb-0">Data Pemohon Domisili</h3>
 </div>

 <div class="p-6">

 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

 <div >
 <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
 <input type="text"
 name="nama_lengkap"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 placeholder="Contoh: Budi Santoso"
 value="{{ old('nama_lengkap', $permohonanSurat->data_surat['nama_lengkap'] ?? '') }}">
 </div>

 <div >
 <label class="block text-sm font-semibold text-slate-700 mb-1.5">NIK</label>
 <input type="text"
 name="nik"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 placeholder="Contoh: 3201234567..."
 value="{{ old('nik', $permohonanSurat->data_surat['nik'] ?? '') }}">
 </div>

 <div >
 <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tempat Lahir</label>
 <input type="text"
 name="tempat_lahir"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 placeholder="Contoh: Jakarta"
 value="{{ old('tempat_lahir', $permohonanSurat->data_surat['tempat_lahir'] ?? '') }}">
 </div>

 <div >
 <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal Lahir</label>
 <input type="date"
 name="tanggal_lahir"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 value="{{ old('tanggal_lahir', $permohonanSurat->data_surat['tanggal_lahir'] ?? '') }}">
 </div>

 <div >
 <label class="block text-sm font-semibold text-slate-700 mb-1.5">Jenis Kelamin</label>

 <select name="jenis_kelamin" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">

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

 <div >
 <label class="block text-sm font-semibold text-slate-700 mb-1.5">Agama</label>

 <select name="agama" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">
 <option value="">-- Pilih Agama --</option>

 @foreach(\App\Models\Penduduk::agamaList() as $agama)
 <option value="{{ $agama }}"
 @selected(old('agama', $permohonanSurat->data_surat['agama'] ?? '') == $agama)>
 {{ $agama }}
 </option>
 @endforeach
 </select>
</div>

 <div >
 <label class="block text-sm font-semibold text-slate-700 mb-1.5">Pekerjaan</label>

 <select name="pekerjaan" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">
 <option value="">-- Pilih Pekerjaan --</option>

 @foreach(\App\Models\Penduduk::pekerjaanList() as $pekerjaan)
 <option value="{{ $pekerjaan }}"
 @selected(old('pekerjaan', $permohonanSurat->data_surat['pekerjaan'] ?? '') == $pekerjaan)>
 {{ $pekerjaan }}
 </option>
 @endforeach
 </select>
</div>

 <div >
 <label class="block text-sm font-semibold text-slate-700 mb-1.5">Telepon</label>
 <input type="text"
 name="telepon"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 placeholder="Contoh: 081234567890"
 value="{{ old('telepon', $permohonanSurat->data_surat['telepon'] ?? '') }}">
 </div>

 {{-- RT --}}
<div >
 <label class="block text-sm font-semibold text-slate-700 mb-1.5">RT</label>
 <input
 type="text"
 name="rt"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 placeholder="001"
 value="{{ old('rt', $permohonanSurat->data_surat['rt'] ?? '') }}">
</div>

{{-- RW --}}
<div >
 <label class="block text-sm font-semibold text-slate-700 mb-1.5">RW</label>
 <input
 type="text"
 name="rw"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 placeholder="002"
 value="{{ old('rw', $permohonanSurat->data_surat['rw'] ?? '') }}">
</div>

{{-- Lama Tinggal --}}
<div >
 <label class="block text-sm font-semibold text-slate-700 mb-1.5">Lama Tinggal</label>
 <input
 type="text"
 name="lama_tinggal"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 placeholder="Contoh: 2 Tahun"
 value="{{ old('lama_tinggal', $permohonanSurat->data_surat['lama_tinggal'] ?? '') }}">
</div>

{{-- Status Tempat Tinggal --}}
<div >
 <label class="block text-sm font-semibold text-slate-700 mb-1.5">Status Tempat Tinggal</label>

 <select
 name="status_tempat_tinggal"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm">

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
<div  class="md:col-span-2">
 <label class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Asal</label>

 <textarea
 name="alamat_asal"
 rows="3"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 placeholder="Alamat sebelum berdomisili">{{ old('alamat_asal', $permohonanSurat->data_surat['alamat_asal'] ?? '') }}</textarea>
</div> 

 <div  class="md:col-span-2">
 <label class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Domisili</label>

 <textarea
 name="alamat"
 rows="3"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 placeholder="Contoh: Jl. Sudirman No. 12">{{ old('alamat', $permohonanSurat->data_surat['alamat'] ?? '') }}</textarea>
 </div>

 </div>

 </div>

</div>

    
    
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">
 <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-circle-info text-teal-500 mr-2"></i>Informasi Tambahan</h3>
 </div>
 <div class="p-6">
 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

 {{-- Tanggal Permohonan --}}
 <div >

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Tanggal Permohonan
 </label>

 <input
 type="date"
 name="tanggal_permohonan"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 value="{{ old('tanggal_permohonan', isset($permohonanSurat) ? $permohonanSurat->tanggal_permohonan->format('Y-m-d') : date('Y-m-d')) }}">

 @error('tanggal_permohonan')
 <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
 @enderror

 </div>

 {{-- Penandatangan --}}
 <div  class="md:col-span-2">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Pejabat Penandatangan
 <span class="text-red-500">*</span>
 </label>

 <select
 name="penandatangan_id"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
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
 <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
 @enderror

 </div>

{{-- Keperluan --}}
<div class="md:col-span-2">
<label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Keperluan
 <span class="text-red-500">*</span>
 </label>

 <textarea
 name="keperluan"
 rows="4"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 placeholder="Tuliskan keperluan permohonan surat...">{{ old('keperluan', $permohonanSurat->keperluan ?? '') }}</textarea>

 @error('keperluan')
 <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
 @enderror

</div>

{{-- Catatan --}}
<div class="md:col-span-2">
<label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Catatan
 </label>

 <textarea
 name="catatan"
 rows="3"
 class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
 placeholder="Catatan tambahan (opsional)...">{{ old('catatan', $permohonanSurat->catatan ?? '') }}</textarea>

 @error('catatan')
 <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
 @enderror

</div>




</div>
 </div>
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