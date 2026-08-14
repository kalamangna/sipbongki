{{-- ═══════════════════════════════════════════════
    LOCATION SECTION — Tailwind CSS
═══════════════════════════════════════════════ --}}
<section id="kontak" class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-14">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase bg-primary-light text-primary mb-4">Lokasi & Kontak</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Temukan Kami</h2>
        </div>

        <div class="grid lg:grid-cols-5 gap-8 items-stretch">

            {{-- ── CONTACT INFO ──────────────────────────── --}}
            <div class="lg:col-span-2 flex flex-col gap-4">

                @php
                    $contacts = [
                        ['icon' => 'fa-solid fa-map-pin', 'label' => 'Alamat', 'value' => ($website?->alamat ?? 'Kelurahan Bongki') . ', Kecamatan Sinjai Utara, Kabupaten Sinjai'],
                        ['icon' => 'fa-solid fa-phone', 'label' => 'Telepon', 'value' => $website?->telepon ?? '-'],
                        ['icon' => 'fa-solid fa-envelope', 'label' => 'Email', 'value' => $website?->email ?? '-'],
                        ['icon' => 'fa-solid fa-clock', 'label' => 'Jam Pelayanan', 'value' => $website?->jam_pelayanan ?? 'Senin – Jumat, 08.00 – 16.00 WITA'],
                    ];
                @endphp

                @foreach($contacts as $contact)
                    <div class="flex items-start gap-4 bg-white border border-slate-200 rounded-2xl p-4 shadow-sm">
                        <div class="w-10 h-10 rounded-xl bg-primary-light flex items-center justify-center flex-shrink-0">
                            <i class="{{ $contact['icon'] }} w-5 h-5 text-primary"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-0.5">{{ $contact['label'] }}</p>
                            <p class="text-sm text-slate-700 font-medium">{{ $contact['value'] }}</p>
                        </div>
                    </div>
                @endforeach

                <a href="https://www.google.com/maps/search/?api=1&query=-5.123390,120.253400"
                   target="_blank"
                   class="flex items-center justify-center gap-2 w-full py-3.5 rounded-2xl bg-primary hover:bg-primary-dark text-white font-semibold text-sm shadow-md shadow-primary/20 hover:shadow-lg transition-all duration-200 hover:-translate-y-0.5 active:scale-95 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 mt-2">
                    <i class="fa-solid fa-map-location-dot"></i>
                    Buka di Google Maps
                </a>

            </div>

            {{-- ── MAP ──────────────────────────────────── --}}
            <div class="lg:col-span-3 rounded-2xl overflow-hidden shadow-sm border border-slate-200 min-h-[400px]">
                <iframe src="{{ $website?->google_maps }}"
                        width="100%"
                        height="100%"
                        style="border:0; min-height:400px;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="strict-origin-when-cross-origin">
                </iframe>
            </div>

        </div>
    </div>
</section>