@extends('layouts.admin')


@section('title', 'Edit Pengaturan Website')


@section('content')


<div class="container-fluid">


    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">


        <div>

           


            <p class="text-slate-500 mb-0">
                Perbarui identitas dan informasi website SIP Bongki.
            </p>


        </div>




        <a href="{{ route('admin.website.pengaturan.index') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary">


            <i class="bi bi-arrow-left mr-2"></i>

            Kembali


        </a>


    </div>







    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">


        <div class="p-6">





            <form action="{{ route('admin.website.pengaturan.update') }}"
                  method="POST"
                  enctype="multipart/form-data">


                @csrf

                @method('PUT')




{{-- =========================================================
    IDENTITAS WEBSITE
========================================================= --}}

<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

    <div class="px-6 py-4 border-b border-slate-200 bg-primary-100 text-primary-700 text-white">

        <h5 class="mb-0">
            <i class="bi bi-building mr-2"></i>
            Identitas Website
        </h5>

    </div>

    <div class="p-6">

        <div class="flex flex-wrap -mx-3">

            <div class="w-full md:w-1/2 px-3">

                <label class="form-label fw-semibold">
                    Nama Website
                </label>

                <input
                    type="text"
                    name="nama_website"
                    class="form-control @error('nama_website') is-invalid @enderror"
                    value="{{ old('nama_website', $setting->nama_website ?? '') }}">

                @error('nama_website')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="w-full md:w-1/2 px-3">

                <label class="form-label fw-semibold">
                    Nama Kelurahan
                </label>

                <input
                    type="text"
                    name="nama_kelurahan"
                    class="form-control @error('nama_kelurahan') is-invalid @enderror"
                    value="{{ old('nama_kelurahan', $setting->nama_kelurahan ?? '') }}">

            </div>

            <div class="col-md-12">

                <label class="form-label fw-semibold">
                    Deskripsi Website
                </label>

                <textarea
                    name="deskripsi"
                    rows="4"
                    class="form-control">{{ old('deskripsi', $setting->deskripsi ?? '') }}</textarea>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
    LOGO & FAVICON
========================================================= --}}

<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

    <div class="px-6 py-4 border-b border-slate-200 bg-emerald-100 text-emerald-700 text-white">

        <h5 class="mb-0">
            <i class="bi bi-image mr-2"></i>
            Logo & Favicon
        </h5>

    </div>

    <div class="p-6">

        <div class="flex flex-wrap -mx-3">

            <div class="w-full md:w-1/2 px-3">

                <label class="form-label fw-semibold">
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
        class="img-thumbnail d-none"
        style="max-height:120px">

</div>

@endif                

                <input
    type="file"
    id="logo"
    name="logo"
    class="form-control"
    accept="image/*">

            </div>

            <div class="w-full md:w-1/2 px-3">

                <label class="form-label fw-semibold">
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
                    class="form-control"
                    accept="image/*">

            </div>

        </div>

    </div>

</div>

{{-- =========================================================
    HERO LANDING PAGE
========================================================= --}}

<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

    <div class="px-6 py-4 border-b border-slate-200 bg-amber-100 text-amber-700">

        <h5 class="mb-0">
            <i class="bi bi-stars mr-2"></i>
            Hero Landing Page
        </h5>

    </div>

    <div class="p-6">

        <div class="flex flex-wrap -mx-3">

            {{-- Badge --}}
            <div class="w-full md:w-1/2 px-3">

                <label class="form-label fw-semibold">
                    Badge Hero
                </label>

                <input
                    type="text"
                    name="badge"
                    class="form-control"
                    placeholder="Contoh : Selamat Datang di SIP Bongki"
                    value="{{ old('badge',$setting->badge ?? '') }}">

            </div>

            {{-- Judul --}}
            <div class="w-full md:w-1/2 px-3">

                <label class="form-label fw-semibold">
                    Judul Hero
                </label>

                <input
                    type="text"
                    name="judul_hero"
                    class="form-control"
                    placeholder="Sistem Informasi &"
                    value="{{ old('judul_hero',$setting->judul_hero ?? '') }}">

            </div>

            {{-- Sub Judul --}}
            <div class="col-md-12">

                <label class="form-label fw-semibold">
                    Sub Judul Hero
                </label>

                <input
                    type="text"
                    name="subjudul_hero"
                    class="form-control"
                    placeholder="Pelayanan Kelurahan Bongki"
                    value="{{ old('subjudul_hero',$setting->subjudul_hero ?? '') }}">

            </div>

            {{-- Deskripsi --}}
            <div class="col-md-12">

                <label class="form-label fw-semibold">
                    Deskripsi Hero
                </label>

                <textarea
                    name="deskripsi_hero"
                    rows="5"
                    class="form-control">{{ old('deskripsi_hero',$setting->deskripsi_hero ?? '') }}</textarea>

            </div>

        </div>

    </div>

