@php
    $user = auth()->user();
    $hour = now()->hour;
    $greeting = match (true) {
        $hour < 11 => 'Selamat pagi',
        $hour < 15 => 'Selamat siang',
        $hour < 18 => 'Selamat sore',
        default    => 'Selamat malam',
    };

    $totalNotifications = 0;
    if (isset($jumlahPengaduanBaru)) $totalNotifications += $jumlahPengaduanBaru;
    if (isset($jumlahPermohonanBaru)) $totalNotifications += $jumlahPermohonanBaru;
@endphp

<header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-4 lg:px-8 shrink-0">

    {{-- Left --}}
    <div class="flex items-center gap-4">
        <button class="text-slate-500 hover:text-slate-700 lg:hidden focus:outline-none">
            <i class="fa-solid fa-bars text-lg"></i>
        </button>
        <div class="hidden md:block">
            <h1 class="text-sm font-bold text-slate-800 leading-tight">SIP Bongki</h1>
            <p class="text-xs text-slate-500">Sistem Informasi dan Pelayanan Kelurahan</p>
        </div>
    </div>

    {{-- Right --}}
    <div class="flex items-center gap-4">

        {{-- Notification --}}
        <div class="relative group">
            <button class="relative p-2 text-slate-500 hover:bg-slate-100 rounded-full transition-colors focus:outline-none">
                <i class="fa-regular fa-bell text-lg"></i>
                @if($totalNotifications > 0)
                    <span class="absolute top-1 right-1 flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                    </span>
                @endif
            </button>

            {{-- Dropdown Notif --}}
            <div class="absolute right-0 mt-2 w-64 bg-white border border-slate-200 shadow-lg rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                <div class="p-3 border-b border-slate-100 font-semibold text-sm text-slate-700">Notifikasi</div>
                <div class="py-1">
                    <a href="{{ route('admin.pengaduan.index') }}" class="flex items-center justify-between px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                        <span>Pengaduan Baru</span>
                        @if(isset($jumlahPengaduanBaru) && $jumlahPengaduanBaru > 0)
                            <span class="bg-red-100 text-red-600 py-0.5 px-2 rounded-full text-xs font-bold">{{ $jumlahPengaduanBaru }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.permohonan-surat.index') }}" class="flex items-center justify-between px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                        <span>Permohonan Surat</span>
                        @if(isset($jumlahPermohonanBaru) && $jumlahPermohonanBaru > 0)
                            <span class="bg-amber-100 text-amber-600 py-0.5 px-2 rounded-full text-xs font-bold">{{ $jumlahPermohonanBaru }}</span>
                        @endif
                    </a>
                </div>
            </div>
        </div>

        {{-- Divider --}}
        <div class="h-8 w-px bg-slate-200"></div>

        {{-- User Menu --}}
        <div class="relative group">
            <button class="flex items-center gap-3 focus:outline-none rounded-lg p-1">
                <div class="w-9 h-9 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-sm">
                    {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                </div>
                <div class="hidden md:block text-left">
                    <p class="text-sm font-semibold text-slate-700 leading-none">{{ $user->name ?? 'Administrator' }}</p>
                    <p class="text-xs text-slate-500 mt-1">{{ $greeting }}</p>
                </div>
                <i class="fa-solid fa-chevron-down text-xs text-slate-400"></i>
            </button>

            {{-- Dropdown Profile --}}
            <div class="absolute right-0 mt-2 w-48 bg-white border border-slate-200 shadow-lg rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 overflow-hidden">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                    <i class="fa-regular fa-user w-4 text-center"></i> Profil Saya
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                    <i class="fa-solid fa-gear w-4 text-center"></i> Pengaturan
                </a>
                <div class="border-t border-slate-100 my-1"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 text-left">
                        <i class="fa-solid fa-right-from-bracket w-4 text-center"></i> Keluar
                    </button>
                </form>
            </div>
        </div>

    </div>
</header>