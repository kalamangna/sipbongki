@php
    $user = auth()->user();
    
    $totalNotifications = 0;
    if (isset($jumlahPengaduanBaru)) $totalNotifications += $jumlahPengaduanBaru;
    if (isset($jumlahPermohonanBaru)) $totalNotifications += $jumlahPermohonanBaru;
    if (isset($jumlahPendudukTidakAktif)) $totalNotifications += $jumlahPendudukTidakAktif;
@endphp

<header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-4 lg:px-8 shrink-0 dark:bg-slate-900 dark:border-slate-800">

    {{-- Left --}}
    <div class="flex items-center gap-4">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="text-slate-500 hover:text-primary-600 lg:hidden focus:outline-none transition-colors p-2 rounded-lg hover:bg-slate-50 dark:text-slate-400 dark:hover:text-primary-400 dark:hover:bg-slate-800">
            <i class="fa-solid fa-bars text-lg"></i>
        </button>
    </div>

    {{-- Right --}}
    <div class="flex items-center gap-3 sm:gap-4">

        {{-- Theme Switcher --}}
        <button type="button"
                x-data="{
                    darkMode: localStorage.theme === 'dark',
                    toggle() {
                        this.darkMode = !this.darkMode;
                        if (this.darkMode) {
                            document.documentElement.classList.add('dark');
                            localStorage.theme = 'dark';
                        } else {
                            document.documentElement.classList.remove('dark');
                            localStorage.theme = 'light';
                        }
                    }
                }"
                @click="toggle()"
                class="p-2 text-slate-500 hover:text-amber-500 hover:bg-slate-50 rounded-full transition-all focus:outline-none cursor-pointer dark:text-slate-400 dark:hover:text-amber-400 dark:hover:bg-slate-800"
                :title="darkMode ? 'Beralih ke Mode Terang' : 'Beralih ke Mode Gelap'"
                aria-label="Toggle dark mode">
            <i class="fa-solid fa-moon text-lg" x-show="!darkMode"></i>
            <i class="fa-solid fa-sun text-lg text-amber-400" x-show="darkMode" style="display: none;"></i>
        </button>

        {{-- Notification --}}
        <div class="relative">
            <button id="notifDropdownButton" data-dropdown-toggle="notifDropdown" class="relative p-2 text-slate-500 hover:text-primary-600 hover:bg-slate-50 rounded-full transition-all focus:outline-none dark:text-slate-400 dark:hover:text-primary-400 dark:hover:bg-slate-800">
                <i class="fa-regular fa-bell text-xl"></i>
                @if($totalNotifications > 0)
                    <span class="absolute top-1 right-1.5 flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500 border-2 border-white dark:border-slate-900"></span>
                    </span>
                @endif
            </button>

            {{-- Dropdown Notif --}}
            <div id="notifDropdown" class="hidden z-50 w-72 bg-white border border-slate-200 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] rounded-2xl overflow-hidden origin-top-right dark:bg-slate-900 dark:border-slate-800 dark:shadow-slate-950/40">
                <div class="px-4 py-3 bg-slate-50/80 border-b border-slate-100 font-bold text-sm text-slate-800 dark:bg-slate-800/80 dark:border-slate-800 dark:text-slate-200">Pemberitahuan</div>
                <div class="py-2">
                    <a href="{{ route('admin.pengaduan.index') }}" class="flex items-center justify-between px-4 py-2.5 text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary-600 dark:hover:text-primary-400 transition-colors focus:outline-none">
                        <span class="flex items-center gap-2"><i class="fa-solid fa-comment-dots text-slate-400 dark:text-slate-500"></i> Pengaduan Baru</span>
                        @if(isset($jumlahPengaduanBaru) && $jumlahPengaduanBaru > 0)
                            <span class="bg-red-50 dark:bg-red-950/60 text-red-600 dark:text-red-400 py-0.5 px-2.5 rounded-full text-[10px] font-extrabold">{{ $jumlahPengaduanBaru }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.permohonan-surat.index') }}" class="flex items-center justify-between px-4 py-2.5 text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary-600 dark:hover:text-primary-400 transition-colors focus:outline-none">
                        <span class="flex items-center gap-2"><i class="fa-solid fa-file-signature text-slate-400 dark:text-slate-500"></i> Permohonan Surat</span>
                        @if(isset($jumlahPermohonanBaru) && $jumlahPermohonanBaru > 0)
                            <span class="bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 py-0.5 px-2.5 rounded-full text-[10px] font-extrabold">{{ $jumlahPermohonanBaru }}</span>
                        @endif
                    </a>
                    @if(isset($jumlahPendudukTidakAktif) && $jumlahPendudukTidakAktif > 0)
                    <a href="{{ route('admin.penduduk.index', ['aktif' => '0']) }}" class="flex items-center justify-between px-4 py-2.5 text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary-600 dark:hover:text-primary-400 transition-colors focus:outline-none">
                        <span class="flex items-center gap-2"><i class="fa-solid fa-user-xmark text-slate-400 dark:text-slate-500"></i> Penduduk Tidak Aktif</span>
                        <span class="bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 py-0.5 px-2.5 rounded-full text-[10px] font-extrabold">{{ $jumlahPendudukTidakAktif }}</span>
                    </a>
                    @endif
                    @if($totalNotifications == 0)
                    <div class="px-4 py-3 text-center text-xs text-slate-400 dark:text-slate-500">
                        Tidak ada pemberitahuan baru
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Divider --}}
        <div class="h-6 w-px bg-slate-200 dark:bg-slate-800"></div>

        {{-- User Menu --}}
        <div class="relative">
            <button id="userDropdownButton" data-dropdown-toggle="userDropdown" class="flex items-center gap-2.5 focus:outline-none p-1 rounded-full hover:bg-slate-50 transition-colors pr-3 border border-transparent hover:border-slate-200 cursor-pointer dark:hover:bg-slate-800 dark:hover:border-slate-700">
                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-primary-600 to-primary-400 text-white shadow-sm flex items-center justify-center font-bold text-sm shrink-0">
                    {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                </div>
                <p class="hidden md:block text-sm font-semibold text-slate-700 tracking-tight max-w-[220px] truncate dark:text-slate-200">{{ $user->name ?? 'Administrator' }}</p>
                <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 ml-1"></i>
            </button>

            {{-- Dropdown Profile --}}
            <div id="userDropdown" class="hidden z-50 w-64 bg-white border border-slate-200 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] rounded-2xl overflow-hidden origin-top-right dark:bg-slate-900 dark:border-slate-800 dark:shadow-slate-950/40">
                <div class="px-4 py-3.5 border-b border-slate-100 bg-slate-50/50 dark:border-slate-800 dark:bg-slate-800/50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-primary-100 text-primary-700 font-bold flex items-center justify-center text-base shrink-0 border border-primary-200 shadow-sm dark:bg-primary-950/60 dark:text-primary-300 dark:border-primary-800">
                            {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-bold text-slate-900 truncate leading-tight dark:text-slate-100">{{ $user->name ?? 'Administrator' }}</p>
                            <p class="text-xs text-slate-500 font-mono truncate mt-0.5 dark:text-slate-400">&#64;{{ $user->username ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="mt-2.5">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-200/70 text-slate-700 tracking-wide uppercase dark:bg-slate-800 dark:text-slate-300">
                            {{ $user->role ?? 'Admin' }}
                        </span>
                    </div>
                </div>

                <div class="p-1.5 space-y-0.5">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-primary-600 rounded-xl transition-colors focus:outline-none dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-primary-400">
                        <i class="fa-regular fa-user text-slate-400 text-xs w-4 text-center"></i> Profil Saya
                    </a>

                    @if($user && $user->role === 'admin')
                    <a href="{{ route('admin.website.pengaturan.index') }}" class="flex items-center gap-2.5 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-primary-600 rounded-xl transition-colors focus:outline-none dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-primary-400">
                        <i class="fa-solid fa-gear text-slate-400 text-xs w-4 text-center"></i> Pengaturan Website
                    </a>
                    @endif

                    <a href="{{ url('/') }}" target="_blank" class="flex items-center gap-2.5 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-primary-600 rounded-xl transition-colors focus:outline-none dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-primary-400">
                        <i class="fa-solid fa-arrow-up-right-from-square text-slate-400 text-xs w-4 text-center"></i> Lihat Website
                    </a>
                </div>

                <div class="border-t border-slate-100 p-1.5 dark:border-slate-800">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 text-sm font-medium text-rose-600 hover:bg-rose-50 hover:text-rose-700 rounded-xl transition-colors text-left focus:outline-none cursor-pointer dark:text-rose-400 dark:hover:bg-rose-950/40 dark:hover:text-rose-300">
                            <i class="fa-solid fa-right-from-bracket text-xs text-rose-400 w-4 text-center"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</header>