<section id="struktur-organisasi" class="struktur-organisasi">

    <div class="container">

        @php
            $halaman = $halamanProfil['struktur-organisasi'] ?? null;
        @endphp

        {{-- HEADER --}}
        <div class="section-title text-center mb-5">

            <span class="section-badge">
                Pemerintah Kelurahan Bongki
            </span>

            <p class="section-subtitle">
                Susunan organisasi Pemerintah Kelurahan Bongki beserta perangkat kelurahan yang bertugas memberikan pelayanan kepada masyarakat.
            </p>

            @if($halaman?->ringkasan)
                <p>{{ $halaman->ringkasan }}</p>
            @endif

        </div>

        {{-- TREE ORGANISASI --}}
        <div class="org-tree">

            @foreach($struktur as $jabatanRoot)

                @php
                    $lurah = $jabatanRoot->perangkatStruktur;

                    $sekretaris = $jabatanRoot->children
    ->whereIn('slug', [
        'sekretaris',
        'sekretaris-lurah'
    ])
    ->first();

                    $kepalaLingkungan = $jabatanRoot->children
                        ->filter(fn ($item) => str_starts_with($item->slug, 'kepala-lingkungan'));
                @endphp

                <div class="org-tree-container">

                    {{-- =========================
                        LURAH
                    ========================== --}}
                    <div class="org-lurah">

                        @foreach($lurah as $perangkat)

                            <x-public.person-card
                                :perangkat="$perangkat"
                            />

                        @endforeach

                    </div>

                    <div class="org-connector"></div>

                    {{-- =========================
                        CABANG LURAH
                    ========================== --}}
                    <div class="org-main">

                        {{-- =========================
                            KEPALA LINGKUNGAN
                        ========================== --}}
                        <div class="org-kepling">

                            @foreach($kepalaLingkungan as $lingkungan)

                                @foreach($lingkungan->perangkatStruktur as $perangkat)

                                    <div class="kepling-card">

                                        <x-public.person-card
                                            :perangkat="$perangkat"
                                        />

                                    </div>

                                @endforeach

                            @endforeach

                        </div>

                        {{-- =========================
                            SEKRETARIS
                        ========================== --}}
                        <div class="org-center">

                            <div class="org-sekretaris">

                                @if($sekretaris)

                                    @foreach($sekretaris->perangkatStruktur as $perangkat)

                                        <x-public.person-card
                                            :perangkat="$perangkat"
                                        />

                                    @endforeach

                                @endif

                            </div>

                            <div class="org-connector"></div>

                            {{-- =========================
                                KASI
                            ========================== --}}
                            <div class="org-kasi-wrapper">

                                @if($sekretaris)

                                    @foreach($sekretaris->children as $kasi)

                                        <div class="org-kasi-column">

                                            {{-- CARD KASI --}}
                                            @foreach($kasi->perangkatStruktur as $perangkat)

                                                <div class="kasi-card">

                                                    <x-public.person-card
                                                        :perangkat="$perangkat"
                                                    />

                                                </div>

                                            @endforeach

                                            {{-- STAFF --}}
                                            @if($kasi->children->isNotEmpty())

                                                <div class="org-staff">

                                                    @foreach($kasi->children as $staf)

                                                        @foreach($staf->perangkatStruktur as $pegawai)

                                                            <div class="staff-card">

                                                                <x-public.person-card
                                                                    :perangkat="$pegawai"
                                                                />

                                                            </div>

                                                        @endforeach

                                                    @endforeach

                                                </div>

                                            @endif

                                        </div>

                                    @endforeach

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>