</div>

{{-- =========================================================
    GAMBAR HERO
========================================================= --}}

<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

    <div class="px-6 py-4 border-b border-slate-200 bg-sky-100 text-sky-700 text-white">

        <h5 class="mb-0">
            <i class="bi bi-image mr-2"></i>
            Gambar Hero
        </h5>

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
            class="form-control"
            accept="image/*">

        <small class="text-slate-500">
            Disarankan ukuran 1200 × 900 pixel.
        </small>

    </div>

</div>

{{-- =========================================================
    TOMBOL HERO
========================================================= --}}

<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

    <div class="px-6 py-4 border-b border-slate-200 bg-slate-100 text-slate-700 text-white">

        <h5 class="mb-0">
            <i class="bi bi-cursor-fill mr-2"></i>
            Tombol Hero
        </h5>

    </div>

    <div class="p-6">

        <div class="flex flex-wrap -mx-3">

            <div class="w-full md:w-1/2 px-3">

                <label class="form-label fw-semibold">
                    Teks Tombol Pertama
                </label>

                <input
                    type="text"
                    name="hero_button_1_text"
                    class="form-control"
                    value="{{ old('hero_button_1_text',$setting->hero_button_1_text ?? '') }}">

            </div>

            <div class="w-full md:w-1/2 px-3">

                <label class="form-label fw-semibold">
                    Link Tombol Pertama
                </label>

                <input
                    type="text"
                    name="hero_button_1_link"
                    class="form-control"
                    value="{{ old('hero_button_1_link',$setting->hero_button_1_link ?? '') }}">

            </div>

            <div class="w-full md:w-1/2 px-3">

                <label class="form-label fw-semibold">
                    Teks Tombol Kedua
                </label>

                <input
                    type="text"
                    name="hero_button_2_text"
                    class="form-control"
                    value="{{ old('hero_button_2_text',$setting->hero_button_2_text ?? '') }}">

            </div>

            <div class="w-full md:w-1/2 px-3">

                <label class="form-label fw-semibold">
                    Link Tombol Kedua
                </label>

                <input
                    type="text"
                    name="hero_button_2_link"
                    class="form-control"
                    value="{{ old('hero_button_2_link',$setting->hero_button_2_link ?? '') }}">

            </div>

        </div>

    </div>

</div>

{{-- =========================================================
    KONTAK WEBSITE
========================================================= --}}

<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

    <div class="px-6 py-4 border-b border-slate-200 bg-emerald-100 text-emerald-700 text-white">

        <h5 class="mb-0">
            <i class="bi bi-telephone-fill mr-2"></i>
            Kontak Website
        </h5>

    </div>

    <div class="p-6">

        <div class="flex flex-wrap -mx-3">

            {{-- Telepon --}}
            <div class="w-full md:w-1/2 px-3">

                <label class="form-label fw-semibold">
                    Telepon
                </label>

                <input
                    type="text"
                    name="telepon"
                    class="form-control"
                    value="{{ old('telepon', $setting->telepon ?? '') }}">

            </div>

            {{-- WhatsApp --}}
            <div class="w-full md:w-1/2 px-3">

                <label class="form-label fw-semibold">
                    WhatsApp
                </label>

                <input
                    type="text"
                    name="whatsapp"
                    class="form-control"
                    placeholder="628xxxxxxxxxx"
                    value="{{ old('whatsapp', $setting->whatsapp ?? '') }}">

            </div>

            {{-- Email --}}
            <div class="w-full md:w-1/2 px-3">

                <label class="form-label fw-semibold">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email', $setting->email ?? '') }}">

            </div>

            {{-- Jam Pelayanan --}}
            <div class="w-full md:w-1/2 px-3">

                <label class="form-label fw-semibold">
                    Jam Pelayanan
                </label>

                <input
                    type="text"
                    name="jam_pelayanan"
                    class="form-control"
                    placeholder="Senin - Jumat, 08.00 - 16.00 WITA"
                    value="{{ old('jam_pelayanan', $setting->jam_pelayanan ?? '') }}">

            </div>

            {{-- Alamat --}}
            <div class="col-md-12">

                <label class="form-label fw-semibold">
                    Alamat Lengkap
                </label>

                <textarea
                    name="alamat"
                    rows="3"
                    class="form-control">{{ old('alamat', $setting->alamat ?? '') }}</textarea>

            </div>

            {{-- Google Maps --}}
            <div class="col-md-12">

                <label class="form-label fw-semibold">
                    Embed Google Maps
                </label>

                <textarea
                    name="google_maps"
                    rows="5"
                    class="form-control"
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

