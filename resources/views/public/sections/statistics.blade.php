<section class="py-16 bg-white border-y border-slate-100">
    <div class="container mx-auto px-4 max-w-7xl space-y-12">

        {{-- HEADER SECTION --}}
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <span class="inline-block px-3.5 py-1.5 rounded-full bg-emerald-100 text-emerald-800 font-bold text-xs tracking-wider uppercase">
                Data & Statistik
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                Statistik Wilayah Kelurahan
            </h2>
            <p class="text-slate-600 text-sm sm:text-base">
                Gambaran umum kondisi kependudukan dan pelayanan publik di Kelurahan Bongki.
            </p>
        </div>

        {{-- GRID CARDS STATISTIK --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-slate-50 rounded-3xl p-6 border border-slate-100 shadow-sm flex items-center gap-4 hover:shadow-md transition">
                <div class="w-14 h-14 rounded-2xl bg-emerald-600 text-white flex items-center justify-center text-2xl shrink-0 shadow-lg shadow-emerald-600/20">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-slate-900 leading-tight">{{ number_format($jumlahPenduduk ?? 0) }}</h3>
                    <p class="text-xs font-bold text-slate-700">Total Penduduk</p>
                    <span class="text-[11px] text-slate-400">Jiwa terdaftar</span>
                </div>
            </div>

            <div class="bg-slate-50 rounded-3xl p-6 border border-slate-100 shadow-sm flex items-center gap-4 hover:shadow-md transition">
                <div class="w-14 h-14 rounded-2xl bg-teal-600 text-white flex items-center justify-center text-2xl shrink-0 shadow-lg shadow-teal-600/20">
                    <i class="fa-solid fa-house"></i>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-slate-900 leading-tight">{{ number_format($jumlahKK ?? 0) }}</h3>
                    <p class="text-xs font-bold text-slate-700">Kartu Keluarga</p>
                    <span class="text-[11px] text-slate-400">Kepala keluarga</span>
                </div>
            </div>

            <div class="bg-slate-50 rounded-3xl p-6 border border-slate-100 shadow-sm flex items-center gap-4 hover:shadow-md transition">
                <div class="w-14 h-14 rounded-2xl bg-sky-600 text-white flex items-center justify-center text-2xl shrink-0 shadow-lg shadow-sky-600/20">
                    <i class="fa-solid fa-file-lines"></i>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-slate-900 leading-tight">{{ number_format($jumlahJenisSurat ?? 0) }}</h3>
                    <p class="text-xs font-bold text-slate-700">Layanan Surat</p>
                    <span class="text-[11px] text-slate-400">Jenis layanan aktif</span>
                </div>
            </div>

            <div class="bg-slate-50 rounded-3xl p-6 border border-slate-100 shadow-sm flex items-center gap-4 hover:shadow-md transition">
                <div class="w-14 h-14 rounded-2xl bg-amber-600 text-white flex items-center justify-center text-2xl shrink-0 shadow-lg shadow-amber-600/20">
                    <i class="fa-solid fa-id-badge"></i>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-slate-900 leading-tight">{{ number_format($jumlahPerangkat ?? 0) }}</h3>
                    <p class="text-xs font-bold text-slate-700">Perangkat Kelurahan</p>
                    <span class="text-[11px] text-slate-400">Aparatur siap melayani</span>
                </div>
            </div>
        </div>

    </div>
</section>