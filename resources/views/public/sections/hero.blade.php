<section class="relative pt-32 pb-20 overflow-hidden bg-gradient-to-b from-slate-50 via-emerald-50/20 to-white">
    <div class="container mx-auto px-4 max-w-7xl relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

            {{-- HERO CONTENT --}}
            <div class="lg:col-span-6 text-center lg:text-left space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-50 border border-emerald-200/60 text-emerald-700 text-xs font-semibold mb-6 shadow-2xs">
                    <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Sistem Informasi dan Pelayanan Kelurahan Bongki
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-tight">
                    {{ $website?->judul_hero ?? 'Kelurahan' }}
                    <span class="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                        {{ $website?->subjudul_hero ?? 'Bongki' }}
                    </span>
                </h1>

                <p class="text-slate-600 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto lg:mx-0">
                    {{ $website?->deskripsi_hero ?? 'Selamat datang di Sistem Informasi dan Layanan Masyarakat Kelurahan Bongki. Kami berkomitmen menghadirkan pelayanan publik berbasis digital yang memudahkan masyarakat dalam memperoleh informasi dan layanan administrasi.' }}
                </p>

                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-2">
                    <a href="{{ $website?->hero_button_1_link ?? '#layanan' }}" class="inline-flex items-center gap-2.5 px-6 py-3.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-sm rounded-2xl shadow-lg shadow-emerald-600/25 hover:shadow-xl hover:shadow-emerald-600/35 transition duration-300 transform hover:-translate-y-0.5 active:translate-y-0">
                        <i class="fa-solid fa-paper-plane text-base"></i>
                        <span>{{ $website?->hero_button_1_text ?? 'Ajukan Permohonan' }}</span>
                    </a>

                    <a href="{{ $website?->hero_button_2_link ?? '#layanan' }}" class="inline-flex items-center gap-2.5 px-6 py-3.5 bg-white hover:bg-slate-50 text-slate-700 font-bold text-sm rounded-2xl border border-slate-200 shadow-sm hover:shadow transition duration-300">
                        <i class="fa-solid fa-layer-group text-emerald-600 text-base"></i>
                        <span>{{ $website?->hero_button_2_text ?? 'Lihat Layanan' }}</span>
                    </a>
                </div>
            </div>

            {{-- HERO IMAGE & QUICK INFO --}}
            <div class="lg:col-span-6 space-y-6">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white bg-slate-100">
                    <img src="{{ $website?->gambar_hero ? asset('storage/'.$website->gambar_hero) : asset('images/kantor.png') }}" alt="Kelurahan Bongki" class="w-full h-80 sm:h-96 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent"></div>
                </div>

                {{-- QUICK INFO CARDS --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm text-center space-y-1">
                        <i class="fa-solid fa-clock-rotate-left text-emerald-600 text-xl"></i>
                        <h6 class="text-xs font-bold text-slate-800">Jam Layanan</h6>
                        <p class="text-[11px] text-slate-500 font-medium">{{ $website?->jam_pelayanan ?? '08.00 - 16.00' }}</p>
                    </div>

                    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm text-center space-y-1">
                        <i class="fa-solid fa-location-dot text-emerald-600 text-xl"></i>
                        <h6 class="text-xs font-bold text-slate-800">Wilayah</h6>
                        <p class="text-[11px] text-slate-500 font-medium">Kel. Bongki</p>
                    </div>

                    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm text-center space-y-1">
                        <i class="fa-brands fa-whatsapp text-emerald-500 text-xl"></i>
                        <h6 class="text-xs font-bold text-slate-800">WhatsApp</h6>
                        <p class="text-[11px] text-slate-500 font-medium">{{ $website?->whatsapp ?? '-' }}</p>
                    </div>

                    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm text-center space-y-1">
                        <i class="fa-solid fa-headset text-emerald-600 text-xl"></i>
                        <h6 class="text-xs font-bold text-slate-800">Respons</h6>
                        <p class="text-[11px] text-slate-500 font-medium">Cepat & Siap</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- STATISTIK RINGKAS --}}
        <div class="mt-16 bg-white rounded-3xl p-6 sm:p-8 shadow-xl shadow-slate-100 border border-slate-100 grid grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-900">{{ number_format($jumlahPenduduk ?? 0) }}</h3>
                    <p class="text-xs font-semibold text-slate-500">Penduduk Terdaftar</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-teal-100 text-teal-600 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-house"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-900">{{ number_format($jumlahKK ?? 0) }}</h3>
                    <p class="text-xs font-semibold text-slate-500">Kartu Keluarga</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-sky-100 text-sky-600 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-file-lines"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-900">{{ number_format($jumlahJenisSurat ?? 0) }}</h3>
                    <p class="text-xs font-semibold text-slate-500">Jenis Layanan</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-id-badge"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-900">{{ number_format($jumlahPerangkat ?? 0) }}</h3>
                    <p class="text-xs font-semibold text-slate-500">Perangkat Kelurahan</p>
                </div>
            </div>
        </div>
    </div>
</section>