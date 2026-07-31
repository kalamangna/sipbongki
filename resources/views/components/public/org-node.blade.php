@props([
    'jabatan'
])


<div class="org-node">


    {{-- PEJABAT PADA JABATAN INI --}}

    @foreach($jabatan->perangkatStruktur as $perangkat)

        <x-public.person-card
            :perangkat="$perangkat"
        />

    @endforeach



    {{-- ANAK JABATAN --}}

    @if($jabatan->children->count())


        <div class="org-children">


            @foreach($jabatan->children as $child)


                <x-public.org-node
                    :jabatan="$child"
                />


            @endforeach


        </div>


    @endif


</div>