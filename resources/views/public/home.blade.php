@extends('layouts.public')

@section('title', 'Beranda | SiPBongki')

@section('content')

{{-- HERO --}}
@include('public.sections.hero')

{{-- STATISTIK --}}
@include('public.sections.statistics')

{{-- LAYANAN ADMINISTRASI --}}
@include('public.sections.services')

{{-- ALUR PELAYANAN --}}
@include('public.sections.workflow')

{{-- PENGUMUMAN RESMI --}}
@include('public.sections.pengumuman')

{{-- AGENDA --}}
@include('public.sections.agenda')

{{-- BERITA --}}
@include('public.sections.news')

{{-- PROFIL KELURAHAN --}}
@include('public.sections.profil')

{{-- STRUKTUR ORGANISASI --}}
@include('public.sections.struktur')

{{-- GALERI FOTO --}}
@include('public.sections.gallery')

{{-- LOKASI & KONTAK --}}
@include('public.sections.location')

@endsection