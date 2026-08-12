@extends('layouts.admin')


@section('title', 'Edit Pengaturan Website')


@section('content')


<div class="w-full">


 {{-- HEADER --}}
 <div class="flex justify-between items-center mb-6">


 <div>

 


 <h3 class="text-2xl font-bold text-slate-800 mb-1">Edit Pengaturan</h3>
 <p class="text-slate-500 mb-0">
 Perbarui identitas dan informasi website SIP Bongki.
 </p>


 </div>




 <a href="{{ route('admin.website.pengaturan.index') }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm focus:outline-none active:scale-95 cursor-pointer">


 <i class="fa-solid fa-arrow-left mr-2"></i>

 Kembali


 </a>


 </div>







 <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">


 <div class="p-6">





 <form action="{{ route('admin.website.pengaturan.update') }}"
 method="POST"
 enctype="multipart/form-data">


 @csrf

 @method('PUT')




{{-- =========================================================
 IDENTITAS WEBSITE
========================================================= --}}

<div class="border border-slate-100 rounded-xl overflow-hidden mb-6">

 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">

 <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-building mr-2 text-primary-600 mr-2"></i> Identitas Website
 </h3>

 </div>

 <div class="p-6">

 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

 <div class="md:col-span-1">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Nama Website
 </label>

 <input
 type="text"
 name="nama_website"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error('nama_website') is-invalid @enderror"
 value="{{ old('nama_website', $setting->nama_website ?? '') }}">

 @error('nama_website')
 <div class="invalid-feedback">
 {{ $message }}
 </div>
 @enderror

 </div>

 <div class="md:col-span-1">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Nama Kelurahan
 </label>

 <input
 type="text"
 name="nama_kelurahan"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error('nama_kelurahan') is-invalid @enderror"
 value="{{ old('nama_kelurahan', $setting->nama_kelurahan ?? '') }}">

 </div>

 <div class="md:col-span-2">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Deskripsi Website
 </label>

 <textarea
 name="deskripsi"
 rows="4"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">{{ old('deskripsi', $setting->deskripsi ?? '') }}</textarea>

 </div>

 </div>

 </div>

</div>


{{-- =========================================================
 LOGO & FAVICON
========================================================= --}}

<div class="border border-slate-100 rounded-xl overflow-hidden mb-6">

 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">

 <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-image mr-2 text-primary-600 mr-2"></i> Logo & Favicon
 </h3>

 </div>

 <div class="p-6">

 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

 <div class="md:col-span-1">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Logo Website
 </label>

@if(!empty($setting->logo))

<div class="mb-4">

 <img
 id="logoPreview"
 src="{{ asset('storage/'.$setting->logo) }}"
 class="img-thumbnail"
 style="max-height:120px">

</div>

@else

<div class="mb-4">

 <img
 id="logoPreview"
 class="img-thumbnail hidden"
 style="max-height:120px">

</div>

@endif 

 <input
 type="file"
 id="logo"
 name="logo"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 accept="image/*">

 </div>

 <div class="md:col-span-1">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Favicon
 </label>

 @if(!empty($setting->favicon))

 <div class="mb-4">

 <img
 src="{{ asset('storage/'.$setting->favicon) }}"
 class="img-thumbnail"
 style="max-height:70px">

 </div>

 @endif

 <input
 type="file"
 name="favicon"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 accept="image/*">

 </div>

 </div>

 </div>

</div>

{{-- =========================================================
 HERO LANDING PAGE
========================================================= --}}

