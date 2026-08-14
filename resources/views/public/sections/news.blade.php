{{-- ═══════════════════════════════════════════════
    NEWS SECTION — Tailwind CSS
═══════════════════════════════════════════════ --}}
<section id="berita" class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-14">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase bg-primary-light text-primary mb-4">Berita</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Berita Terkini</h2>
        </div>

        {{-- Cards --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($beritas as $berita)

                <article class="group flex flex-col bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">

                    {{-- Image --}}
                    <div class="relative overflow-hidden h-48">
                        <img src="{{ $berita->gambar ? asset('storage/'.$berita->gambar) : asset('images/kantor.png') }}"
                             alt="{{ $berita->judul }}"
                             loading="lazy"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                        {{-- Date badge --}}
                        <div class="absolute top-3 left-3 bg-primary text-white rounded-xl px-3 py-1.5 text-center shadow-lg leading-tight">
                            <div class="text-lg font-bold leading-none">
                                {{ optional($berita->tanggal_publish)->format('d') ?? $berita->created_at->format('d') }}
                            </div>
                            <div class="text-xs uppercase tracking-wider">
                                {{ optional($berita->tanggal_publish)->format('M') ?? $berita->created_at->format('M') }}
                            </div>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="flex flex-col flex-1 p-5">
                        <h3 class="text-base font-bold text-slate-800 mb-2 line-clamp-2 group-hover:text-primary transition-colors">
                            {{ $berita->judul }}
                        </h3>
                        <p class="text-sm text-slate-500 leading-relaxed flex-1 line-clamp-3">
                            {{ Str::limit(strip_tags($berita->isi), 140) }}
                        </p>
                        <a href="{{ route('berita.show', $berita) }}"
                           class="inline-flex items-center gap-1.5 mt-4 text-sm font-semibold text-primary hover:gap-3 transition-all duration-200">
                            Baca Selengkapnya
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>

                </article>

            @empty

                <div class="sm:col-span-2 lg:col-span-3 py-16 text-center text-slate-400">
                    <i class="fa-solid fa-newspaper"></i>
                    <h5 class="text-lg font-semibold text-slate-600 mb-1">Belum Ada Berita</h5>
                    <p class="text-sm">Berita akan muncul setelah dipublikasikan melalui Dashboard Admin.</p>
                </div>

            @endforelse

        </div>

    </div>
</section>