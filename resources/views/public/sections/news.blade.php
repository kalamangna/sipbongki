<section id="berita" class="py-20 bg-white">
    <div class="container mx-auto px-4 max-w-7xl">

        {{-- JUDUL SECTION --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div class="space-y-3 max-w-2xl">
                <span class="inline-block px-3.5 py-1.5 rounded-full bg-emerald-100 text-emerald-800 font-bold text-xs tracking-wider uppercase">
                    Informasi & Berita
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    Kabar & Berita Terbaru
                </h2>
                <p class="text-slate-600 text-sm sm:text-base">
                    Ikuti perkembangan kegiatan dan kabar terkini seputar Kelurahan Bongki.
                </p>
            </div>
        </div>

        {{-- GRID BERITA --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($beritas ?? $beritaList ?? [] as $berita)
                <article class="bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition duration-300 flex flex-col group">
                    <div class="relative h-48 overflow-hidden bg-slate-100">
                        @if($berita->gambar)
                            <img src="{{ asset('storage/'.$berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <i class="fa-solid fa-image text-4xl"></i>
                            </div>
                        @endif

                        <span class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur-md rounded-full text-[11px] font-bold text-slate-700 shadow-sm">
                            <i class="fa-regular fa-clock text-emerald-600 mr-1"></i>
                            {{ \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('d M Y') }}
                        </span>
                    </div>

                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                        <div class="space-y-2">
                            <h3 class="font-bold text-lg text-slate-900 group-hover:text-emerald-600 transition line-clamp-2 leading-snug">
                                <a href="{{ route('berita.show', $berita->id) }}">
                                    {{ $berita->judul }}
                                </a>
                            </h3>
                            <p class="text-slate-500 text-xs leading-relaxed line-clamp-3">
                                {{ Str::limit(strip_tags($berita->isi), 120) }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-[11px] font-semibold text-slate-400">
                                Oleh Admin
                            </span>

                            <a href="{{ route('berita.show', $berita->id) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 group-hover:text-emerald-700">
                                <span>Baca Selengkapnya</span>
                                <i class="fa-solid fa-arrow-right text-[10px] transform group-hover:translate-x-1 transition"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full py-12 text-center bg-slate-50 rounded-3xl border border-slate-100 shadow-sm space-y-3">
                    <i class="fa-solid fa-newspaper text-4xl text-slate-300"></i>
                    <p class="text-slate-500 text-sm font-medium">Belum ada berita terbaru saat ini.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>