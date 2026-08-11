{{-- ═══════════════════════════════════════════════
    AGENDA SECTION — Tailwind CSS
═══════════════════════════════════════════════ --}}
<section id="agenda" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-14">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase bg-primary-light text-primary mb-4">Agenda</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Agenda Kegiatan</h2>
        </div>

        {{-- Cards --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($agendas as $agenda)

                <div class="flex gap-4 bg-slate-50 border border-slate-100 rounded-2xl p-5 shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">

                    {{-- Date box --}}
                    <div class="flex-shrink-0 w-14 h-16 rounded-xl bg-primary flex flex-col items-center justify-center text-white shadow-md">
                        <span class="text-xl font-extrabold leading-none">
                            {{ $agenda->tanggal ? $agenda->tanggal->format('d') : '-' }}
                        </span>
                        <span class="text-[10px] uppercase tracking-wider mt-0.5">
                            {{ $agenda->tanggal ? $agenda->tanggal->format('M') : '' }}
                        </span>
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0">
                        <h3 class="text-sm font-bold text-slate-800 mb-2 line-clamp-2">
                            {{ $agenda->judul }}
                        </h3>
                        <div class="flex flex-col gap-1">
                            <span class="inline-flex items-center gap-1.5 text-xs text-slate-500">
                                <i class="fa-solid fa-map"></i>
                                {{ $agenda->lokasi ?? 'Lokasi belum ditentukan' }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 text-xs text-slate-500">
                                <i class="fa-solid fa-clock"></i>
                                {{ $agenda->waktu ?? '-' }} WITA
                            </span>
                        </div>
                    </div>

                </div>

            @empty

                <div class="sm:col-span-2 lg:col-span-3 py-16 text-center text-slate-400">
                    <i class="fa-regular fa-calendar"></i>
                    <h5 class="text-lg font-semibold text-slate-600 mb-1">Belum Ada Agenda</h5>
                    <p class="text-sm">Agenda kegiatan akan muncul setelah ditambahkan.</p>
                </div>

            @endforelse

        </div>

    </div>
</section>