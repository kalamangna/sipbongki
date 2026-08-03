<nav class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-100 shadow-xs transition-all duration-300" x-data="{ mobileOpen: false }">
    <div class="container mx-auto px-4 max-w-7xl flex items-center justify-between h-20">

        {{-- BRAND --}}
        <a href="{{ url('/') }}" class="flex items-center gap-3 group">
            @if(isset($website) && $website?->logo)
                <img src="{{ asset('storage/'.$website->logo) }}" alt="Logo" class="w-10 h-10 object-contain transition-transform duration-300 group-hover:scale-105">
            @else
                <img src="{{ asset('images/sinjai.png') }}" alt="Logo Kelurahan Bongki" class="w-10 h-10 object-contain transition-transform duration-300 group-hover:scale-105">
            @endif

            <div class="flex flex-col">
                <span class="font-extrabold text-base sm:text-lg text-slate-800 tracking-tight leading-tight group-hover:text-emerald-600 transition-colors">
                    {{ $website?->nama_website ?? 'SIP Bongki' }}
                </span>
                <span class="text-[11px] font-semibold text-slate-400">
                    {{ $website?->nama_kelurahan ?? 'Kelurahan Bongki' }}
                </span>
            </div>
        </a>

        {{-- MOBILE TOGGLE BUTTON --}}
        <button type="button" @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 text-slate-600 hover:text-emerald-600 rounded-xl hover:bg-slate-100 transition focus:outline-none">
            <i class="fa-solid" :class="mobileOpen ? 'fa-xmark text-2xl' : 'fa-bars text-2xl'"></i>
        </button>

        {{-- DESKTOP MENU --}}
        <div class="hidden lg:flex items-center gap-6">
            <ul class="flex items-center gap-1 text-sm font-semibold text-slate-600">
                <li>
                    <a href="{{ url('/') }}" class="px-3.5 py-2 rounded-xl hover:text-emerald-600 hover:bg-emerald-50/70 transition-all duration-200">
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ url('/#profil') }}" class="px-3.5 py-2 rounded-xl hover:text-emerald-600 hover:bg-emerald-50/70 transition-all duration-200">
                        Profil
                    </a>
                </li>
                <li>
                    <a href="{{ url('/#struktur-organisasi') }}" class="px-3.5 py-2 rounded-xl hover:text-emerald-600 hover:bg-emerald-50/70 transition-all duration-200">
                        Organisasi
                    </a>
                </li>
                <li>
                    <a href="{{ url('/#layanan') }}" class="px-3.5 py-2 rounded-xl hover:text-emerald-600 hover:bg-emerald-50/70 transition-all duration-200">
                        Layanan
                    </a>
                </li>
                <li>
                    <a href="{{ url('/#berita') }}" class="px-3.5 py-2 rounded-xl hover:text-emerald-600 hover:bg-emerald-50/70 transition-all duration-200">
                        Berita
                    </a>
                </li>
                <li>
                    <a href="{{ url('/#galeri') }}" class="px-3.5 py-2 rounded-xl hover:text-emerald-600 hover:bg-emerald-50/70 transition-all duration-200">
                        Galeri
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengaduan') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-emerald-700 bg-emerald-50 hover:bg-emerald-100/80 font-bold transition-all duration-200">
                        <i class="fa-solid fa-bullhorn text-xs"></i>
                        <span>Pengaduan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/#kontak') }}" class="px-3.5 py-2 rounded-xl hover:text-emerald-600 hover:bg-emerald-50/70 transition-all duration-200">
                        Kontak
                    </a>
                </li>
            </ul>

            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-sm rounded-full shadow-md shadow-emerald-600/20 hover:shadow-lg hover:shadow-emerald-600/30 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0">
                <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                <span>Masuk</span>
            </a>
        </div>
    </div>

    {{-- MOBILE MENU DROPDOWN --}}
    <div class="lg:hidden bg-white border-b border-slate-100 shadow-2xl px-4 py-4 space-y-3" x-show="mobileOpen" x-transition x-collapse>
        <ul class="flex flex-col gap-1 text-sm font-semibold text-slate-700">
            <li><a href="{{ url('/') }}" @click="mobileOpen = false" class="block px-4 py-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-600 transition">Beranda</a></li>
            <li><a href="{{ url('/#profil') }}" @click="mobileOpen = false" class="block px-4 py-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-600 transition">Profil</a></li>
            <li><a href="{{ url('/#struktur-organisasi') }}" @click="mobileOpen = false" class="block px-4 py-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-600 transition">Organisasi</a></li>
            <li><a href="{{ url('/#layanan') }}" @click="mobileOpen = false" class="block px-4 py-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-600 transition">Layanan</a></li>
            <li><a href="{{ url('/#berita') }}" @click="mobileOpen = false" class="block px-4 py-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-600 transition">Berita</a></li>
            <li><a href="{{ url('/#galeri') }}" @click="mobileOpen = false" class="block px-4 py-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-600 transition">Galeri</a></li>
            <li>
                <a href="{{ route('pengaduan') }}" @click="mobileOpen = false" class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-emerald-700 bg-emerald-50 font-bold hover:bg-emerald-100 transition">
                    <i class="fa-solid fa-bullhorn text-xs"></i>
                    <span>Pengaduan Masyarakat</span>
                </a>
            </li>
            <li><a href="{{ url('/#kontak') }}" @click="mobileOpen = false" class="block px-4 py-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-600 transition">Kontak</a></li>
        </ul>

        <div class="pt-2 border-t border-slate-100">
            <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold text-sm rounded-xl shadow-md shadow-emerald-600/20 active:scale-95 transition">
                <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                <span>Masuk Sistem</span>
            </a>
        </div>
    </div>
</nav>