<div class="border border-slate-100 rounded-xl overflow-hidden mb-6">

 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">

 <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-stars mr-2 text-primary-600 mr-2"></i> Hero Landing Page
 </h3>

 </div>

 <div class="p-6">

 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

 {{-- Badge --}}
 <div class="md:col-span-1">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Badge Hero
 </label>

 <input
 type="text"
 name="px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="Contoh : Selamat Datang di SIP Bongki"
 value="{{ old('px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800',$setting->px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800 ?? '') }}">

 </div>

 {{-- Judul --}}
 <div class="md:col-span-1">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Judul Hero
 </label>

 <input
 type="text"
 name="judul_hero"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="Sistem Informasi &"
 value="{{ old('judul_hero',$setting->judul_hero ?? '') }}">

 </div>

 {{-- Sub Judul --}}
 <div class="md:col-span-2">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Sub Judul Hero
 </label>

 <input
 type="text"
 name="subjudul_hero"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="Pelayanan Kelurahan Bongki"
 value="{{ old('subjudul_hero',$setting->subjudul_hero ?? '') }}">

 </div>

 {{-- Deskripsi --}}
 <div class="md:col-span-2">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Deskripsi Hero
 </label>

 <textarea
 name="deskripsi_hero"
 rows="5"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">{{ old('deskripsi_hero',$setting->deskripsi_hero ?? '') }}</textarea>

 </div>

 </div>

 </div>

</div>

{{-- =========================================================
 GAMBAR HERO
========================================================= --}}

<div class="border border-slate-100 rounded-xl overflow-hidden mb-6">

 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">

 <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-image mr-2 text-primary-600 mr-2"></i> Gambar Hero
 </h3>

 </div>

 <div class="p-6">

 @if(!empty($setting->gambar_hero))

 <div class="mb-4">

 <img
 src="{{ asset('storage/'.$setting->gambar_hero) }}"
 class="img-thumbnail"
 style="max-height:220px">

 </div>

 @endif

 <input
 type="file"
 name="gambar_hero"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 accept="image/*">

 <small class="text-slate-500">
 Disarankan ukuran 1200 × 900 pixel.
 </small>

 </div>

</div>

{{-- =========================================================
 TOMBOL HERO
========================================================= --}}

<div class="border border-slate-100 rounded-xl overflow-hidden mb-6">

 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">

 <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-cursor-fill mr-2 text-primary-600 mr-2"></i> Tombol Hero
 </h3>

 </div>

 <div class="p-6">

 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

 <div class="md:col-span-1">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Teks Tombol Pertama
 </label>

 <input
 type="text"
 name="hero_button_1_text"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 value="{{ old('hero_button_1_text',$setting->hero_button_1_text ?? '') }}">

 </div>

 <div class="md:col-span-1">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Link Tombol Pertama
 </label>

 <input
 type="text"
 name="hero_button_1_link"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 value="{{ old('hero_button_1_link',$setting->hero_button_1_link ?? '') }}">

 </div>

 <div class="md:col-span-1">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Teks Tombol Kedua
 </label>

 <input
 type="text"
 name="hero_button_2_text"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 value="{{ old('hero_button_2_text',$setting->hero_button_2_text ?? '') }}">

 </div>

 <div class="md:col-span-1">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Link Tombol Kedua
 </label>

 <input
 type="text"
 name="hero_button_2_link"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 value="{{ old('hero_button_2_link',$setting->hero_button_2_link ?? '') }}">

 </div>

 </div>

 </div>

</div>

{{-- =========================================================
 KONTAK WEBSITE
========================================================= --}}

<div class="border border-slate-100 rounded-xl overflow-hidden mb-6">

 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">

 <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-telephone-fill mr-2 text-primary-600 mr-2"></i> Kontak Website
 </h3>

 </div>

 <div class="p-6">

 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

 {{-- Telepon --}}
 <div class="md:col-span-1">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Telepon
 </label>

 <input
 type="text"
 name="telepon"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 value="{{ old('telepon', $setting->telepon ?? '') }}">

 </div>

 {{-- WhatsApp --}}
 <div class="md:col-span-1">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 WhatsApp
 </label>

 <input
 type="text"
 name="whatsapp"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="628xxxxxxxxxx"
 value="{{ old('whatsapp', $setting->whatsapp ?? '') }}">

 </div>

 {{-- Email --}}
 <div class="md:col-span-1">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Email
 </label>

 <input
 type="email"
 name="email"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 value="{{ old('email', $setting->email ?? '') }}">

 </div>

 {{-- Jam Pelayanan --}}
 <div class="md:col-span-1">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Jam Pelayanan
 </label>

 <input
 type="text"
 name="jam_pelayanan"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="Senin - Jumat, 08.00 - 16.00 WITA"
 value="{{ old('jam_pelayanan', $setting->jam_pelayanan ?? '') }}">

 </div>

 {{-- Alamat --}}
 <div class="md:col-span-2">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Alamat Lengkap
 </label>

 <textarea
 name="alamat"
 rows="3"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">{{ old('alamat', $setting->alamat ?? '') }}</textarea>

 </div>

 {{-- Google Maps --}}
 <div class="md:col-span-2">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Embed Google Maps
 </label>

 <textarea
 name="google_maps"
 rows="5"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="Tempel kode iframe Google Maps di sini">{{ old('google_maps', $setting->google_maps ?? '') }}</textarea>

 <small class="text-slate-500">
 Gunakan kode <strong>&lt;iframe&gt;</strong> dari Google Maps (menu Bagikan → Sematkan peta).
 </small>

 </div>

 </div>

 </div>

