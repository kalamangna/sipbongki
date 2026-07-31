@extends('layouts.public')


@section('title', 'Beranda | SiPBongki')



@section('content')



{{-- =====================================================
    HERO
===================================================== --}}

@include('public.sections.hero')





{{-- =====================================================
    STATISTIK KELURAHAN
===================================================== --}}

@include('public.sections.statistics')





{{-- =====================================================
    LAYANAN PUBLIK
===================================================== --}}

@include('public.sections.services')





{{-- =====================================================
    ALUR PELAYANAN
===================================================== --}}

@include('public.sections.workflow')





{{-- =====================================================
    PROFIL KELURAHAN
    Data dari CMS Halaman
===================================================== --}}

@include('public.sections.profil')





{{-- =====================================================
    STRUKTUR ORGANISASI
    Data dari Master Perangkat
===================================================== --}}

@include('public.sections.struktur')



{{-- =====================================================
    PENGUMUMAN TERBARU
    Data dari CMS Pengumuman
===================================================== --}}

@include('public.sections.pengumuman')


{{-- =====================================================
    BERITA TERBARU
    Data dari CMS Berita
===================================================== --}}

@include('public.sections.news')





{{-- =====================================================
    AGENDA KEGIATAN
    Data dari CMS Agenda
===================================================== --}}

@include('public.sections.agenda')





{{-- =====================================================
    GALERI KEGIATAN
    Data dari CMS Galeri
===================================================== --}}

@include('public.sections.gallery')





{{-- =====================================================
    CALL TO ACTION
===================================================== --}}

@include('public.sections.cta')





{{-- =====================================================
    LOKASI & KONTAK
===================================================== --}}

@include('public.sections.location')



@endsection