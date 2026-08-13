@extends('layouts.public')

@section('title', 'Ajukan Permohonan')

@section('content')

<div class="min-h-screen py-24 bg-slate-50 pt-32 flex justify-center">
    <div class="max-w-4xl w-full mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
            <div class="p-8 md:p-12">

                @if(session('success'))
                    <div class="mb-8 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" novalidate action="{{ route('permohonan.store') }}" enctype="multipart/form-data" id="permohonan-form">
                    @csrf

                    <div class="mb-10">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4">
                            <div class="mb-2 sm:mb-0">
                                <strong class="text-slate-800 text-lg">Langkah <span id="current-step" class="text-primary font-extrabold text-xl">1</span> dari <span id="total-steps" class="text-slate-500">5</span></strong>
                            </div>
                            <div>
                                <small class="text-slate-500 font-medium">Isi form bertahap untuk memudahkan pengajuan.</small>
                            </div>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-primary h-2.5 rounded-full transition-all duration-500 ease-out" style="width: 20%" id="step-progress"></div>
                        </div>
                    </div>

                    @php
                        $isUsaha = optional($selectedJenisSurat)->isUsaha();
                    @endphp

                        <div class="form-step" data-step="1">
                            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 mb-8 overflow-hidden">
                            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                                <h3 class="font-bold text-slate-800">Langkah 1: Identitas Pemohon</h3>
                            </div>
                                <div class="p-6">
                                    <div class="flex flex-wrap gap-4 mb-6 pb-6 border-b border-slate-100">
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="radio" name="jenis_pemohon" value="bongki" class="text-primary-600 focus:ring-primary-500" checked onchange="togglePublicPemohon()">
                                            <span class="ml-2 text-sm font-semibold text-slate-700">Penduduk Bongki</span>
                                        </label>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="radio" name="jenis_pemohon" value="luar" class="text-primary-600 focus:ring-primary-500" onchange="togglePublicPemohon()">
                                            <span class="ml-2 text-sm font-semibold text-slate-700">Penduduk Luar Bongki</span>
                                        </label>
                                    </div>

                                    <div id="step-1-lookup-fields">
                                        <div id="usaha-verify-error" class="hidden mb-6 bg-red-50 border-l-4 border-red-500 p-4 text-sm text-red-700"></div>
                                        <p class="text-sm text-slate-500 mb-4">Masukkan NIK Anda untuk kami periksa di database kependudukan.</p>
                                        <div class="grid grid-cols-1 gap-6">
                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">NIK <span class="text-red-500">*</span></label>
                                                <input type="text" name="nik_lookup" required id="lookup-nik" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('nik_lookup') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('nik_lookup') }}" placeholder="Masukkan NIK" minlength="16" maxlength="16" pattern="\d{16}" title="NIK harus 16 digit angka">
                                                @error('nik_lookup')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div id="step-1-manual-fields" style="display:none;">
                                        <p class="text-sm text-slate-500">Anda memilih Penduduk Luar Bongki. Silakan klik Lanjutkan untuk mengisi data diri secara manual pada langkah berikutnya.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="button" class="px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-all duration-200 hover:-translate-y-0.5 cursor-pointer" id="lookup-button">Lanjutkan</button>
                            </div>
                        </div>

                        <div class="form-step hidden" data-step="2" id="usaha-identity-step">
                            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 mb-8 overflow-hidden">
                                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                                    <h3 class="font-bold text-slate-800">Langkah 2: Verifikasi Identitas</h3>
                                </div>
                                <div class="p-6">
                                    <div id="usaha-verify-message" class="hidden mb-6 bg-blue-50 border-l-4 border-blue-500 p-4 text-sm text-blue-700"></div>

                                    <div id="usaha-existing-summary" class="hidden">
                                        <ul class="space-y-3 bg-slate-50 p-4 rounded-xl border border-slate-100">
                                            <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">NIK:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-nik-found"></span></li>
                                            <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">Nama Lengkap:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-nama-found"></span></li>
                                            <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">Alamat:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-alamat-found"></span></li>
                                        </ul>
                                    </div>

                                    <div id="usaha-existing-hidden-fields" class="hidden">
                                        <input type="hidden" name="existing_penduduk_id" id="existing-penduduk-id" value="{{ old('existing_penduduk_id') }}">
                                        <input type="hidden" name="existing_nik" id="existing-nik" value="{{ old('existing_nik') }}">
                                        <input type="hidden" name="existing_nama_lengkap" id="existing-nama-lengkap" value="{{ old('existing_nama_lengkap') }}">
                                        <input type="hidden" name="existing_tempat_lahir" id="existing-tempat-lahir" value="{{ old('existing_tempat_lahir') }}">
                                        <input type="hidden" name="existing_tanggal_lahir" id="existing-tanggal-lahir" value="{{ old('existing_tanggal_lahir') }}">
                                        <input type="hidden" name="existing_jenis_kelamin" id="existing-jenis-kelamin" value="{{ old('existing_jenis_kelamin') }}">
                                        <input type="hidden" name="existing_agama" id="existing-agama" value="{{ old('existing_agama') }}">
                                        <input type="hidden" name="existing_pekerjaan" id="existing-pekerjaan" value="{{ old('existing_pekerjaan') }}">
                                        <input type="hidden" name="existing_telepon" id="existing-telepon" value="{{ old('existing_telepon') }}">
                                        <input type="hidden" name="existing_alamat" id="existing-alamat" value="{{ old('existing_alamat') }}">
                                        <input type="hidden" name="existing_rt" id="existing-rt" value="{{ old('existing_rt') }}">
                                        <input type="hidden" name="existing_rw" id="existing-rw" value="{{ old('existing_rw') }}">
                                        <input type="hidden" name="existing_lingkungan_id" id="existing-lingkungan-id" value="{{ old('existing_lingkungan_id') }}">
                                    </div>

                                    <div id="usaha-new-data" class="hidden">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">NIK <span class="text-red-500">*</span></label>
                                                <input type="text" name="nik" required class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('nik') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('nik') }}" placeholder="Masukkan NIK" minlength="16" maxlength="16" pattern="\d{16}" title="NIK harus 16 digit angka">
                                                @error('nik')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>


                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                                <input type="text" name="nama_lengkap" required class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('nama_lengkap') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('nama_lengkap') }}" placeholder="Masukkan Nama Lengkap">
                                                @error('nama_lengkap')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                                                <select name="jenis_kelamin" required class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('jenis_kelamin') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                                    <option value="">Pilih</option>
                                                    <option value="L" {{ old('jenis_kelamin')=='L'?'selected':'' }}>Laki-laki</option>
                                                    <option value="P" {{ old('jenis_kelamin')=='P'?'selected':'' }}>Perempuan</option>
                                                </select>
                                                @error('jenis_kelamin')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Lingkungan <span class="text-red-500">*</span></label>
                                                <select required name="lingkungan_id" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('lingkungan_id') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                                    <option value="">Pilih Lingkungan</option>
                                                    @foreach($lingkungans as $lingkungan)
                                                        <option value="{{ $lingkungan->id }}" {{ old('lingkungan_id')==$lingkungan->id ? 'selected' : '' }}>{{ $lingkungan->nama }}</option>
                                                    @endforeach
                                                </select>
                                                @error('lingkungan_id')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>


                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                                                <input type="text" name="tempat_lahir" required class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('tempat_lahir') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('tempat_lahir') }}" placeholder="Masukkan Tempat Lahir">
                                                @error('tempat_lahir')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                                                <input type="date" name="tanggal_lahir" required class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('tanggal_lahir') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('tanggal_lahir') }}">
                                                @error('tanggal_lahir')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Agama <span class="text-red-500">*</span></label>
                                                <select name="agama" required class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('agama') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                                    <option value="">Pilih Agama</option>
                                                    @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $a)
                                                        <option value="{{ $a }}" {{ old('agama')==$a ? 'selected' : '' }}>{{ $a }}</option>
                                                    @endforeach
                                                </select>
                                                @error('agama')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Status Perkawinan <span class="text-red-500">*</span></label>
                                                <select required name="status_perkawinan" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('status_perkawinan') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                                    <option value="">Pilih Status</option>
                                                    @foreach(['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati'] as $s)
                                                        <option value="{{ $s }}" {{ old('status_perkawinan')==$s ? 'selected' : '' }}>{{ $s }}</option>
                                                    @endforeach
                                                </select>
                                                @error('status_perkawinan')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Pendidikan <span class="text-red-500">*</span></label>
                                                <select required name="pendidikan" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('pendidikan') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                                    @php
                                                        $pendidikanList = ['Tidak/Belum Sekolah','Belum Tamat SD/Sederajat','SD/Sederajat','SMP/Sederajat','SMA/Sederajat','Diploma I','Diploma II','Diploma III','Diploma IV/S1','S2','S3'];
                                                    @endphp
                                                    <option value="">Pilih Pendidikan</option>
                                                    @foreach($pendidikanList as $p)
                                                        <option value="{{ $p }}" {{ old('pendidikan')==$p ? 'selected' : '' }}>{{ $p }}</option>
                                                    @endforeach
                                                </select>
                                                @error('pendidikan')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Pekerjaan <span class="text-red-500">*</span></label>
                                                <select name="pekerjaan" required class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('pekerjaan') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                                    <option value="">Pilih Pekerjaan</option>
                                                    @foreach(\App\Models\Penduduk::pekerjaanList() as $item)
                                                        <option value="{{ $item }}" {{ old('pekerjaan')==$item ? 'selected' : '' }}>{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                                @error('pekerjaan')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="md:col-span-2">
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Alamat <span class="text-red-500">*</span></label>
                                                <textarea name="alamat" required rows="3" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('alamat') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" placeholder="Masukkan Alamat">{{ old('alamat') }}</textarea>
                                                @error('alamat')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">RT <span class="text-red-500">*</span></label>
                                                <input type="text" name="rt" required class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('rt') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('rt') }}" placeholder="Contoh: 001">
                                                @error('rt')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">RW <span class="text-red-500">*</span></label>
                                                <input type="text" name="rw" required class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('rw') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('rw') }}" placeholder="Contoh: 001">
                                                @error('rw')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">No. Telepon <span class="text-red-500">*</span></label>
                                                <input required type="text" name="telepon" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('telepon') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('telepon') }}" placeholder="Contoh: 08123456789">
                                                @error('telepon')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Email  <span class="text-red-500">*</span></label>
                                                <input required type="email" name="email" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm @error('email') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('email') }}" placeholder="Masukkan Alamat Email">
                                                @error('email')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <input type="hidden" name="status_validasi_alamat" value="Perlu Verifikasi">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <button type="button" class="prev-step cursor-pointer px-6 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition-colors">Sebelumnya</button>
                                <button type="button" class="next-step cursor-pointer px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-all duration-200 hover:-translate-y-0.5" id="usaha-identity-next">Lanjut ke Langkah 3</button>
                            </div>
                        </div>

                    @php
                        $isUsaha = optional($selectedJenisSurat)->isUsaha();
                    @endphp

                    <input type="hidden" name="jenis_surat_id" value="{{ old('jenis_surat_id', $selected) }}">

                    @if($isUsaha)
                        @include('public.permohonan.jenis-surat.usaha')
                    @else
                        @include('public.permohonan.jenis-surat.domisili')
                    @endif

                    <div class="form-step hidden" data-step="5">
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 mb-8 overflow-hidden">
                            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                                <h3 class="font-bold text-slate-800">Langkah 5: Konfirmasi Pengajuan</h3>
                            </div>
                            
                            <div class="p-0">
                                <dl class="divide-y divide-slate-100">
                                    <!-- Kelompok: Data Pemohon -->
                                    <div class="bg-slate-50/50 px-6 py-3 border-b border-slate-100">
                                        <h4 class="text-xs uppercase tracking-wider font-bold text-slate-500">Data Pemohon</h4>
                                    </div>
                                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-slate-50 transition-colors">
                                        <dt class="text-sm font-medium text-slate-500">NIK</dt>
                                        <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0 font-semibold" id="summary-nik">-</dd>
                                    </div>
                                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-slate-50 transition-colors">
                                        <dt class="text-sm font-medium text-slate-500">Nama Lengkap</dt>
                                        <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0 font-semibold" id="summary-nama">-</dd>
                                    </div>

                                    <!-- Kelompok: Detail Surat -->
                                    <div class="bg-slate-50/50 px-6 py-3 border-b border-slate-100 mt-4 sm:mt-0">
                                        <h4 class="text-xs uppercase tracking-wider font-bold text-slate-500">Detail Surat</h4>
                                    </div>
                                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-slate-50 transition-colors">
                                        <dt class="text-sm font-medium text-slate-500">Jenis Surat</dt>
                                        <dd class="mt-1 text-sm text-primary-600 sm:col-span-2 sm:mt-0 font-bold" id="summary-jenis-surat">{{ optional($selectedJenisSurat)->nama ?? '-' }}</dd>
                                    </div>
                                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-slate-50 transition-colors">
                                        <dt class="text-sm font-medium text-slate-500">Keperluan</dt>
                                        <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0 italic" id="summary-keperluan">-</dd>
                                    </div>
                                    
                                    @if($isUsaha)
                                        <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-slate-50 transition-colors">
                                            <dt class="text-sm font-medium text-slate-500">Nama Usaha</dt>
                                            <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0" id="summary-nama-usaha">-</dd>
                                        </div>
                                        <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-slate-50 transition-colors">
                                            <dt class="text-sm font-medium text-slate-500">Jenis Usaha</dt>
                                            <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0" id="summary-jenis-usaha">-</dd>
                                        </div>
                                        <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-slate-50 transition-colors">
                                            <dt class="text-sm font-medium text-slate-500">Alamat Usaha</dt>
                                            <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0" id="summary-alamat-usaha">-</dd>
                                        </div>
                                        <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-slate-50 transition-colors">
                                            <dt class="text-sm font-medium text-slate-500">Lama Usaha</dt>
                                            <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0" id="summary-lama-usaha">-</dd>
                                        </div>
                                    @else
                                        <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-slate-50 transition-colors">
                                            <dt class="text-sm font-medium text-slate-500">Alamat Domisili</dt>
                                            <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0" id="summary-alamat">-</dd>
                                        </div>
                                    @endif

                                    <!-- Kelompok: Dokumen Pendukung -->
                                    <div class="bg-slate-50/50 px-6 py-3 border-b border-slate-100 mt-4 sm:mt-0">
                                        <h4 class="text-xs uppercase tracking-wider font-bold text-slate-500">Dokumen Pendukung</h4>
                                    </div>
                                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-slate-50 transition-colors">
                                        <dt class="text-sm font-medium text-slate-500">Upload KTP</dt>
                                        <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0 flex items-center gap-2">
                                            <i class="fa-solid fa-id-card text-slate-400"></i> <span id="summary-dokumen-ktp" class="font-medium">Belum</span>
                                        </dd>
                                    </div>
                                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-slate-50 transition-colors">
                                        <dt class="text-sm font-medium text-slate-500">Upload KK</dt>
                                        <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0 flex items-center gap-2">
                                            <i class="fa-solid fa-users text-slate-400"></i> <span id="summary-dokumen-kk" class="font-medium">Belum</span>
                                        </dd>
                                    </div>
                                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-slate-50 transition-colors">
                                        <dt class="text-sm font-medium text-slate-500">Surat Pengantar RT/RW</dt>
                                        <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0 flex items-center gap-2">
                                            <i class="fa-solid fa-envelope-open-text text-slate-400"></i> <span id="summary-dokumen-surat-pengantar" class="font-medium">Belum</span>
                                        </dd>
                                    </div>
                                    @if($isUsaha)
                                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-slate-50 transition-colors">
                                        <dt class="text-sm font-medium text-slate-500">Foto Tempat Usaha</dt>
                                        <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0 flex items-center gap-2">
                                            <i class="fa-solid fa-image text-slate-400"></i> <span id="summary-dokumen-tempat-usaha" class="font-medium">Belum</span>
                                        </dd>
                                    </div>
                                    @endif
                                </dl>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <button type="button" class="prev-step cursor-pointer px-6 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition-colors">Sebelumnya</button>
                            <button type="submit" class="cursor-pointer inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-all duration-200 hover:-translate-y-0.5"><i class="fa-solid fa-paper-plane"></i>Kirim Permohonan</button>
                        </div>
                    </div>

                </form>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const formEl = document.getElementById('permohonan-form');
                    
                    if (formEl) {
                        formEl.addEventListener('keydown', function (e) {
                            if (e.key === 'Enter') {
                                // Allow newline in textarea
                                if (e.target.tagName.toLowerCase() === 'textarea') {
                                    return;
                                }
                                
                                e.preventDefault();
                                
                                const currentStepEl = document.querySelector('.form-step:not(.hidden)');
                                if (currentStepEl) {
                                    const nextBtn = currentStepEl.querySelector('#lookup-button, .next-step, button[type="submit"]');
                                    if (nextBtn && !nextBtn.disabled) {
                                        nextBtn.click();
                                    }
                                }
                            }
                        });
                    }

                    const steps = Array.from(document.querySelectorAll('.form-step'));
                    const currentStepLabel = document.getElementById('current-step');
                    const totalStepsLabel = document.getElementById('total-steps');
                    const progressBar = document.getElementById('step-progress');
                    const lookupButton = document.getElementById('lookup-button');
                    const lookupNik = document.getElementById('lookup-nik');
                    const lookupTanggal = document.getElementById('lookup-tanggal_lahir');
                    const identityStep = document.getElementById('usaha-identity-step');
                    const verifyError = document.getElementById('usaha-verify-error');
                    const verifyMessage = document.getElementById('usaha-verify-message');
                    const existingSummary = document.getElementById('usaha-existing-summary');
                    const existingHiddenFields = document.getElementById('usaha-existing-hidden-fields');
                    const newDataSection = document.getElementById('usaha-new-data');
                    const newDataControls = newDataSection ? Array.from(newDataSection.querySelectorAll('input, select, textarea')) : [];
                    const summaryNikFound = document.getElementById('summary-nik-found');
                    const summaryNamaFound = document.getElementById('summary-nama-found');
                    const summaryTempatTanggalFound = document.getElementById('summary-tempat-tanggal-found');
                    const summaryJenisKelaminFound = document.getElementById('summary-jenis-kelamin-found');
                    const summaryAlamatFound = document.getElementById('summary-alamat-found');
                    const summaryRtRwFound = document.getElementById('summary-rt-rw-found');
                    const summaryTeleponFound = document.getElementById('summary-telepon-found');
                    let currentStep = 1;

                    totalStepsLabel.textContent = steps.length;

                    function disableNewDataSection() {
                        if (!newDataSection) {
                            return;
                        }

                        newDataControls.forEach((control) => {
                            control.disabled = true;
                        });
                    }

                    function enableNewDataSection() {
                        if (!newDataSection) {
                            return;
                        }

                        newDataControls.forEach((control) => {
                            control.disabled = false;
                        });
                    }

                    disableNewDataSection();

                    window.togglePublicPemohon = function() {
                        const jenisUsahaPemohon = document.querySelector('input[name="jenis_pemohon"]:checked');
                        const jenisDomisiliPemohon = document.querySelector('input[name="jenis_pemohon_domisili"]:checked');

                        const valUsaha = jenisUsahaPemohon ? jenisUsahaPemohon.value : null;
                        const valDomisili = jenisDomisiliPemohon ? jenisDomisiliPemohon.value : null;

                        const lookupFields = document.getElementById('step-1-lookup-fields');
                        const manualUsahaMsg = document.getElementById('step-1-manual-fields');
                        const lookupBtn = document.getElementById('lookup-button');

                        // For Usaha
                        if (lookupFields && manualUsahaMsg) {
                            if (valUsaha === 'luar') {
                                lookupFields.style.display = 'none';
                                manualUsahaMsg.style.display = 'block';
                                if (lookupNik) lookupNik.required = false;
                                if (lookupBtn) lookupBtn.textContent = 'Lanjutkan & Isi Data Manual';
                            } else {
                                lookupFields.style.display = 'block';
                                manualUsahaMsg.style.display = 'none';
                                if (lookupNik) lookupNik.required = true;
                                if (lookupBtn) lookupBtn.textContent = 'Lanjutkan';
                            }
                        }

                        // For Domisili
                        const domisiliFields = document.getElementById('step-1-domisili-fields');
                        if (domisiliFields) {
                            // Actually for domisili, Bongki or Luar Bongki currently shows the exact same fields in Step 1
                            // because we no longer enforce auto-create Penduduk, both require filling the manual form!
                            // We can just keep it visible.
                            domisiliFields.style.display = 'block';
                        }
                    };

                    window.togglePublicPemohon();

                    function displayLookupError(message) {
                        verifyError.textContent = message;
                        verifyError.classList.remove('hidden');
                        verifyMessage.classList.add('hidden');
                    }

                    function displayLookupMessage(message) {
                        verifyMessage.textContent = message;
                        verifyMessage.classList.remove('hidden');
                        verifyError.classList.add('hidden');
                    }

                    function clearLookupMessages() {
                        verifyError.classList.add('hidden');
                        verifyMessage.classList.add('hidden');
                    }

                    function setExistingFields(penduduk) {
                        document.getElementById('existing-penduduk-id').value = penduduk.id || '';
                        document.getElementById('existing-nik').value = penduduk.nik || '';
                        document.getElementById('existing-nama-lengkap').value = penduduk.nama_lengkap || '';
                        document.getElementById('existing-tempat-lahir').value = penduduk.tempat_lahir || '';
                        document.getElementById('existing-tanggal-lahir').value = penduduk.tanggal_lahir_raw || '';
                        document.getElementById('existing-jenis-kelamin').value = penduduk.jenis_kelamin || '';
                        document.getElementById('existing-agama').value = penduduk.agama || '';
                        document.getElementById('existing-pekerjaan').value = penduduk.pekerjaan || '';
                        document.getElementById('existing-telepon').value = penduduk.telepon || '';
                        document.getElementById('existing-alamat').value = penduduk.alamat || '';
                        document.getElementById('existing-rt').value = penduduk.rt || '';
                        document.getElementById('existing-rw').value = penduduk.rw || '';
                        document.getElementById('existing-lingkungan-id').value = penduduk.lingkungan_id || '';
                    }

                    function showIdentityResult(data) {
                        if (data.found) {
                            window.foundPendudukData = true;
                            if (summaryNikFound) summaryNikFound.textContent = data.penduduk.nik || '-';
                            if (summaryNamaFound) summaryNamaFound.textContent = data.penduduk.nama_lengkap || '-';
                            if (summaryTempatTanggalFound) summaryTempatTanggalFound.textContent = data.penduduk.tempat_lahir + ', ' + data.penduduk.tanggal_lahir;
                            if (summaryJenisKelaminFound) summaryJenisKelaminFound.textContent = data.penduduk.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
                            if (summaryAlamatFound) summaryAlamatFound.textContent = data.penduduk.alamat || '-';
                            if (summaryRtRwFound) summaryRtRwFound.textContent = data.penduduk.rt + '/' + data.penduduk.rw;
                            if (summaryTeleponFound) summaryTeleponFound.textContent = data.penduduk.telepon || '-';
                            existingSummary.classList.remove('hidden');
                            existingHiddenFields.classList.remove('hidden');
                            newDataSection.classList.add('hidden');
                            disableNewDataSection();
                            setExistingFields(data.penduduk);
                            updateSummary();
                            displayLookupMessage('Data penduduk ditemukan. Silakan lanjut ke langkah berikutnya.');
                        } else {
                            window.foundPendudukData = false;
                            existingSummary.classList.add('hidden');
                            existingHiddenFields.classList.add('hidden');
                            newDataSection.classList.remove('hidden');
                            enableNewDataSection();
                            
                            // prefill nik
                            const nikManual = document.querySelector('#usaha-new-data input[name="nik"]');
                            if (nikManual && lookupNik) nikManual.value = lookupNik.value;

                            displayLookupMessage('Data tidak ditemukan, silakan isi form secara manual.');
                        }
                    }

                    function hydrateExistingSummaryFromServerOldValues() {
                        if (!existingHiddenFields || !existingSummary) {
                            return;
                        }

                        const existingPendudukId = document.getElementById('existing-penduduk-id')?.value || '';
                        const existingNik = document.getElementById('existing-nik')?.value || '';
                        const existingNama = document.getElementById('existing-nama-lengkap')?.value || '';
                        const existingTempatLahir = document.getElementById('existing-tempat-lahir')?.value || '';
                        const existingTanggalLahir = document.getElementById('existing-tanggal-lahir')?.value || '';
                        const existingJenisKelamin = document.getElementById('existing-jenis-kelamin')?.value || '';
                        const existingAlamat = document.getElementById('existing-alamat')?.value || '';
                        const existingRt = document.getElementById('existing-rt')?.value || '';
                        const existingRw = document.getElementById('existing-rw')?.value || '';
                        const existingTelepon = document.getElementById('existing-telepon')?.value || '';

                        if (!existingPendudukId && !existingNik && !existingNama) {
                            return;
                        }

                        if (summaryNikFound) summaryNikFound.textContent = existingNik || '-';
                        if (summaryNamaFound) summaryNamaFound.textContent = existingNama || '-';
                        if (summaryTempatTanggalFound) summaryTempatTanggalFound.textContent = (existingTempatLahir || '-') + ', ' + (existingTanggalLahir || '-');
                        if (summaryJenisKelaminFound) summaryJenisKelaminFound.textContent = existingJenisKelamin === 'L' ? 'Laki-laki' : (existingJenisKelamin === 'P' ? 'Perempuan' : '-');
                        if (summaryAlamatFound) summaryAlamatFound.textContent = existingAlamat || '-';
                        if (summaryRtRwFound) summaryRtRwFound.textContent = (existingRt || '-') + '/' + (existingRw || '-');
                        if (summaryTeleponFound) summaryTeleponFound.textContent = existingTelepon || '-';

                        const hasServerErrors = {{ $errors->any() ? 'true' : 'false' }};
                        
                        if (hasServerErrors) {
                            existingSummary.classList.add('hidden');
                            existingHiddenFields.classList.add('hidden');
                            if (newDataSection) {
                                newDataSection.classList.remove('hidden');
                                enableNewDataSection();
                            }
                            window.foundPendudukData = null; // force user to fix the data manually
                        } else {
                            existingSummary.classList.remove('hidden');
                            existingHiddenFields.classList.remove('hidden');
                            if (newDataSection) {
                                newDataSection.classList.add('hidden');
                                disableNewDataSection();
                            }
                        }

                        updateSummary();
                    }

                    async function lookupPenduduk() {
                        clearLookupMessages();

                        const jenisUsahaPemohon = document.querySelector('input[name="jenis_pemohon"]:checked');
                        if (jenisUsahaPemohon && jenisUsahaPemohon.value === 'luar') {
                            if (existingSummary) existingSummary.classList.add('hidden');
                            if (existingHiddenFields) existingHiddenFields.classList.add('hidden');
                            if (newDataSection) {
                                newDataSection.classList.remove('hidden');
                                enableNewDataSection();
                            }
                            displayLookupMessage('Silakan lengkapi data diri Anda secara manual.');

                            steps[0].classList.add('hidden');
                            steps[1].classList.remove('hidden');
                            currentStep = 2;
                            showStep(currentStep);
                            return;
                        }

                        const nik = lookupNik.value.trim();
                        const form = document.getElementById('permohonan-form');
                        
                        if (!nik) {
                            displayLookupError('Masukkan NIK sebelum melanjutkan.');
                            return;
                        }
                        if (nik.length !== 16 || !/^\d+$/.test(nik)) {
                            displayLookupError('NIK harus terdiri dari 16 digit angka.');
                            return;
                        }
                        
                        // show a visible checking message and disable button during fetch
                        lookupButton.disabled = true;
                        lookupButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mencari...';

                        try {
                            const response = await fetch('{{ route('permohonan.lookup', [], false) }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    nik: nik,
                                    jenis_surat_id: form.elements['jenis_surat_id']?.value
                                })
                            });

                            const data = await response.json();

                            if (!response.ok) {
                                const message = data.error || data.message || 'Terjadi kesalahan saat memeriksa NIK.';
                                displayLookupError(message);
                                return;
                            }

                            // Always reveal the identity step for both found and not-found
                            if (identityStep) {
                                identityStep.classList.remove('hidden');
                                currentStep = 2;
                                showStep(currentStep);
                            }

                            // If server explicitly returned found=false, show new data section
                            if (data && data.found === false) {
                                showIdentityResult(data);
                                // focus first input in new data section
                                try {
                                    const firstInput = newDataSection.querySelector('input, select, textarea');
                                    if (firstInput) firstInput.focus();
                                } catch (e) {}
                            } else {
                                // otherwise let showIdentityResult handle found=true
                                showIdentityResult(data);
                            }
                        } catch (error) {
                            console.error('lookup error', error);
                            displayLookupError('Tidak dapat memproses permintaan (Mungkin sesi Anda telah habis). Silakan muat ulang (refresh) halaman ini.');
                        } finally {
                            if (lookupButton) {
                                lookupButton.disabled = false;
                                lookupButton.innerHTML = 'Lanjutkan';
                            }
                        }
                    }

                    function getInputValue(name) {
                        const form = document.getElementById('permohonan-form');
                        if (!form) {
                            return '-';
                        }

                        const existingFieldAliases = {
                            nik: 'existing_nik',
                            nama_lengkap: 'existing_nama_lengkap',
                            tempat_lahir: 'existing_tempat_lahir',
                            tanggal_lahir: 'existing_tanggal_lahir',
                            jenis_kelamin: 'existing_jenis_kelamin',
                            agama: 'existing_agama',
                            pekerjaan: 'existing_pekerjaan',
                            telepon: 'existing_telepon',
                            alamat: 'existing_alamat',
                            rt: 'existing_rt',
                            rw: 'existing_rw',
                            lingkungan_id: 'existing_lingkungan_id'
                        };

                        const requestedNames = [name];
                        if (existingFieldAliases[name]) {
                            requestedNames.push(existingFieldAliases[name]);
                        }

                        const fields = Array.from(form.elements).filter((element) => {
                            if (!requestedNames.includes(element.name)) {
                                return false;
                            }

                            if (element.type === 'button' || element.type === 'submit' || element.type === 'reset') {
                                return false;
                            }

                            if (element.disabled) {
                                return false;
                            }

                            return true;
                        });

                        if (fields.length === 0) {
                            return name === 'dokumen_ktp' || name === 'dokumen_kk' || name === 'dokumen_surat_pengantar' || name === 'dokumen_tempat_usaha'
                                ? 'Belum'
                                : '-';
                        }

                        const filledFields = fields.filter((field) => {
                            if (field.type === 'file') {
                                return field.files && field.files.length > 0;
                            }

                            if (field.type === 'select-one' || field.type === 'select-multiple') {
                                const option = field.options[field.selectedIndex];
                                return option && option.value !== '';
                            }

                            return field.value && String(field.value).trim() !== '';
                        });

                        if (filledFields.length > 0) {
                            const selectedField = filledFields[0];

                            if (selectedField.type === 'file') {
                                return 'Sudah dipilih';
                            }

                            if (selectedField.type === 'textarea' || selectedField.tagName === 'TEXTAREA') {
                                return selectedField.value ? selectedField.value : '-';
                            }

                            return selectedField.value ? selectedField.value : '-';
                        }

                        const fallbackField = fields[0];
                        if (fallbackField && fallbackField.type === 'file') {
                            return fallbackField.files && fallbackField.files.length > 0 ? 'Sudah dipilih' : 'Belum';
                        }

                        if (fallbackField && (fallbackField.type === 'textarea' || fallbackField.tagName === 'TEXTAREA')) {
                            return fallbackField.value ? fallbackField.value : '-';
                        }

                        return name === 'dokumen_ktp' || name === 'dokumen_kk' || name === 'dokumen_surat_pengantar' || name === 'dokumen_tempat_usaha'
                            ? 'Belum'
                            : '-';
                    }

                    function updateSummary() {
                        const form = document.getElementById('permohonan-form');
                        if (!form) {
                            return;
                        }

                        const jenisSuratMap = @json($jenisSurats->pluck('nama', 'id'));
                        const selectedJenisSuratId = Array.from(form.elements).find((element) => element.name === 'jenis_surat_id')?.value;

                        let nikVal = '-';
                        let namaVal = '-';
                        if (window.foundPendudukData) {
                            const existingNik = document.getElementById('existing-nik');
                            const existingNama = document.getElementById('existing-nama-lengkap');
                            nikVal = (existingNik && existingNik.value) ? existingNik.value : '-';
                            namaVal = (existingNama && existingNama.value) ? existingNama.value : '-';
                        } else {
                            const manualNik = document.querySelector('#usaha-new-data input[name="nik"]');
                            const manualNama = document.querySelector('#usaha-new-data input[name="nama_lengkap"]');
                            nikVal = (manualNik && manualNik.value) ? manualNik.value : '-';
                            namaVal = (manualNama && manualNama.value) ? manualNama.value : '-';
                        }

                        document.getElementById('summary-nik').textContent = nikVal;
                        document.getElementById('summary-nama').textContent = namaVal;

                        const summaryJenisSurat = document.getElementById('summary-jenis-surat');
                        if (summaryJenisSurat) {
                            summaryJenisSurat.textContent = selectedJenisSuratId && jenisSuratMap[selectedJenisSuratId]
                                ? jenisSuratMap[selectedJenisSuratId]
                                : '-';
                        }

                        const summaryAlamat = document.getElementById('summary-alamat');
                        if (summaryAlamat) {
                            summaryAlamat.textContent = getInputValue('alamat_domisili') !== '-' ? getInputValue('alamat_domisili') : getInputValue('alamat');
                        }

                        document.getElementById('summary-keperluan').textContent = getInputValue('keperluan');
                        document.getElementById('summary-dokumen-ktp').textContent = getInputValue('dokumen_ktp');
                        document.getElementById('summary-dokumen-kk').textContent = getInputValue('dokumen_kk');
                        document.getElementById('summary-dokumen-surat-pengantar').textContent = getInputValue('dokumen_surat_pengantar');

                        const summaryNamaUsaha = document.getElementById('summary-nama-usaha');
                        if (summaryNamaUsaha) {
                            summaryNamaUsaha.textContent = getInputValue('nama_usaha');
                        }
                        const summaryJenisUsaha = document.getElementById('summary-jenis-usaha');
                        if (summaryJenisUsaha) {
                            summaryJenisUsaha.textContent = getInputValue('jenis_usaha');
                        }
                        const summaryAlamatUsaha = document.getElementById('summary-alamat-usaha');
                        if (summaryAlamatUsaha) {
                            summaryAlamatUsaha.textContent = getInputValue('alamat_usaha');
                        }
                        const summaryLamaUsaha = document.getElementById('summary-lama-usaha');
                        if (summaryLamaUsaha) {
                            summaryLamaUsaha.textContent = getInputValue('lama_usaha');
                        }
                        const summaryDokumenTempatUsaha = document.getElementById('summary-dokumen-tempat-usaha');
                        if (summaryDokumenTempatUsaha) {
                            summaryDokumenTempatUsaha.textContent = getInputValue('dokumen_tempat_usaha');
                        }
                    }

                    function showStep(step) {
                        steps.forEach((element) => {
                            element.classList.toggle('hidden', parseInt(element.dataset.step, 10) !== step);
                        });
                        currentStepLabel.textContent = step;
                        progressBar.style.width = `${(step / steps.length) * 100}%`;

                        if (step === steps.length) {
                            updateSummary();
                        }

                        // Hide identity lookup alerts when leaving the identity step (2)
                        try {
                            if (typeof clearLookupMessages === 'function' && parseInt(step, 10) !== 2) {
                                clearLookupMessages();
                            }
                        } catch (e) {
                            // ignore if identity elements not present
                        }
                    }

                    if (lookupButton) {
                        lookupButton.addEventListener('click', lookupPenduduk);
                    }

                    hydrateExistingSummaryFromServerOldValues();

                    document.querySelectorAll('input, textarea, select').forEach((control) => {
                        control.addEventListener('input', function () {
                            updateSummary();
                        });
                        control.addEventListener('change', function () {
                            updateSummary();
                        });
                    });

                    document.querySelectorAll('.next-step').forEach((button) => {
                        button.addEventListener('click', function () {
                            // Validation logic
                            const currentStepEl = document.querySelector(`.form-step[data-step="${currentStep}"]`);
                            const requiredInputs = currentStepEl.querySelectorAll('input[required], select[required], textarea[required]');
                            let isValid = true;
                            
                            requiredInputs.forEach(input => {
                                // Skip hidden inputs
                                if (input.closest('.hidden')) {
                                    return;
                                }
                                
                                if (!input.value.trim() || !input.checkValidity()) {
                                    isValid = false;
                                    input.classList.remove('border-slate-200', 'focus:border-primary-500');
                                    input.classList.add('border-red-500', 'focus:border-red-500', 'ring-red-500/20');
                                    
                                    let errorEl = input.nextElementSibling;
                                    if (!errorEl || !errorEl.classList.contains('js-validation-error')) {
                                        errorEl = document.createElement('div');
                                        errorEl.className = 'mt-1 text-sm text-red-500 js-validation-error';
                                        input.parentNode.insertBefore(errorEl, input.nextSibling);
                                    }
                                    
                                    let message = 'Bagian ini wajib diisi.';
                                    if (input.validity.valueMissing) {
                                        message = 'Bagian ini wajib diisi.';
                                    } else if (input.validity.tooShort || input.validity.tooLong || input.validity.patternMismatch) {
                                        message = input.title || 'Format isian tidak sesuai.';
                                    } else if (input.validity.typeMismatch) {
                                        message = 'Format tidak valid.';
                                    }
                                    errorEl.textContent = message;


                                    // Remove error styles on input
                                    input.addEventListener('input', function() {
                                        input.classList.remove('border-red-500', 'focus:border-red-500', 'ring-red-500/20');
                                        input.classList.add('border-slate-200', 'focus:border-primary-500');
                                        if (errorEl && errorEl.parentNode) {
                                            errorEl.remove();
                                        }
                                    }, { once: true });
                                }
                            });

                            if (!isValid) {
                                // Scroll to the first error
                                const firstError = currentStepEl.querySelector('.js-validation-error');
                                if (firstError) {
                                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                }
                                return;
                            }

                            if (currentStep < steps.length) {
                                currentStep++;
                                showStep(currentStep);
                            }
                        });
                    });

                    document.querySelectorAll('.prev-step').forEach((button) => {
                        button.addEventListener('click', function () {
                            if (currentStep > 1) {
                                currentStep--;
                                showStep(currentStep);
                            }
                        });
                    });

                    const errorKeys = @json($errors->keys());
                    if (errorKeys.length > 0) {
                        const stepFields = {
                            1: ['nik_lookup','tanggal_lahir_lookup'],
                            2: ['nik','nama_lengkap','tempat_lahir','tanggal_lahir','jenis_kelamin','agama','status_perkawinan','pendidikan','pekerjaan','telepon','email','alamat','rt','rw','lingkungan_id','existing_penduduk_id'],
                            3: ['jenis_surat_id','keperluan','nama_usaha','jenis_usaha','alamat_usaha','lama_usaha','status_tempat_tinggal','lama_tinggal','alamat_domisili','rt_domisili','rw_domisili','alamat_asal'],
                            4: ['dokumen_ktp','dokumen_kk','dokumen_surat_pengantar','dokumen_tempat_usaha'],
                        };

                        // Find the HIGHEST step with an error, so the user sees the last broken step
                        let targetStep = 1;
                        for (const [step, fields] of Object.entries(stepFields)) {
                            if (fields.some((field) => errorKeys.includes(field))) {
                                targetStep = parseInt(step, 10);
                            }
                        }
                        currentStep = targetStep;
                        showStep(currentStep);
                    } else {
                        showStep(currentStep);
                    }
                });
            </script>

        </div>

    </div>