</div>


{{-- =========================================================
 MEDIA SOSIAL
========================================================= --}}

<div class="border border-slate-100 rounded-xl overflow-hidden mb-6">

 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">

 <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-share-fill mr-2 text-primary-600 mr-2"></i> Media Sosial
 </h3>

 </div>

 <div class="p-6">

 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

 {{-- Facebook --}}
 <div class="md:col-span-1">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 <i class="fa-solid fa-facebook text-primary mr-1"></i>
 Facebook
 </label>

 <input
 type="url"
 name="facebook"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="https://facebook.com/..."
 value="{{ old('facebook',$setting->facebook ?? '') }}">

 </div>

 {{-- Instagram --}}
 <div class="md:col-span-1">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 <i class="fa-solid fa-instagram text-danger mr-1"></i>
 Instagram
 </label>

 <input
 type="url"
 name="instagram"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="https://instagram.com/..."
 value="{{ old('instagram',$setting->instagram ?? '') }}">

 </div>

 {{-- Youtube --}}
 <div class="md:col-span-1">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 <i class="fa-solid fa-youtube text-danger mr-1"></i>
 YouTube
 </label>

 <input
 type="url"
 name="youtube"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="https://youtube.com/..."
 value="{{ old('youtube',$setting->youtube ?? '') }}">

 </div>

 </div>

 </div>

</div>

{{-- =========================================================
 FOOTER WEBSITE
========================================================= --}}

<div class="border border-slate-100 rounded-xl overflow-hidden mb-6">

 <div class="px-6 py-4 border-b border-slate-200 bg-dark text-white">

 <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-layout-text-sidebar-reverse mr-2 text-primary-600 mr-2"></i> Footer Website
 </h3>

 </div>

 <div class="p-6">

 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

 <div class="md:col-span-2">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Footer Text
 </label>

 <textarea
 name="footer_text"
 rows="4"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">{{ old('footer_text',$setting->footer_text ?? '') }}</textarea>

 </div>

 <div class="md:col-span-2">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Copyright
 </label>

 <input
 type="text"
 name="copyright"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
 placeholder="© 2026 Kelurahan Bongki"
 value="{{ old('copyright',$setting->copyright ?? '') }}">

 </div>

 </div>

 </div>

</div>

{{-- =========================================================
 SEO WEBSITE
========================================================= --}}

