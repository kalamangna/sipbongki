<section id="galeri" class="py-20 bg-slate-50">
    <div class="container mx-auto px-4 max-w-7xl">

        {{-- JUDUL SECTION --}}
        <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
            <span class="inline-block px-3.5 py-1.5 rounded-full bg-teal-100 text-teal-900 font-bold text-xs tracking-wider uppercase">
                Dokumentasi & Foto
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                Galeri Kegiatan
            </h2>
            <p class="text-slate-600 text-sm sm:text-base">
                Dokumentasi berbagai momen dan kegiatan kemasyarakatan di Kelurahan Bongki.
            </p>
        </div>

        {{-- GRID GALERI --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($galeris ?? $galeriList ?? [] as $galeri)
                <div class="group relative rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition duration-500 bg-slate-200 aspect-[4/3]">
                    @if($galeri->gambar)
                        <img src="{{ asset('storage/'.$galeri->gambar) }}" alt="{{ $galeri->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-400">
                            <i class="fa-solid fa-image text-4xl"></i>
                        </div>
                    @endif

                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 p-6 flex flex-col justify-end">
                        <span class="text-xs font-semibold text-teal-400 mb-1">
                            {{ $galeri->kategori ?? 'Dokumentasi' }}
                        </span>
                        <h4 class="text-white font-bold text-base line-clamp-2">
                            {{ $galeri->judul }}
                        </h4>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center bg-white rounded-3xl border border-slate-100 shadow-sm space-y-3">
                    <i class="fa-solid fa-images text-4xl text-slate-300"></i>
                    <p class="text-slate-500 text-sm font-medium">Belum ada foto galeri kegiatan saat ini.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>