<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

    <div class="px-6 py-4 border-b border-slate-200 bg-rose-100 text-rose-700 text-white">

        <h5 class="mb-0">
            <i class="bi bi-share-fill mr-2"></i>
            Media Sosial
        </h5>

    </div>

    <div class="p-6">

        <div class="flex flex-wrap -mx-3">

            {{-- Facebook --}}
            <div class="w-full md:w-1/2 px-3">

                <label class="form-label fw-semibold">
                    <i class="bi bi-facebook text-primary mr-1"></i>
                    Facebook
                </label>

                <input
                    type="url"
                    name="facebook"
                    class="form-control"
                    placeholder="https://facebook.com/..."
                    value="{{ old('facebook',$setting->facebook ?? '') }}">

            </div>

            {{-- Instagram --}}
            <div class="w-full md:w-1/2 px-3">

                <label class="form-label fw-semibold">
                    <i class="bi bi-instagram text-danger mr-1"></i>
                    Instagram
                </label>

                <input
                    type="url"
                    name="instagram"
                    class="form-control"
                    placeholder="https://instagram.com/..."
                    value="{{ old('instagram',$setting->instagram ?? '') }}">

            </div>

            {{-- Youtube --}}
            <div class="w-full md:w-1/2 px-3">

                <label class="form-label fw-semibold">
                    <i class="bi bi-youtube text-danger mr-1"></i>
                    YouTube
                </label>

                <input
                    type="url"
                    name="youtube"
                    class="form-control"
                    placeholder="https://youtube.com/..."
                    value="{{ old('youtube',$setting->youtube ?? '') }}">

            </div>

        </div>

    </div>

</div>

{{-- =========================================================
    FOOTER WEBSITE
========================================================= --}}

<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

    <div class="px-6 py-4 border-b border-slate-200 bg-dark text-white">

        <h5 class="mb-0">
            <i class="bi bi-layout-text-sidebar-reverse mr-2"></i>
            Footer Website
        </h5>

    </div>

    <div class="p-6">

        <div class="flex flex-wrap -mx-3">

            <div class="col-md-12">

                <label class="form-label fw-semibold">
                    Footer Text
                </label>

                <textarea
                    name="footer_text"
                    rows="4"
                    class="form-control">{{ old('footer_text',$setting->footer_text ?? '') }}</textarea>

            </div>

            <div class="col-md-12">

                <label class="form-label fw-semibold">
                    Copyright
                </label>

                <input
                    type="text"
                    name="copyright"
                    class="form-control"
                    placeholder="© 2026 Kelurahan Bongki"
                    value="{{ old('copyright',$setting->copyright ?? '') }}">

            </div>

        </div>

    </div>

</div>

{{-- =========================================================
    SEO WEBSITE
========================================================= --}}

<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

    <div class="px-6 py-4 border-b border-slate-200 bg-primary-100 text-primary-700 text-white">

        <h5 class="mb-0">
            <i class="bi bi-search mr-2"></i>
            SEO Website
        </h5>

    </div>

    <div class="p-6">

        <div class="flex flex-wrap -mx-3">

            <div class="col-md-12">

                <label class="form-label fw-semibold">
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

            <div class="col-md-12 mt-6">

                <label class="form-label fw-semibold">
                    Meta Title
                </label>

                <input
                    type="text"
                    name="meta_title"
                    class="form-control @error('meta_title') is-invalid @enderror"
                    placeholder="Judul SEO untuk homepage"
                    value="{{ old('meta_title', $setting->meta_title ?? '') }}">

                @error('meta_title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="col-md-12 mt-3">

                <label class="form-label fw-semibold">
                    Meta Description
                </label>

                <textarea
                    name="meta_description"
                    class="form-control @error('meta_description') is-invalid @enderror"
                    rows="3"
                    placeholder="Deskripsi SEO untuk homepage">{{ old('meta_description', $setting->meta_description ?? '') }}</textarea>

                @error('meta_description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="col-md-12 mt-3">

                <label class="form-label fw-semibold">
                    Meta Keyword
                </label>

                <input
                    type="text"
                    name="meta_keyword"
                    class="form-control @error('meta_keyword') is-invalid @enderror"
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

    <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm btn-lg">

        <i class="bi bi-save mr-2"></i>

        Simpan Pengaturan

    </button>

</div>

@endsection