<div class="border border-slate-100 rounded-xl overflow-hidden mb-6">

 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">

 <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-magnifying-glass mr-2 text-primary-600 mr-2"></i> SEO Website
 </h3>

 </div>

 <div class="p-6">

 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

 <div class="md:col-span-2">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Tampilkan / Sembunyikan Section Publik
 </label>

 <div class="form-check mb-2">
 <input
 class="form-check-input"
 type="checkbox"
 name="tampilkan_berita"
 id="tampilkan_berita"
 value="1"
 {{ old('tampilkan_berita', $setting->tampilkan_berita ?? true) ? 'checked' : '' }}>
 <label class="form-check-label" for="tampilkan_berita">
 Berita
 </label>
 </div>

 <div class="form-check mb-2">
 <input
 class="form-check-input"
 type="checkbox"
 name="tampilkan_pengumuman"
 id="tampilkan_pengumuman"
 value="1"
 {{ old('tampilkan_pengumuman', $setting->tampilkan_pengumuman ?? true) ? 'checked' : '' }}>
 <label class="form-check-label" for="tampilkan_pengumuman">
 Pengumuman
 </label>
 </div>

 <div class="form-check mb-2">
 <input
 class="form-check-input"
 type="checkbox"
 name="tampilkan_agenda"
 id="tampilkan_agenda"
 value="1"
 {{ old('tampilkan_agenda', $setting->tampilkan_agenda ?? true) ? 'checked' : '' }}>
 <label class="form-check-label" for="tampilkan_agenda">
 Agenda
 </label>
 </div>

 <div class="form-check mb-2">
 <input
 class="form-check-input"
 type="checkbox"
 name="tampilkan_galeri"
 id="tampilkan_galeri"
 value="1"
 {{ old('tampilkan_galeri', $setting->tampilkan_galeri ?? true) ? 'checked' : '' }}>
 <label class="form-check-label" for="tampilkan_galeri">
 Galeri
 </label>
 </div>

 <div class="form-check">
 <input
 class="form-check-input"
 type="checkbox"
 name="tampilkan_pengaduan"
 id="tampilkan_pengaduan"
 value="1"
 {{ old('tampilkan_pengaduan', $setting->tampilkan_pengaduan ?? true) ? 'checked' : '' }}>
 <label class="form-check-label" for="tampilkan_pengaduan">
 Pengaduan
 </label>
 </div>
 <div class="form-check mb-2">
 <input
 class="form-check-input"
 type="checkbox"
 name="tampilkan_statistik"
 id="tampilkan_statistik"
 value="1"
 {{ old('tampilkan_statistik', $setting->tampilkan_statistik ?? true) ? 'checked' : '' }}>

 <label class="form-check-label" for="tampilkan_statistik">
 Statistik
 </label>
</div>

<div class="form-check mb-2">
 <input
 class="form-check-input"
 type="checkbox"
 name="tampilkan_layanan"
 id="tampilkan_layanan"
 value="1"
 {{ old('tampilkan_layanan', $setting->tampilkan_layanan ?? true) ? 'checked' : '' }}>

 <label class="form-check-label" for="tampilkan_layanan">
 Layanan
 </label>
</div>

 </div>

 <div class="w-full md:w-full px-3 mt-6">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Meta Title
 </label>

 <input
 type="text"
 name="meta_title"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error('meta_title') is-invalid @enderror"
 placeholder="Judul SEO untuk homepage"
 value="{{ old('meta_title', $setting->meta_title ?? '') }}">

 @error('meta_title')
 <div class="invalid-feedback">
 {{ $message }}
 </div>
 @enderror

 </div>

 <div class="w-full md:w-full px-3 mt-3">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Meta Description
 </label>

 <textarea
 name="meta_description"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error('meta_description') is-invalid @enderror"
 rows="3"
 placeholder="Deskripsi SEO untuk homepage">{{ old('meta_description', $setting->meta_description ?? '') }}</textarea>

 @error('meta_description')
 <div class="invalid-feedback">
 {{ $message }}
 </div>
 @enderror

 </div>

 <div class="w-full md:w-full px-3 mt-3">

 <label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Meta Keyword
 </label>

 <input
 type="text"
 name="meta_keyword"
 class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error('meta_keyword') is-invalid @enderror"
 placeholder="Kata kunci SEO, pisahkan dengan koma"
 value="{{ old('meta_keyword', $setting->meta_keyword ?? '') }}">

 @error('meta_keyword')
 <div class="invalid-feedback">
 {{ $message }}
 </div>
 @enderror

 </div>

 </div>

 </div>

</div>

<div class="flex justify-end mb-6">

 <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm px-5 py-3 text-base active:scale-95 cursor-pointer">

 <i class="fa-solid fa-save mr-2"></i>

 Simpan Pengaturan

 </button>

</div>

@endsection