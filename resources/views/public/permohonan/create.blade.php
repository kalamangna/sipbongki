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

                <form method="POST" action="{{ route('permohonan.store') }}" enctype="multipart/form-data" id="permohonan-form">
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

                    @if($isUsaha)
                        <div class="form-step" data-step="1">
                            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 mb-8 overflow-hidden">
                                <div class="bg-slate-50 border-b border-slate-100 px-6 py-4">
                                    <strong class="text-slate-800">Langkah 1: Masukkan NIK dan Tanggal Lahir</strong>
                                </div>
                                <div class="p-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-2">NIK</label>
                                            <input type="text" name="nik" id="lookup-nik" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('nik') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('nik') }}">
                                            @error('nik')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-2">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" id="lookup-tanggal_lahir" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('tanggal_lahir') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('tanggal_lahir') }}">
                                            @error('tanggal_lahir')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="button" class="px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-all duration-200 hover:-translate-y-0.5" id="lookup-button">Lanjutkan</button>
                            </div>
                        </div>

                        <div class="form-step hidden" data-step="2" id="usaha-identity-step">
                            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 mb-8 overflow-hidden">
                                <div class="bg-slate-50 border-b border-slate-100 px-6 py-4">
                                    <strong class="text-slate-800">Langkah 2: Verifikasi Identitas Pemohon</strong>
                                </div>
                                <div class="p-6">
                                    <div id="usaha-verify-error" class="hidden mb-6 bg-red-50 border-l-4 border-red-500 p-4 text-sm text-red-700"></div>
                                    <div id="usaha-verify-message" class="hidden mb-6 bg-blue-50 border-l-4 border-blue-500 p-4 text-sm text-blue-700"></div>

                                    <div id="usaha-existing-summary" class="hidden">
                                        <h5 class="text-lg font-bold text-slate-800 mb-2">Data Penduduk Ditemukan</h5>
                                        <p class="text-slate-600 mb-4">Data Anda telah ditemukan di sistem. Jika sudah benar, lanjutkan ke langkah berikutnya.</p>
                                        <ul class="space-y-3 bg-slate-50 p-4 rounded-xl border border-slate-100">
                                            <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">NIK:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-nik-found"></span></li>
                                            <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">Nama Lengkap:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-nama-found"></span></li>
                                            <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">Tempat, Tanggal Lahir:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-tempat-tanggal-found"></span></li>
                                            <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">Jenis Kelamin:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-jenis-kelamin-found"></span></li>
                                            <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">Alamat:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-alamat-found"></span></li>
                                            <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">RT/RW:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-rt-rw-found"></span></li>
                                            <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">No. HP:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-telepon-found"></span></li>
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
                                        <h5 class="text-lg font-bold text-slate-800 mb-4">Data Penduduk Belum Ditemukan</h5>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">NIK <span class="text-red-500">*</span></label>
                                                <input type="text" name="nik" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('nik') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('nik') }}">
                                                @error('nik')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                                <input type="text" name="nama_lengkap" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('nama_lengkap') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('nama_lengkap') }}">
                                                @error('nama_lengkap')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                                                <select name="jenis_kelamin" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('jenis_kelamin') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                                    <option value="">Pilih</option>
                                                    <option value="L" {{ old('jenis_kelamin')=='L'?'selected':'' }}>Laki-laki</option>
                                                    <option value="P" {{ old('jenis_kelamin')=='P'?'selected':'' }}>Perempuan</option>
                                                </select>
                                                @error('jenis_kelamin')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Lingkungan</label>
                                                <select name="lingkungan_id" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('lingkungan_id') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                                    <option value="">Pilih Lingkungan</option>
                                                    @foreach($lingkungans as $lingkungan)
                                                        <option value="{{ $lingkungan->id }}" {{ old('lingkungan_id')==$lingkungan->id ? 'selected' : '' }}>{{ $lingkungan->nama }}</option>
                                                    @endforeach
                                                </select>
                                                @error('lingkungan_id')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Hubungan Dalam Keluarga</label>
                                                <select name="hubungan_keluarga" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('hubungan_keluarga') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                                    <option value="">Pilih Hubungan</option>
                                                    @foreach(['Kepala Keluarga','Istri','Suami','Anak','Orang Tua','Menantu','Cucu','Famili Lain'] as $h)
                                                        <option value="{{ $h }}" {{ old('hubungan_keluarga')==$h ? 'selected' : '' }}>{{ $h }}</option>
                                                    @endforeach
                                                </select>
                                                @error('hubungan_keluarga')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('tempat_lahir') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('tempat_lahir') }}">
                                                @error('tempat_lahir')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Tanggal Lahir</label>
                                                <input type="date" name="tanggal_lahir" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('tanggal_lahir') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('tanggal_lahir') }}">
                                                @error('tanggal_lahir')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Agama</label>
                                                <select name="agama" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('agama') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                                    <option value="">Pilih Agama</option>
                                                    @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $a)
                                                        <option value="{{ $a }}" {{ old('agama')==$a ? 'selected' : '' }}>{{ $a }}</option>
                                                    @endforeach
                                                </select>
                                                @error('agama')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Status Perkawinan</label>
                                                <select name="status_perkawinan" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('status_perkawinan') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                                    <option value="">Pilih Status</option>
                                                    @foreach(['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati'] as $s)
                                                        <option value="{{ $s }}" {{ old('status_perkawinan')==$s ? 'selected' : '' }}>{{ $s }}</option>
                                                    @endforeach
                                                </select>
                                                @error('status_perkawinan')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Pendidikan</label>
                                                <select name="pendidikan" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('pendidikan') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
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
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Pekerjaan</label>
                                                <select name="pekerjaan" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('pekerjaan') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                                    <option value="">Pilih Pekerjaan</option>
                                                    @foreach(\App\Models\Penduduk::pekerjaanList() as $item)
                                                        <option value="{{ $item }}" {{ old('pekerjaan')==$item ? 'selected' : '' }}>{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                                @error('pekerjaan')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="md:col-span-2">
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Alamat</label>
                                                <textarea name="alamat" rows="3" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('alamat') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">{{ old('alamat') }}</textarea>
                                                @error('alamat')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">RT</label>
                                                <input type="text" name="rt" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('rt') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('rt') }}" placeholder="00">
                                                @error('rt')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">RW</label>
                                                <input type="text" name="rw" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('rw') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('rw') }}" placeholder="00">
                                                @error('rw')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">No. Telepon</label>
                                                <input type="text" name="telepon" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('telepon') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('telepon') }}">
                                                @error('telepon')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Email <small class="text-slate-400 font-normal">(Opsional)</small></label>
                                                <input type="email" name="email" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('email') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('email') }}">
                                                @error('email')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>

                                            <input type="hidden" name="status_validasi_alamat" value="Perlu Verifikasi">

                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Status Penduduk</label>
                                                <select name="aktif" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('aktif') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                                    <option value="1" {{ old('aktif','1') == '1' ? 'selected' : '' }}>Aktif</option>
                                                    <option value="0" {{ old('aktif') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                                                </select>
                                                @error('aktif')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <button type="button" class="prev-step px-6 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition-colors">Sebelumnya</button>
                                <button type="button" class="next-step px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-all duration-200 hover:-translate-y-0.5" id="usaha-identity-next">Lanjut ke Langkah 3</button>
                            </div>
                        </div>
                    @else
                        <div class="form-step" data-step="1">
                            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 mb-8 overflow-hidden">
                                <div class="bg-slate-50 border-b border-slate-100 px-6 py-4">
                                    <strong class="text-slate-800">Langkah 1: Data Pemohon</strong>
                                </div>
                                <div class="p-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-2">NIK</label>
                                            <input type="text" name="nik" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('nik') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('nik') }}">
                                            @error('nik')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                                            <input type="text" name="nama_lengkap" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('nama_lengkap') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('nama_lengkap') }}">
                                            @error('nama_lengkap')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-2">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('jenis_kelamin') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                                <option value="">Pilih</option>
                                                <option value="L" {{ old('jenis_kelamin')=='L'?'selected':'' }}>Laki-laki</option>
                                                <option value="P" {{ old('jenis_kelamin')=='P'?'selected':'' }}>Perempuan</option>
                                            </select>
                                            @error('jenis_kelamin')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-2">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('tempat_lahir') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('tempat_lahir') }}">
                                            @error('tempat_lahir')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-2">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('tanggal_lahir') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('tanggal_lahir') }}">
                                            @error('tanggal_lahir')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-2">Agama</label>
                                            <select name="agama" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('agama') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                                <option value="">Pilih Agama</option>
                                                <option value="Islam" {{ old('agama')=='Islam'?'selected':'' }}>Islam</option>
                                                <option value="Kristen" {{ old('agama')=='Kristen'?'selected':'' }}>Kristen</option>
                                                <option value="Katolik" {{ old('agama')=='Katolik'?'selected':'' }}>Katolik</option>
                                                <option value="Hindu" {{ old('agama')=='Hindu'?'selected':'' }}>Hindu</option>
                                                <option value="Buddha" {{ old('agama')=='Buddha'?'selected':'' }}>Buddha</option>
                                                <option value="Konghucu" {{ old('agama')=='Konghucu'?'selected':'' }}>Konghucu</option>
                                            </select>
                                            @error('agama')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-2">Pekerjaan</label>
                                            <select name="pekerjaan" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('pekerjaan') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                                <option value="">Pilih Pekerjaan</option>
                                                @foreach(\App\Models\Penduduk::pekerjaanList() as $item)
                                                    <option value="{{ $item }}" {{ old('pekerjaan')==$item?'selected':'' }}>{{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @error('pekerjaan')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-2">No. Telepon</label>
                                            <input type="text" name="telepon" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('telepon') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('telepon') }}">
                                            @error('telepon')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end items-center">
                                <button type="button" class="next-step px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-all duration-200 hover:-translate-y-0.5">Lanjut ke Langkah 2</button>
                            </div>
                        </div>
                    @endif

                    @unless($isUsaha)
                        <div class="form-step hidden" data-step="2">
                            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 mb-8 overflow-hidden">
                                <div class="bg-slate-50 border-b border-slate-100 px-6 py-4">
                                    <strong class="text-slate-800">Langkah 2: Alamat Asal</strong>
                                </div>
                                <div class="p-6">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div class="md:col-span-3">
                                            <label class="block text-sm font-medium text-slate-700 mb-2">Alamat Asal</label>
                                            <textarea name="alamat_asal" rows="3" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('alamat_asal') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">{{ old('alamat_asal') }}</textarea>
                                            @error('alamat_asal')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-2">RT</label>
                                            <input type="text" name="rt" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('rt') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('rt') }}" placeholder="00">
                                            @error('rt')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-2">RW</label>
                                            <input type="text" name="rw" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('rw') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('rw') }}" placeholder="00">
                                            @error('rw')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="hidden md:block"></div>
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-slate-700 mb-2">Status Tempat Tinggal</label>
                                            <select name="status_tempat_tinggal" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('status_tempat_tinggal') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                                <option value="">Pilih Status</option>
                                                <option value="Milik Sendiri" {{ old('status_tempat_tinggal')=='Milik Sendiri'?'selected':'' }}>Milik Sendiri</option>
                                                <option value="Kontrak" {{ old('status_tempat_tinggal')=='Kontrak'?'selected':'' }}>Kontrak</option>
                                                <option value="Kos" {{ old('status_tempat_tinggal')=='Kos'?'selected':'' }}>Kos</option>
                                                <option value="Menumpang" {{ old('status_tempat_tinggal')=='Menumpang'?'selected':'' }}>Menumpang</option>
                                            </select>
                                            @error('status_tempat_tinggal')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-2">Lama Tinggal</label>
                                            <input type="text" name="lama_tinggal" class="w-full rounded-xl border-slate-300 focus:border-primary focus:ring focus:ring-primary/20 shadow-sm transition-shadow @error('lama_tinggal') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" value="{{ old('lama_tinggal') }}" placeholder="Contoh : 2 Tahun">
                                            @error('lama_tinggal')<div class="mt-1 text-sm text-red-500">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <button type="button" class="prev-step px-6 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition-colors">Sebelumnya</button>
                                <button type="button" class="next-step px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-all duration-200 hover:-translate-y-0.5">Lanjut ke Langkah 3</button>
                            </div>
                        </div>
                    @endunless

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
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 mb-8 overflow-hidden">
                            <div class="bg-slate-50 border-b border-slate-100 px-6 py-4">
                                <strong class="text-slate-800">Langkah 5: Konfirmasi</strong>
                            </div>
                            <div class="p-6">
                                <p class="mb-6 text-slate-600">Periksa kembali data Anda sebelum mengirim. Semua data akan disimpan dan diproses oleh admin.</p>
                                <div>
                                    <ul class="space-y-3 bg-slate-50 p-6 rounded-xl border border-slate-100">
                                        <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">NIK:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-nik">-</span></li>
                                        <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">Nama:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-nama">-</span></li>
                                        <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">Jenis Surat:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-jenis-surat">{{ optional($selectedJenisSurat)->nama ?? '-' }}</span></li>
                                        @if($isUsaha)
                                            <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">Nama Usaha:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-nama-usaha">-</span></li>
                                            <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">Jenis Usaha:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-jenis-usaha">-</span></li>
                                            <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">Alamat Usaha:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-alamat-usaha">-</span></li>
                                            <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">Lama Usaha:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-lama-usaha">-</span></li>
                                            <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">Upload Foto Tempat Usaha:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-dokumen-tempat-usaha">Belum</span></li>
                                        @else
                                            <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">Alamat Domisili:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-alamat">-</span></li>
                                        @endif
                                        <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">Keperluan:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-keperluan">-</span></li>
                                        <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">Upload KTP:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-dokumen-ktp">Belum</span></li>
                                        <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">Upload KK:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-dokumen-kk">Belum</span></li>
                                        <li class="flex flex-col sm:flex-row"><strong class="sm:w-1/3 text-slate-700">Upload Surat Pengantar RT/RW:</strong> <span class="sm:w-2/3 text-slate-800" id="summary-dokumen-surat-pengantar">Belum</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <button type="button" class="prev-step px-6 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition-colors">Sebelumnya</button>
                            <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-green-500 hover:bg-green-600 text-white font-medium shadow-sm transition-all duration-200 hover:-translate-y-0.5"><i class="fa-solid fa-paper-plane"></i>Kirim Permohonan</button>
                        </div>
                    </div>

                </form>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
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
                        if (data.found && data.dob_match) {
                            summaryNikFound.textContent = data.penduduk.nik || '-';
                            summaryNamaFound.textContent = data.penduduk.nama_lengkap || '-';
                            summaryTempatTanggalFound.textContent = data.penduduk.tempat_lahir + ', ' + data.penduduk.tanggal_lahir;
                            summaryJenisKelaminFound.textContent = data.penduduk.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
                            summaryAlamatFound.textContent = data.penduduk.alamat || '-';
                            summaryRtRwFound.textContent = data.penduduk.rt + '/' + data.penduduk.rw;
                            summaryTeleponFound.textContent = data.penduduk.telepon || '-';
                            existingSummary.classList.remove('hidden');
                            existingHiddenFields.classList.remove('hidden');
                            newDataSection.classList.add('hidden');
                            disableNewDataSection();
                            setExistingFields(data.penduduk);
                            updateSummary();
                            displayLookupMessage('Data penduduk ditemukan. Silakan lanjut ke langkah berikutnya.');
                        } else {
                            existingSummary.classList.add('hidden');
                            existingHiddenFields.classList.add('hidden');
                            newDataSection.classList.remove('hidden');
                            enableNewDataSection();
                            displayLookupMessage('Data penduduk tidak ditemukan. Silakan lengkapi data baru berikut.');
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

                        summaryNikFound.textContent = existingNik || '-';
                        summaryNamaFound.textContent = existingNama || '-';
                        summaryTempatTanggalFound.textContent = (existingTempatLahir || '-') + ', ' + (existingTanggalLahir || '-');
                        summaryJenisKelaminFound.textContent = existingJenisKelamin === 'L' ? 'Laki-laki' : (existingJenisKelamin === 'P' ? 'Perempuan' : '-');
                        summaryAlamatFound.textContent = existingAlamat || '-';
                        summaryRtRwFound.textContent = (existingRt || '-') + '/' + (existingRw || '-');
                        summaryTeleponFound.textContent = existingTelepon || '-';

                        existingSummary.classList.remove('hidden');
                        existingHiddenFields.classList.remove('hidden');
                        if (newDataSection) {
                            newDataSection.classList.add('hidden');
                            disableNewDataSection();
                        }

                        updateSummary();
                    }

                    async function lookupPenduduk() {
                        clearLookupMessages();
                        const nik = lookupNik.value.trim();
                        const tanggal_lahir = lookupTanggal.value;
                        const jenis_surat_id = document.querySelector('[name="jenis_surat_id"]').value;
                        const token = document.querySelector('input[name="_token"]').value;

                        if (!nik || !tanggal_lahir) {
                            displayLookupError('Masukkan NIK dan tanggal lahir sebelum melanjutkan.');
                            return;
                        }
                        // show a visible checking message and disable button during fetch
                        displayLookupMessage('Memeriksa NIK...');
                        if (lookupButton) lookupButton.disabled = true;

                        try {
                            const response = await fetch('{{ route('permohonan.lookup') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': token,
                                    'Accept': 'application/json',
                                },
                                body: JSON.stringify({ nik, tanggal_lahir, jenis_surat_id }),
                            });

                            const data = await response.json();

                            if (!response.ok) {
                                const message = data.error || data.message || 'Terjadi kesalahan saat memeriksa NIK.';
                                displayLookupError(message);
                                return;
                            }

                            // If found but DOB mismatch, show error
                            if (data.found && !data.dob_match) {
                                displayLookupError('Tanggal lahir tidak cocok dengan NIK yang terdaftar.');
                                return;
                            }

                            console.log('lookup result', data);

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
                            displayLookupError('Tidak dapat terhubung ke server. Silakan coba lagi.');
                        } finally {
                            if (lookupButton) lookupButton.disabled = false;
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

                        document.getElementById('summary-nik').textContent = getInputValue('nik');
                        document.getElementById('summary-nama').textContent = getInputValue('nama_lengkap');

                        const summaryJenisSurat = document.getElementById('summary-jenis-surat');
                        if (summaryJenisSurat) {
                            summaryJenisSurat.textContent = selectedJenisSuratId && jenisSuratMap[selectedJenisSuratId]
                                ? jenisSuratMap[selectedJenisSuratId]
                                : '-';
                        }

                        const summaryAlamat = document.getElementById('summary-alamat');
                        if (summaryAlamat) {
                            summaryAlamat.textContent = getInputValue('alamat');
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
                                if (existingSummary) existingSummary.classList.add('d-none');
                                if (existingHiddenFields) existingHiddenFields.classList.add('d-none');
                                if (newDataSection) {
                                    newDataSection.classList.add('d-none');
                                    disableNewDataSection();
                                }
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
                            1: ['nik','tanggal_lahir'],
                            2: ['nama_lengkap','tempat_lahir','jenis_kelamin','agama','pekerjaan','telepon','alamat','rt','rw','lingkungan_id','existing_penduduk_id'],
                            3: ['jenis_surat_id','keperluan','nama_usaha','jenis_usaha','alamat_usaha','lama_usaha'],
                            4: ['dokumen_ktp','dokumen_kk','dokumen_surat_pengantar','dokumen_tempat_usaha'],
                        };

                        for (const [step, fields] of Object.entries(stepFields)) {
                            if (fields.some((field) => errorKeys.includes(field))) {
                                currentStep = parseInt(step, 10);
                                break;
                            }
                        }
                        showStep(currentStep);
                    } else {
                        showStep(currentStep);
                    }
                });
            </script>

        </div>

    </div>

</div>

@endsection