</div>

{{-- DEV AUTO FILL BUTTON --}}
<button type="button" id="dev-autofill-btn" class="fixed bottom-6 left-6 z-50 h-11 px-4 rounded-full bg-slate-800 text-white font-mono text-xs shadow-lg hover:scale-105 hover:bg-slate-900 transition-all flex items-center gap-2 cursor-pointer border border-slate-600">
    <i class="fa-solid fa-flask"></i> Auto Fill
</button>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fillBtn = document.getElementById('dev-autofill-btn');
        if (fillBtn) {
            fillBtn.addEventListener('click', function() {
                // Generate random data
                const randomId = Math.floor(Math.random() * 10000);
                const randNik = '730' + Math.floor(1000000000000 + Math.random() * 9000000000000);
                
                // Helper to set value only if visible and not disabled
                const isVisible = (el) => {
                    return el.offsetWidth > 0 || el.offsetHeight > 0 || el.getClientRects().length > 0;
                };

                const setVal = (selector, value) => {
                    const el = document.querySelector(selector);
                    if (el && !el.value && !el.disabled && isVisible(el)) {
                        el.value = value;
                    }
                };

                const setSelect = (selector) => {
                    const el = document.querySelector(selector);
                    if (el && el.options.length > 1 && !el.disabled && isVisible(el)) {
                        el.selectedIndex = 1; 
                    }
                };
                
                // Try to fill any currently visible text/number inputs
                const randomNames = ['Budi Santoso', 'Siti Aminah', 'Andi Mappanyukki', 'Dewi Lestari', 'Reza Rahadian', 'Ayu Ting Ting', 'Ahmad Dahlan', 'Cut Nyak Dien'];
                const randomCities = ['Makassar', 'Sinjai', 'Bone', 'Bulukumba', 'Gowa', 'Maros', 'Parepare'];
                const randName = randomNames[Math.floor(Math.random() * randomNames.length)] + ' ' + randomId;
                const randCity = randomCities[Math.floor(Math.random() * randomCities.length)];

                document.querySelectorAll('input[type="text"], input[type="number"], input[type="date"], input[type="email"]').forEach(input => {
                    if (!input.value && !input.disabled && isVisible(input)) {
                        if (input.name === 'nik' || input.id === 'lookup-nik') {
                            input.value = randNik;
                        } else if (input.name === 'telepon') {
                            input.value = '0812' + randomId + randomId;
                        } else if (input.name === 'rt' || input.name === 'rw' || input.name === 'rt_domisili' || input.name === 'rw_domisili') {
                            input.value = '00' + Math.floor(Math.random() * 9 + 1);
                        } else if (input.name === 'email') {
                            input.value = 'test' + randomId + '@example.com';
                        } else if (input.type === 'date') {
                            // Random date between 1970 and 2005
                            const year = Math.floor(Math.random() * (2005 - 1970 + 1)) + 1970;
                            const month = String(Math.floor(Math.random() * 12) + 1).padStart(2, '0');
                            const day = String(Math.floor(Math.random() * 28) + 1).padStart(2, '0');
                            input.value = `${year}-${month}-${day}`;
                        } else if (input.name === 'nama_usaha') {
                            const usahas = ['Toko Sejahtera', 'Warung Makan Barokah', 'Kios Maju Jaya', 'CV Bintang Terang'];
                            input.value = usahas[Math.floor(Math.random() * usahas.length)] + ' ' + randomId;
                        } else if (input.name === 'jenis_usaha') {
                            const jenisUsaha = ['Perdagangan Sembako', 'Jasa Konveksi', 'Kuliner', 'Pertanian'];
                            input.value = jenisUsaha[Math.floor(Math.random() * jenisUsaha.length)];
                        } else if (input.name === 'lama_usaha' || input.name === 'lama_tinggal') {
                            input.value = Math.floor(Math.random() * 10 + 1) + ' Tahun';
                        } else if (input.name === 'status_tempat_tinggal') {
                            const statusTinggal = ['Milik Pribadi', 'Sewa', 'Kontrak', 'Menumpang'];
                            input.value = statusTinggal[Math.floor(Math.random() * statusTinggal.length)];
                        } else if (input.name.includes('tempat_lahir')) {
                            input.value = randCity;
                        } else if (input.name === 'nama_lengkap' || input.name === 'nama_pemohon' || input.name === 'nama_lain') {
                            input.value = randName;
                        } else if (input.name === 'tempat_meninggal') {
                            const tempatMeninggal = ['RSUD Sinjai', 'Rumah', 'RS Wahidin', 'Puskesmas'];
                            input.value = tempatMeninggal[Math.floor(Math.random() * tempatMeninggal.length)];
                        } else if (input.name === 'hari_meninggal') {
                            const days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                            input.value = days[Math.floor(Math.random() * days.length)];
                        } else if (input.name === 'jam_meninggal') {
                            const hr = String(Math.floor(Math.random() * 24)).padStart(2, '0');
                            const min = String(Math.floor(Math.random() * 60)).padStart(2, '0');
                            input.value = `${hr}:${min}`;
                        } else if (input.name === 'penyebab_kematian') {
                            const penyebab = ['Sakit', 'Kecelakaan', 'Faktor Usia', 'Lainnya'];
                            input.value = penyebab[Math.floor(Math.random() * penyebab.length)];
                        } else if (input.name === 'hubungan_pelapor') {
                            const hubungan = ['Anak Kandung', 'Istri', 'Suami', 'Orang Tua', 'Saudara Kandung'];
                            input.value = hubungan[Math.floor(Math.random() * hubungan.length)];
                        } else if (input.name === 'jenis_dokumen') {
                            const dokumen = ['Ijazah Terakhir', 'Akta Kelahiran', 'Buku Nikah', 'Sertifikat Tanah'];
                            input.value = dokumen[Math.floor(Math.random() * dokumen.length)];
                        } else if (input.name === 'nomor_dokumen') {
                            input.value = 'DOC-' + Math.floor(Math.random() * 999999);
                        } else {
                            input.value = 'Data ' + randomId;
                        }
                    }
                });

                // Try to fill any currently visible textareas
                document.querySelectorAll('textarea').forEach(ta => {
                    if (!ta.value && !ta.disabled && isVisible(ta)) {
                        if (ta.name === 'keperluan') {
                            ta.value = 'Keperluan administrasi surat nomor ' + randomId;
                        } else if (ta.name === 'alamat' || ta.name === 'alamat_asal' || ta.name === 'alamat_domisili' || ta.name === 'alamat_usaha') {
                            ta.value = 'Jl. Mawar No. ' + Math.floor(Math.random() * 100) + ' Lingkungan ' + randomId;
                        } else if (ta.name === 'keterangan_perbedaan') {
                            const ket = ['Terdapat perbedaan penulisan nama pada KTP dan Ijazah', 'Perbedaan tanggal lahir di KK dan Akta', 'Salah ketik nama orang tua'];
                            ta.value = ket[Math.floor(Math.random() * ket.length)];
                        } else {
                            ta.value = 'Keterangan tambahan ' + randomId;
                        }
                    }
                });

                // Try to fill any currently visible selects
                document.querySelectorAll('select').forEach(sel => {
                    if (sel.options.length > 1 && !sel.disabled && isVisible(sel) && (!sel.value || sel.selectedIndex === 0)) {
                        // Pick a random index from 1 to length-1 (skip the 'Pilih' default option at index 0)
                        const randomOptionIndex = Math.floor(Math.random() * (sel.options.length - 1)) + 1;
                        sel.selectedIndex = randomOptionIndex;
                    }
                });

                // Try to fill any currently visible file inputs
                const visibleFileInputs = Array.from(document.querySelectorAll('input[type="file"]')).filter(input => !input.files.length && !input.disabled && isVisible(input));
                if (visibleFileInputs.length > 0) {
                    fetch('/images/meta.png')
                        .then(res => res.blob())
                        .then(blob => {
                            const file = new File([blob], 'meta.png', { type: blob.type || 'image/png' });
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(file);
                            
                            visibleFileInputs.forEach(input => {
                                input.files = dataTransfer.files;
                                input.dispatchEvent(new Event('change', { bubbles: true }));
                            });
                        })
                        .catch(err => console.error('Auto Fill File Error:', err));
                }
            });
        }
    });
</script>

@endsection
