@props(['perangkat'])

@php
    $nama    = $perangkat->nama_lengkap ?? '-';
    $jabatan = $perangkat->jabatanStruktur->nama ?? '-';
    $nip     = $perangkat->nip ?? null;
    $foto    = $perangkat->foto
                ? asset('storage/'.$perangkat->foto)
                : asset('images/default-user.png');
@endphp

<div class="flex flex-col items-center text-center w-48 sm:w-56 h-full">

    <div class="w-32 sm:w-40 aspect-[3/4] rounded-2xl overflow-hidden border-4 border-white shadow-md bg-slate-100 mb-4 ring-1 ring-slate-200 shrink-0 dark:border-slate-800 dark:bg-slate-800 dark:ring-slate-700">
        <img src="{{ $foto }}"
             alt="{{ $nama }}"
             class="w-full h-full object-cover transition-transform hover:scale-105 duration-500">
    </div>

    <p class="text-base sm:text-lg font-bold text-slate-800 leading-snug px-2 flex-1 dark:text-slate-100">{{ $nama }}</p>

    @if($nip)
        <p class="text-xs sm:text-sm text-slate-500 mt-1.5 whitespace-nowrap dark:text-slate-400">NIP. {{ $nip }}</p>
    @endif

    <span class="mt-3 inline-block px-4 py-1.5 rounded-full bg-primary-light text-primary text-xs sm:text-sm font-semibold leading-tight text-center shadow-sm dark:bg-primary-950/60 dark:text-primary-300">
        {{ $jabatan }}
    </span>

</div>