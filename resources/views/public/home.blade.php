@extends('layouts.public')

@section('title', 'Beranda | SIP Bongki')

@section('content')

{{-- =====================================================
    HERO
===================================================== --}}
@include('public.sections.hero')

{{-- =====================================================
    ZONA PROFIL
===================================================== --}}

@include('public.sections.profil')

@include('public.sections.struktur')


{{-- =====================================================
    ZONA PELAYANAN
===================================================== --}}

@if($website->tampilkan_statistik ?? true)
    @include('public.sections.statistics')
@endif

@if($website->tampilkan_layanan ?? true)
    @include('public.sections.workflow')    
    @include('public.sections.services')
    
@endif


{{-- =====================================================
    ZONA INFORMASI
===================================================== --}}

@if($website->tampilkan_pengumuman ?? true)
    @include('public.sections.pengumuman')
@endif

@if($website->tampilkan_agenda ?? true)
    @include('public.sections.agenda')
@endif

@if($website->tampilkan_berita ?? true)
    @include('public.sections.news')
@endif

@if($website->tampilkan_galeri ?? true)
    @include('public.sections.gallery')
@endif




{{-- =====================================================
    ZONA PENUTUP
===================================================== --}}
<section class="home-zone zone-footer">

    @include('public.sections.location')

</section>

@endsection