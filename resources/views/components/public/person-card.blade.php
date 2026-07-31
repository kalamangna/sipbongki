@props([
    'perangkat'
])

@php

    $nama = $perangkat->nama_lengkap ?? '-';

    /*
    |--------------------------------------------------------------------------
    | Jabatan Struktur Website
    |--------------------------------------------------------------------------
    */

    $jabatan = $perangkat->jabatanStruktur->nama ?? '-';


    $nip = $perangkat->nip ?? null;


    /*
    |--------------------------------------------------------------------------
    | FOTO PEJABAT
    |--------------------------------------------------------------------------
    */

    if($perangkat->foto){

        $foto = asset('storage/'.$perangkat->foto);

    }else{

        $foto = asset('images/default-user.png');

    }

@endphp


<div class="person-card">


    <div class="person-photo-wrapper">

        <img
            src="{{ $foto }}"
            alt="{{ $nama }}"
            class="person-photo">

    </div>



    <div class="person-info">


        <h3 class="person-name">

            {{ $nama }}

        </h3>



        @if($nip)

            <div class="person-nip">

                NIP. {{ $nip }}

            </div>

        @endif



        <div class="person-position">

            {{ $jabatan }}

        </div>


    </div>


</div>