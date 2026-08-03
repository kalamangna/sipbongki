@extends('layouts.public')

@section('title', 'Beranda | SiPBongki')

@section('content')

{{-- =====================================================
    HERO
===================================================== --}}
@include('public.sections.hero')


{{-- =====================================================
    ZONA PELAYANAN
===================================================== --}}
<section class="home-zone zone-primary">

    @include('public.sections.statistics')

    @include('public.sections.services')

    @include('public.sections.workflow')

</section>


{{-- =====================================================
    ZONA INFORMASI
===================================================== --}}


    @include('public.sections.pengumuman')

    @include('public.sections.agenda')

    @include('public.sections.news')

</section>


{{-- =====================================================
    ZONA PROFIL
===================================================== --}}


    @include('public.sections.profil')

    @include('public.sections.struktur')

</section>


{{-- =====================================================
    ZONA DOKUMENTASI
===================================================== --}}

    @include('public.sections.gallery')

</section>


{{-- =====================================================
    ZONA PENUTUP
===================================================== --}}
<section class="home-zone zone-footer">

    @include('public.sections.location')

</section>

@endsection