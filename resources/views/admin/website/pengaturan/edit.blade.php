@extends('layouts.admin')


@section('title', 'Edit Pengaturan Website')


@section('content')


<div class="container-fluid">


    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">


        <div>

            <h3 class="fw-bold mb-1">
                Edit Pengaturan Website
            </h3>


            <p class="text-muted mb-0">
                Perbarui identitas dan informasi website SiPBongki.
            </p>


        </div>




        <a href="{{ route('admin.website.pengaturan.index') }}"
           class="btn btn-secondary">


            <i class="bi bi-arrow-left me-2"></i>

            Kembali


        </a>


    </div>







    <div class="card border-0 shadow-sm">


        <div class="card-body">





            <form action="{{ route('admin.website.pengaturan.update') }}"
                  method="POST"
                  enctype="multipart/form-data">


                @csrf

                @method('PUT')




{{-- =========================================================
    IDENTITAS WEBSITE
========================================================= --}}

<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-primary text-white">

        <h5 class="mb-0">
            <i class="bi bi-building me-2"></i>
            Identitas Website
        </h5>

    </div>

    <div class="card-body">

        <div class="row g-4">

            <div class="col-md-6">

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

            <div class="col-md-6">

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

<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-success text-white">

        <h5 class="mb-0">
            <i class="bi bi-image me-2"></i>
            Logo & Favicon
        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6">

                <label class="form-label fw-semibold">
                    Logo Website
                </label>

@if(!empty($setting->logo))

<div class="mb-3">

    <img
        id="logoPreview"
        src="{{ asset('storage/'.$setting->logo) }}"
        class="img-thumbnail"
        style="max-height:120px">

</div>

@else

<div class="mb-3">

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

            <div class="col-md-6">

                <label class="form-label fw-semibold">
                    Favicon
                </label>

                @if(!empty($setting->favicon))

                    <div class="mb-3">

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

<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-warning">

        <h5 class="mb-0">
            <i class="bi bi-stars me-2"></i>
            Hero Landing Page
        </h5>

    </div>

    <div class="card-body">

        <div class="row g-4">

            {{-- Badge --}}
            <div class="col-md-6">

                <label class="form-label fw-semibold">
                    Badge Hero
                </label>

                <input
                    type="text"
                    name="badge"
                    class="form-control"
                    placeholder="Contoh : Selamat Datang di SiPBongki"
                    value="{{ old('badge',$setting->badge ?? '') }}">

            </div>

            {{-- Judul --}}
            <div class="col-md-6">

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

<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-info text-white">

        <h5 class="mb-0">
            <i class="bi bi-image me-2"></i>
            Gambar Hero
        </h5>

    </div>

    <div class="card-body">

        @if(!empty($setting->gambar_hero))

            <div class="mb-3">

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

        <small class="text-muted">
            Disarankan ukuran 1200 × 900 pixel.
        </small>

    </div>

</div>

{{-- =========================================================
    TOMBOL HERO
========================================================= --}}

<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-secondary text-white">

        <h5 class="mb-0">
            <i class="bi bi-cursor-fill me-2"></i>
            Tombol Hero
        </h5>

    </div>

    <div class="card-body">

        <div class="row g-4">

            <div class="col-md-6">

                <label class="form-label fw-semibold">
                    Teks Tombol Pertama
                </label>

                <input
                    type="text"
                    name="hero_button_1_text"
                    class="form-control"
                    value="{{ old('hero_button_1_text',$setting->hero_button_1_text ?? '') }}">

            </div>

            <div class="col-md-6">

                <label class="form-label fw-semibold">
                    Link Tombol Pertama
                </label>

                <input
                    type="text"
                    name="hero_button_1_link"
                    class="form-control"
                    value="{{ old('hero_button_1_link',$setting->hero_button_1_link ?? '') }}">

            </div>

            <div class="col-md-6">

                <label class="form-label fw-semibold">
                    Teks Tombol Kedua
                </label>

                <input
                    type="text"
                    name="hero_button_2_text"
                    class="form-control"
                    value="{{ old('hero_button_2_text',$setting->hero_button_2_text ?? '') }}">

            </div>

            <div class="col-md-6">

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

<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-success text-white">

        <h5 class="mb-0">
            <i class="bi bi-telephone-fill me-2"></i>
            Kontak Website
        </h5>

    </div>

    <div class="card-body">

        <div class="row g-4">

            {{-- Telepon --}}
            <div class="col-md-6">

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
            <div class="col-md-6">

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
            <div class="col-md-6">

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
            <div class="col-md-6">

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

                <small class="text-muted">
                    Gunakan kode <strong>&lt;iframe&gt;</strong> dari Google Maps (menu Bagikan → Sematkan peta).
                </small>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
    MEDIA SOSIAL
========================================================= --}}

<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-danger text-white">

        <h5 class="mb-0">
            <i class="bi bi-share-fill me-2"></i>
            Media Sosial
        </h5>

    </div>

    <div class="card-body">

        <div class="row g-4">

            {{-- Facebook --}}
            <div class="col-md-6">

                <label class="form-label fw-semibold">
                    <i class="bi bi-facebook text-primary me-1"></i>
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
            <div class="col-md-6">

                <label class="form-label fw-semibold">
                    <i class="bi bi-instagram text-danger me-1"></i>
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
            <div class="col-md-6">

                <label class="form-label fw-semibold">
                    <i class="bi bi-youtube text-danger me-1"></i>
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

<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-dark text-white">

        <h5 class="mb-0">
            <i class="bi bi-layout-text-sidebar-reverse me-2"></i>
            Footer Website
        </h5>

    </div>

    <div class="card-body">

        <div class="row g-4">

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

<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-primary text-white">

        <h5 class="mb-0">
            <i class="bi bi-search me-2"></i>
            SEO Website
        </h5>

    </div>

    <div class="card-body">

        <div class="row g-4">

            <div class="col-md-12">

                <label class="form-label fw-semibold">
                    Meta Title
                </label>

                <input
                    type="text"
                    name="meta_title"
                    class="form-control"
                    value="{{ old('meta_title',$setting->meta_title ?? '') }}">

            </div>

            <div class="col-md-12">

                <label class="form-label fw-semibold">
                    Meta Description
                </label>

                <textarea
                    name="meta_description"
                    rows="4"
                    class="form-control">{{ old('meta_description',$setting->meta_description ?? '') }}</textarea>

            </div>

            <div class="col-md-12">

                <label class="form-label fw-semibold">
                    Meta Keyword
                </label>

                <input
                    type="text"
                    name="meta_keyword"
                    class="form-control"
                    placeholder="kelurahan bongki, pelayanan, sipbongki"
                    value="{{ old('meta_keyword',$setting->meta_keyword ?? '') }}">

            </div>

        </div>

    </div>

</div>

<div class="d-flex justify-content-end mb-4">

    <button type="submit" class="btn btn-primary btn-lg">

        <i class="bi bi-save me-2"></i>

        Simpan Pengaturan

    </button>

</div>

@endsection