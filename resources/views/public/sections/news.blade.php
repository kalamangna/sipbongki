{{-- ═══════════════════════════════════════════════
    NEWS SECTION — Tailwind CSS
═══════════════════════════════════════════════ --}}
<section id="berita" class="py-24 bg-slate-50 dark:bg-slate-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-14">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase bg-primary-light text-primary dark:bg-primary-950/60 dark:text-primary-300 mb-4">Berita</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 dark:text-slate-100 mb-4">Berita Terkini</h2>
        </div>

        {{-- Cards --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($beritas as $berita)

                <a href="{{ route('berita.show', $berita->slug) }}"
                   class="group flex flex-col bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-md hover:-translate-y-0.5 dark:bg-slate-900 dark:border-slate-800 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">

                    {{-- Image --}}
                    <div class="relative overflow-hidden aspect-[16/10] bg-slate-100 dark:bg-slate-800">
                        <img src="{{ $berita->gambar ? asset('storage/'.$berita->gambar) : asset('images/kantor.png') }}"
                             alt="{{ $berita->judul }}"
                             loading="lazy"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                        {{-- Date badge --}}
                        <div class="absolute top-3 left-3 bg-primary text-white rounded-xl px-3 py-1.5 text-center shadow-md leading-tight">
                            <div class="text-base font-bold leading-none">
                                {{ optional($berita->tanggal_publish)->format('d') ?? $berita->created_at->format('d') }}
                            </div>
                            <div class="text-[10px] font-semibold uppercase tracking-wider mt-0.5">
                                {{ optional($berita->tanggal_publish)->format('M') ?? $berita->created_at->format('M') }}
                            </div>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="flex flex-col flex-1 p-5">
                        <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 mb-2 line-clamp-2 group-hover:text-primary dark:group-hover:text-primary-400 transition-colors">
                            {{ $berita->judul }}
                        </h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed flex-1 line-clamp-3">
                            {{ Str::limit(strip_tags($berita->isi), 140) }}
                        </p>
                        <span class="inline-flex items-center gap-1.5 mt-4 text-sm font-semibold text-primary dark:text-primary-400 group-hover:gap-2.5 transition-all duration-200">
                            Baca Selengkapnya
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </span>
                    </div>

                </a>

            @empty

                <div class="sm:col-span-2 lg:col-span-3 py-16 text-center text-slate-400">
                    <div class="w-16 h-16 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center mx-auto mb-3 text-slate-400 dark:text-slate-500 text-2xl">
                        <i class="fa-solid fa-newspaper"></i>
                    </div>
                    <h4 class="text-base font-semibold text-slate-700 dark:text-slate-200 mb-1">Belum Ada Berita</h4>
                    <p class="text-sm text-slate-500 dark:text-slate-400 max-w-sm mx-auto">Berita akan muncul setelah dipublikasikan melalui Dashboard Admin.</p>
                </div>

            @endforelse

        </div>

    </div>
</section>