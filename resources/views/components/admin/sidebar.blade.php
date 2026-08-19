<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-[100dvh] max-h-[100dvh] min-h-0 transition-transform -translate-x-full lg:translate-x-0 lg:static bg-white border-r border-slate-200 flex flex-col shadow-xl lg:shadow-none dark:bg-slate-900 dark:border-slate-800" aria-label="Sidebar">
    <div class="h-16 flex items-center justify-between px-4 border-b border-slate-200 shrink-0 dark:border-slate-800">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 focus:outline-none rounded-lg group" aria-label="Dashboard SIP Bongki">
            @if(isset($website) && $website?->logo)
                <img src="{{ asset('storage/'.$website->logo) }}"
                     alt="Logo {{ $website->nama_kelurahan ?? 'Kelurahan Bongki' }}"
                     class="h-10 w-auto object-contain">
            @else
                <img src="{{ asset('images/logo.png') }}"
                     alt="Logo Kelurahan Bongki"
                     class="h-10 w-auto object-contain">
            @endif

            <div class="leading-tight">
                <div class="text-sm font-bold text-slate-800 tracking-tight group-hover:text-primary-600 transition-colors dark:text-slate-100 dark:group-hover:text-primary-400">
                    {{ $website?->nama_website ?? 'SIP Bongki' }}
                </div>
                <div class="text-xs text-slate-500 font-medium dark:text-slate-400">
                    {{ $website?->nama_kelurahan ?? 'Kelurahan Bongki' }}
                </div>
            </div>
        </a>
        <button type="button" data-drawer-hide="logo-sidebar" aria-controls="logo-sidebar" class="lg:hidden text-slate-400 hover:text-slate-700 hover:bg-slate-100 p-2 rounded-xl focus:outline-none transition-colors dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-200 cursor-pointer">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto min-h-0 p-4 space-y-6 pb-10">

        {{-- DASHBOARD --}}
        <div>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium focus:outline-none {{ request()->routeIs('admin.dashboard') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950/60 dark:text-primary-400 dark:ring-1 dark:ring-primary-800/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800/70 dark:hover:text-slate-200' }}">
                <i class="fa-solid fa-gauge-high w-4 text-center"></i>
                <span>Dashboard</span>
            </a>
        </div>

        {{-- KEPENDUDUKAN --}}
        @if(in_array(auth()->user()->role, ['admin', 'operator']))
        <div>
            <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1 dark:text-slate-500">Kependudukan</p>
            <div class="space-y-0.5">
                <a href="{{ route('admin.penduduk.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium focus:outline-none {{ request()->routeIs('admin.penduduk.*') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950/60 dark:text-primary-400 dark:ring-1 dark:ring-primary-800/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800/70 dark:hover:text-slate-200' }}">
                    <i class="fa-solid fa-users w-4 text-center"></i>
                    <span>Data Penduduk</span>
                </a>
                <a href="{{ route('admin.kartu-keluarga.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium focus:outline-none {{ request()->routeIs('admin.kartu-keluarga.*') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950/60 dark:text-primary-400 dark:ring-1 dark:ring-primary-800/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800/70 dark:hover:text-slate-200' }}">
                    <i class="fa-solid fa-address-card w-4 text-center"></i>
                    <span>Kartu Keluarga</span>
                </a>
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.perangkat.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium focus:outline-none {{ request()->routeIs('admin.perangkat.*') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950/60 dark:text-primary-400 dark:ring-1 dark:ring-primary-800/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800/70 dark:hover:text-slate-200' }}">
                    <i class="fa-solid fa-user-tie w-4 text-center"></i>
                    <span>Aparatur</span>
                </a>
                @endif
            </div>
        </div>
        @endif

        {{-- PELAYANAN --}}
        <div>
            <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1 dark:text-slate-500">Pelayanan</p>
            <div class="space-y-0.5">
                <a href="{{ route('admin.permohonan-surat.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium focus:outline-none {{ request()->routeIs('admin.permohonan-surat.*') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950/60 dark:text-primary-400 dark:ring-1 dark:ring-primary-800/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800/70 dark:hover:text-slate-200' }}">
                    <i class="fa-solid fa-file-signature w-4 text-center"></i>
                    <span>Persuratan</span>
                </a>
                <a href="{{ route('admin.pengaduan.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium focus:outline-none {{ request()->routeIs('admin.pengaduan.*') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950/60 dark:text-primary-400 dark:ring-1 dark:ring-primary-800/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800/70 dark:hover:text-slate-200' }}">
                    <i class="fa-solid fa-comment-dots w-4 text-center"></i>
                    <span>Pengaduan</span>
                </a>
                <a href="{{ route('admin.riwayat-pelayanan.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium focus:outline-none {{ request()->routeIs('admin.riwayat-pelayanan.*') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950/60 dark:text-primary-400 dark:ring-1 dark:ring-primary-800/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800/70 dark:hover:text-slate-200' }}">
                    <i class="fa-solid fa-clock-rotate-left w-4 text-center"></i>
                    <span>Riwayat</span>
                </a>
            </div>
        </div>

        {{-- MASTER DATA --}}
        @if(auth()->user()->role === 'admin')
        <div>
            <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1 dark:text-slate-500">Master Data</p>
            <div class="space-y-0.5">
                <a href="{{ route('admin.lingkungan.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium focus:outline-none {{ request()->routeIs('admin.lingkungan.*') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950/60 dark:text-primary-400 dark:ring-1 dark:ring-primary-800/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800/70 dark:hover:text-slate-200' }}">
                    <i class="fa-solid fa-map-pin w-4 text-center"></i>
                    <span>Lingkungan</span>
                </a>
                <a href="{{ route('admin.jabatan.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium focus:outline-none {{ request()->routeIs('admin.jabatan.*') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950/60 dark:text-primary-400 dark:ring-1 dark:ring-primary-800/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800/70 dark:hover:text-slate-200' }}">
                    <i class="fa-solid fa-id-badge w-4 text-center"></i>
                    <span>Jabatan</span>
                </a>
                <a href="{{ route('admin.jenis-surat.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium focus:outline-none {{ request()->routeIs('admin.jenis-surat.*') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950/60 dark:text-primary-400 dark:ring-1 dark:ring-primary-800/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800/70 dark:hover:text-slate-200' }}">
                    <i class="fa-solid fa-scroll w-4 text-center"></i>
                    <span>Jenis Surat</span>
                </a>
            </div>
        </div>
        @endif

        {{-- WEBSITE --}}
        @if(auth()->user()->role === 'admin')
        <div>
            <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1 dark:text-slate-500">Website</p>
            <div class="space-y-0.5">
                <a href="{{ route('admin.website.berita.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium focus:outline-none {{ request()->routeIs('admin.website.berita.*') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950/60 dark:text-primary-400 dark:ring-1 dark:ring-primary-800/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800/70 dark:hover:text-slate-200' }}">
                    <i class="fa-solid fa-newspaper w-4 text-center"></i>
                    <span>Berita</span>
                </a>
                <a href="{{ route('admin.website.pengumuman.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium focus:outline-none {{ request()->routeIs('admin.website.pengumuman.*') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950/60 dark:text-primary-400 dark:ring-1 dark:ring-primary-800/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800/70 dark:hover:text-slate-200' }}">
                    <i class="fa-solid fa-bullhorn w-4 text-center"></i>
                    <span>Pengumuman</span>
                </a>
                <a href="{{ route('admin.website.agenda.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium focus:outline-none {{ request()->routeIs('admin.website.agenda.*') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950/60 dark:text-primary-400 dark:ring-1 dark:ring-primary-800/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800/70 dark:hover:text-slate-200' }}">
                    <i class="fa-solid fa-calendar-days w-4 text-center"></i>
                    <span>Agenda</span>
                </a>
                <a href="{{ route('admin.website.galeri.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium focus:outline-none {{ request()->routeIs('admin.website.galeri.*') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950/60 dark:text-primary-400 dark:ring-1 dark:ring-primary-800/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800/70 dark:hover:text-slate-200' }}">
                    <i class="fa-solid fa-images w-4 text-center"></i>
                    <span>Galeri</span>
                </a>

            </div>
        </div>
        @endif

        {{-- LAPORAN --}}
        @if(in_array(auth()->user()->role, ['admin', 'pimpinan']))
        <div>
            <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1 dark:text-slate-500">Laporan</p>
            <a href="{{ route('admin.laporan.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium focus:outline-none {{ request()->routeIs('admin.laporan.*') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950/60 dark:text-primary-400 dark:ring-1 dark:ring-primary-800/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800/70 dark:hover:text-slate-200' }}">
                <i class="fa-solid fa-chart-bar w-4 text-center"></i>
                <span>Laporan</span>
            </a>
        </div>
        @endif

        {{-- PENGATURAN --}}
        @if(auth()->user()->role === 'admin')
        <div>
            <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1 dark:text-slate-500">Pengaturan</p>
            <div class="space-y-0.5">
                <a href="{{ route('admin.website.pengaturan.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium focus:outline-none {{ request()->routeIs('admin.website.pengaturan.*') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950/60 dark:text-primary-400 dark:ring-1 dark:ring-primary-800/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800/70 dark:hover:text-slate-200' }}">
                    <i class="fa-solid fa-sliders w-4 text-center"></i>
                    <span>Website</span>
                </a>
                <a href="{{ route('admin.user.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium focus:outline-none {{ request()->routeIs('admin.user.*') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950/60 dark:text-primary-400 dark:ring-1 dark:ring-primary-800/50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800/70 dark:hover:text-slate-200' }}">
                    <i class="fa-solid fa-users-gear w-4 text-center"></i>
                    <span>Pengguna</span>
                </a>
            </div>
        </div>
        @endif

    </nav>

    <div class="p-4 border-t border-slate-200 shrink-0 bg-white dark:border-slate-800 dark:bg-slate-900">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-slate-100 hover:bg-red-50 text-slate-700 hover:text-red-600 rounded-lg text-sm font-medium transition-colors focus:outline-none cursor-pointer dark:bg-slate-800 dark:hover:bg-rose-950/50 dark:text-slate-300 dark:hover:text-rose-400">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>