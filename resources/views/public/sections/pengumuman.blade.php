{{-- ═══════════════════════════════════════════════
    PENGUMUMAN SECTION — Tailwind CSS
═══════════════════════════════════════════════ --}}
<section id="pengumuman" class="py-24 bg-slate-50 dark:bg-slate-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-14">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase bg-primary-light text-primary dark:bg-primary-950/60 dark:text-primary-300 mb-4">Pengumuman</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 dark:text-slate-100 mb-4">Pengumuman Resmi</h2>
        </div>

        {{-- Cards --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($pengumumen as $pengumuman)

                <a href="{{ route('pengumuman.detail', $pengumuman->slug) }}"
                   class="group flex flex-col bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md hover:-translate-y-0.5 dark:bg-slate-900 dark:border-slate-800 transition-all duration-300 relative overflow-hidden focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">

                    {{-- Accent bar --}}
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-primary rounded-l-2xl"></div>

                    {{-- Date --}}
                    <span class="inline-flex items-center gap-1.5 text-xs text-slate-400 dark:text-slate-500 font-medium mb-3 ml-2">
                        <i class="fa-solid fa-calendar-days text-primary dark:text-primary-400"></i>
                        {{ $pengumuman->tanggal_publish?->translatedFormat('d F Y') ?? '-' }}
                    </span>

                    {{-- Title --}}
                    <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 mb-2 line-clamp-2 group-hover:text-primary dark:group-hover:text-primary-400 transition-colors ml-2">
                        {{ $pengumuman->judul }}
                    </h3>

                    {{-- Excerpt --}}
                    <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed flex-1 line-clamp-3 ml-2">
                        {{ \Illuminate\Support\Str::limit(strip_tags($pengumuman->isi), 120) }}
                    </p>

                    <span class="inline-flex items-center gap-1.5 mt-4 ml-2 text-sm font-semibold text-primary dark:text-primary-400 group-hover:gap-2.5 transition-all duration-200">
                        Baca Selengkapnya
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </span>

                </a>

            @empty

                <div class="sm:col-span-2 lg:col-span-3 py-16 text-center text-slate-400">
                    <div class="w-16 h-16 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center mx-auto mb-3 text-slate-400 dark:text-slate-500 text-2xl">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <h4 class="text-base font-semibold text-slate-700 dark:text-slate-200 mb-1">Belum Ada Pengumuman</h4>
                    <p class="text-sm text-slate-500 dark:text-slate-400 max-w-sm mx-auto">Pengumuman resmi akan ditampilkan setelah dipublikasikan oleh pihak kelurahan.</p>
                </div>

            @endforelse

        </div>

    </div>
</section>