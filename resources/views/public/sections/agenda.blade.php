<section id="agenda" class="py-20 bg-white">
    <div class="container mx-auto px-4 max-w-7xl">

        {{-- JUDUL SECTION --}}
        <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
            <span class="inline-block px-3.5 py-1.5 rounded-full bg-indigo-100 text-indigo-900 font-bold text-xs tracking-wider uppercase">
                Jadwal Kegiatan
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                Agenda Kelurahan
            </h2>
            <p class="text-slate-600 text-sm sm:text-base">
                Jadwal agenda acara dan kegiatan mendatang di wilayah Kelurahan Bongki.
            </p>
        </div>

        {{-- DAFTAR AGENDA --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($agendas ?? [] as $agenda)
                <div class="bg-slate-50 rounded-3xl p-6 border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 flex items-start gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-indigo-600 text-white flex flex-col items-center justify-center shrink-0 shadow-md shadow-indigo-600/20">
                        <span class="text-lg font-black leading-none">{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d') }}</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider mt-1">{{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('M') }}</span>
                    </div>

                    <div class="space-y-2 flex-1">
                        <h4 class="font-bold text-base text-slate-900 leading-snug">
                            {{ $agenda->judul }}
                        </h4>
                        <p class="text-xs text-slate-500 line-clamp-2">
                            {{ $agenda->deskripsi ?? 'Tidak ada deskripsi agenda.' }}
                        </p>

                        <div class="pt-2 flex flex-wrap items-center gap-3 text-[11px] font-medium text-slate-400">
                            <span class="flex items-center gap-1">
                                <i class="fa-solid fa-location-dot text-indigo-600"></i>
                                {{ $agenda->lokasi ?? 'Kantor Kelurahan' }}
                            </span>
                            <span class="flex items-center gap-1">
                                <i class="fa-regular fa-clock text-indigo-600"></i>
                                {{ $agenda->waktu ?? 'Selesai' }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center bg-slate-50 rounded-3xl border border-slate-100 shadow-sm space-y-3">
                    <i class="fa-solid fa-calendar-xmark text-4xl text-slate-300"></i>
                    <p class="text-slate-500 text-sm font-medium">Belum ada agenda kegiatan mendatang.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>