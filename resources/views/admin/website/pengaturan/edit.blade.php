@extends('layouts.admin')

@section('title', 'Edit Website')

@section('content')

{{-- HEADER --}}
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Edit Website</h2>
        <p class="text-sm text-slate-500 mt-1">Perbarui identitas dan informasi website SIP Bongki.</p>
    </div>
    <a href="{{ route('admin.website.pengaturan.index') }}"
       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all hover:-translate-y-0.5 focus:outline-none active:scale-95 cursor-pointer">
        <i class="fa-solid fa-arrow-left-long text-slate-400"></i> Kembali
    </a>
</div>

<form action="{{ route('admin.website.pengaturan.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- VALIDASI ERROR --}}
    @if($errors->any())
    <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 flex gap-3 items-start">
        <i class="fa-solid fa-circle-exclamation text-red-500 mt-0.5"></i>
        <div>
            <h4 class="text-sm font-bold text-red-800">Mohon periksa kembali input Anda:</h4>
            <ul class="text-sm text-red-600 mt-1 list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <div class="space-y-6">

        {{-- ============================================================
         IDENTITAS WEBSITE
        ============================================================ --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h5 class="text-sm font-bold text-slate-800">Identitas Website</h5>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Website</label>
                    <input type="text" name="nama_website"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
                        placeholder="Contoh: SIP Bongki"
                        value="{{ old('nama_website', $setting->nama_website ?? '') }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Kelurahan</label>
                    <input type="text" name="nama_kelurahan"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
                        placeholder="Contoh: Kelurahan Bongki"
                        value="{{ old('nama_kelurahan', $setting->nama_kelurahan ?? '') }}">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi Website</label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
                        placeholder="Deskripsi singkat tentang kelurahan...">{{ old('deskripsi', $setting->deskripsi ?? '') }}</textarea>
                </div>
            </div>
        </div>

        {{-- ============================================================
         LOGO & FAVICON
        ============================================================ --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h5 class="text-sm font-bold text-slate-800">Logo & Favicon</h5>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Logo --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Logo Website</label>
                    @if(!empty($setting->logo))
                    <div class="mb-3 p-3 bg-slate-50 rounded-xl border border-slate-200 inline-block">
                        <img src="{{ asset('storage/'.$setting->logo) }}" alt="Logo" class="max-h-24 object-contain">
                    </div>
                    @endif
                    <input type="file" name="logo" accept="image/*"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3 py-2 transition-colors shadow-sm cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-primary-light file:text-primary hover:file:bg-primary/20 file:cursor-pointer">
                    <p class="text-xs text-slate-400 mt-1.5">Format: JPG, PNG, SVG. Maks 2MB.</p>
                </div>
                {{-- Favicon --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Favicon</label>
                    @if(!empty($setting->favicon))
                    <div class="mb-3 p-3 bg-slate-50 rounded-xl border border-slate-200 inline-block">
                        <img src="{{ asset('storage/'.$setting->favicon) }}" alt="Favicon" class="max-h-16 object-contain">
                    </div>
                    @endif
                    <input type="file" name="favicon" accept="image/*"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3 py-2 transition-colors shadow-sm cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-primary-light file:text-primary hover:file:bg-primary/20 file:cursor-pointer">
                    <p class="text-xs text-slate-400 mt-1.5">Format: ICO, PNG. Disarankan 32×32 pixel.</p>
                </div>
            </div>
        </div>

        {{-- ============================================================
         HERO LANDING PAGE
        ============================================================ --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h5 class="text-sm font-bold text-slate-800">Hero Landing Page</h5>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Badge Hero</label>
                    <input type="text" name="badge"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
                        placeholder="Contoh: Selamat Datang di SIP Bongki"
                        value="{{ old('badge', $setting->badge ?? '') }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Judul Hero</label>
                    <input type="text" name="judul_hero"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
                        placeholder="Contoh: Sistem Informasi &amp; Pelayanan"
                        value="{{ old('judul_hero', $setting->judul_hero ?? '') }}">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Sub Judul Hero</label>
                    <input type="text" name="subjudul_hero"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
                        placeholder="Contoh: Kelurahan Bongki"
                        value="{{ old('subjudul_hero', $setting->subjudul_hero ?? '') }}">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi Hero</label>
                    <textarea name="deskripsi_hero" rows="4"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
                        placeholder="Teks deskripsi di bawah judul hero...">{{ old('deskripsi_hero', $setting->deskripsi_hero ?? '') }}</textarea>
                </div>
            </div>
        </div>

        {{-- ============================================================
         GAMBAR HERO
        ============================================================ --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h5 class="text-sm font-bold text-slate-800">Gambar Hero</h5>
            </div>
            <div class="p-6">
                @if(!empty($setting->gambar_hero))
                <div class="mb-4">
                    <img src="{{ asset('storage/'.$setting->gambar_hero) }}" alt="Gambar Hero"
                        class="max-h-56 rounded-xl object-cover border border-slate-200">
                </div>
                @endif
                <input type="file" name="gambar_hero" accept="image/*"
                    class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-3 py-2 transition-colors shadow-sm cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-primary-light file:text-primary hover:file:bg-primary/20 file:cursor-pointer">
                <p class="text-xs text-slate-400 mt-1.5">Disarankan ukuran 1200 × 900 pixel. Maks 5MB.</p>
            </div>
        </div>

        {{-- ============================================================
         TOMBOL HERO
        ============================================================ --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h5 class="text-sm font-bold text-slate-800">Tombol Hero</h5>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Teks Tombol Pertama</label>
                    <input type="text" name="hero_button_1_text"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
                        placeholder="Contoh: Ajukan Surat"
                        value="{{ old('hero_button_1_text', $setting->hero_button_1_text ?? '') }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Link Tombol Pertama</label>
                    <input type="text" name="hero_button_1_link"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
                        placeholder="https://..."
                        value="{{ old('hero_button_1_link', $setting->hero_button_1_link ?? '') }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Teks Tombol Kedua</label>
                    <input type="text" name="hero_button_2_text"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
                        placeholder="Contoh: Pelajari Lebih Lanjut"
                        value="{{ old('hero_button_2_text', $setting->hero_button_2_text ?? '') }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Link Tombol Kedua</label>
                    <input type="text" name="hero_button_2_link"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
                        placeholder="https://..."
                        value="{{ old('hero_button_2_link', $setting->hero_button_2_link ?? '') }}">
                </div>
            </div>
        </div>

        {{-- ============================================================
         KONTAK WEBSITE
        ============================================================ --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h5 class="text-sm font-bold text-slate-800">Kontak Website</h5>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Telepon</label>
                    <input type="text" name="telepon"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
                        placeholder="Contoh: (0411) 123456"
                        value="{{ old('telepon', $setting->telepon ?? '') }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">WhatsApp</label>
                    <input type="text" name="whatsapp"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
                        placeholder="628xxxxxxxxxx"
                        value="{{ old('whatsapp', $setting->whatsapp ?? '') }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                    <input type="email" name="email"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
                        placeholder="email@kelurahan.go.id"
                        value="{{ old('email', $setting->email ?? '') }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Jam Pelayanan</label>
                    <input type="text" name="jam_pelayanan"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
                        placeholder="Senin – Jumat, 08.00 – 16.00 WITA"
                        value="{{ old('jam_pelayanan', $setting->jam_pelayanan ?? '') }}">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
                        placeholder="Jl. ...">{{ old('alamat', $setting->alamat ?? '') }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Embed Google Maps</label>
                    <textarea name="google_maps" rows="4"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm font-mono text-xs"
                        placeholder="Tempel kode &lt;iframe&gt; dari Google Maps di sini">{{ old('google_maps', $setting->google_maps ?? '') }}</textarea>
                    <p class="text-xs text-slate-400 mt-1.5">Gunakan kode <strong>&lt;iframe&gt;</strong> dari Google Maps (menu Bagikan → Sematkan peta).</p>
                </div>
            </div>
        </div>

        {{-- ============================================================
         MEDIA SOSIAL
        ============================================================ --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h5 class="text-sm font-bold text-slate-800">Media Sosial</h5>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                        <i class="fa-brands fa-facebook text-blue-600 mr-1"></i> Facebook
                    </label>
                    <input type="url" name="facebook"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
                        placeholder="https://facebook.com/..."
                        value="{{ old('facebook', $setting->facebook ?? '') }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                        <i class="fa-brands fa-instagram text-pink-600 mr-1"></i> Instagram
                    </label>
                    <input type="url" name="instagram"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
                        placeholder="https://instagram.com/..."
                        value="{{ old('instagram', $setting->instagram ?? '') }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                        <i class="fa-brands fa-youtube text-red-600 mr-1"></i> YouTube
                    </label>
                    <input type="url" name="youtube"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
                        placeholder="https://youtube.com/..."
                        value="{{ old('youtube', $setting->youtube ?? '') }}">
                </div>
            </div>
        </div>

        {{-- ============================================================
         FOOTER WEBSITE
        ============================================================ --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h5 class="text-sm font-bold text-slate-800">Footer Website</h5>
            </div>
            <div class="p-6 grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Teks Footer</label>
                    <textarea name="footer_text" rows="4"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
                        placeholder="Teks yang ditampilkan di bagian bawah halaman...">{{ old('footer_text', $setting->footer_text ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Copyright</label>
                    <input type="text" name="copyright"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"
                        placeholder="© 2026 Kelurahan Bongki"
                        value="{{ old('copyright', $setting->copyright ?? '') }}">
                </div>
            </div>
        </div>

        {{-- ============================================================
         VISIBILITAS SECTION PUBLIK
        ============================================================ --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h5 class="text-sm font-bold text-slate-800">Visibilitas Section Publik</h5>
            </div>
            <div class="p-6">
                <label class="block text-sm font-semibold text-slate-700 mb-3">Tampilkan / Sembunyikan Section pada Halaman Beranda</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    @foreach([
                        ['name' => 'tampilkan_berita',     'label' => 'Berita'],
                        ['name' => 'tampilkan_pengumuman', 'label' => 'Pengumuman'],
                        ['name' => 'tampilkan_agenda',     'label' => 'Agenda'],
                        ['name' => 'tampilkan_galeri',     'label' => 'Galeri'],
                        ['name' => 'tampilkan_pengaduan',  'label' => 'Pengaduan'],
                        ['name' => 'tampilkan_statistik',  'label' => 'Statistik'],
                        ['name' => 'tampilkan_layanan',    'label' => 'Layanan'],
                    ] as $cb)
                    <label class="flex items-center gap-2.5 p-3 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer hover:bg-primary-50 hover:border-primary-200 transition-colors">
                        <input type="checkbox" name="{{ $cb['name'] }}" value="1"
                            {{ old($cb['name'], $setting->{$cb['name']} ?? true) ? 'checked' : '' }}
                            class="w-4 h-4 rounded text-primary-600 border-slate-300 focus:ring-primary-500 focus:ring-2 focus:outline-none cursor-pointer">
                        <span class="text-sm font-medium text-slate-700">{{ $cb['label'] }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    {{-- FORM FOOTER --}}
    <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-3 mt-6 pt-6 border-t border-slate-200">
        <a href="{{ route('admin.website.pengaturan.index') }}"
            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm focus:outline-none active:scale-95 cursor-pointer">
            Batal
        </a>
        <button type="submit"
            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm hover:-translate-y-0.5 shadow-primary-500/20 focus:outline-none focus:ring-2 focus:ring-primary-500 cursor-pointer active:scale-95">
            <i class="fa-solid fa-save"></i> Simpan Pengaturan
        </button>
    </div>

</form>

@endsection