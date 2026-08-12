@php
    $user = auth()->user();
    
    $totalNotifications = 0;
    if (isset($jumlahPengaduanBaru)) $totalNotifications += $jumlahPengaduanBaru;
    if (isset($jumlahPermohonanBaru)) $totalNotifications += $jumlahPermohonanBaru;
@endphp

<header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-4 lg:px-8 shrink-0">

    {{-- Left --}}
    <div class="flex items-center gap-4">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="text-slate-500 hover:text-primary-600 lg:hidden focus:outline-none transition-colors p-2 rounded-lg hover:bg-slate-50">
            <i class="fa-solid fa-bars text-lg"></i>
        </button>
    </div>

    {{-- Right --}}
    <div class="flex items-center gap-5">

        {{-- Notification --}}
        <div class="relative">
            <button id="notifDropdownButton" data-dropdown-toggle="notifDropdown" class="relative p-2 text-slate-500 hover:text-primary-600 hover:bg-slate-50 rounded-full transition-all focus:outline-none">
                <i class="fa-regular fa-bell text-xl"></i>
                @if($totalNotifications > 0)
                    <span class="absolute top-1 right-1.5 flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500 border-2 border-white"></span>
                    </span>
                @endif
            </button>

            {{-- Dropdown Notif --}}
            <div id="notifDropdown" class="hidden z-50 w-72 bg-white border border-slate-200 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] rounded-2xl overflow-hidden origin-top-right">
                <div class="px-4 py-3 bg-slate-50/80 border-b border-slate-100 font-bold text-sm text-slate-800">Pemberitahuan</div>
                <div class="py-2">
                    <a href="{{ route('admin.pengaduan.index') }}" class="flex items-center justify-between px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-primary-600 transition-colors focus:outline-none">
                        <span class="flex items-center gap-2"><i class="fa-solid fa-comment-dots text-slate-400"></i> Pengaduan Baru</span>
                        @if(isset($jumlahPengaduanBaru) && $jumlahPengaduanBaru > 0)
                            <span class="bg-red-50 text-red-600 py-0.5 px-2.5 rounded-full text-[10px] font-extrabold">{{ $jumlahPengaduanBaru }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.permohonan-surat.index') }}" class="flex items-center justify-between px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-primary-600 transition-colors focus:outline-none">
                        <span class="flex items-center gap-2"><i class="fa-solid fa-file-signature text-slate-400"></i> Permohonan Surat</span>
                        @if(isset($jumlahPermohonanBaru) && $jumlahPermohonanBaru > 0)
                            <span class="bg-amber-50 text-amber-600 py-0.5 px-2.5 rounded-full text-[10px] font-extrabold">{{ $jumlahPermohonanBaru }}</span>
                        @endif
                    </a>
                </div>
            </div>
        </div>

        {{-- Divider --}}
        <div class="h-6 w-px bg-slate-200"></div>

        {{-- User Menu --}}
        <div class="relative">
            <button id="userDropdownButton" data-dropdown-toggle="userDropdown" class="flex items-center gap-2.5 focus:outline-none p-1 rounded-full hover:bg-slate-50 transition-colors pr-3 border border-transparent hover:border-slate-200">
                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-primary-600 to-primary-400 text-white shadow-sm flex items-center justify-center font-bold text-sm">
                    {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                </div>
                <p class="hidden md:block text-sm font-semibold text-slate-700 tracking-tight">{{ explode(' ', $user->name ?? 'Admin')[0] }}</p>
                <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 ml-1"></i>
            </button>

            {{-- Dropdown Profile --}}
            <div id="userDropdown" class="hidden z-50 w-56 bg-white border border-slate-200 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] rounded-2xl overflow-hidden origin-top-right">
                <div class="px-4 py-3 border-b border-slate-100">
                    <p class="text-sm font-bold text-slate-800 truncate">{{ $user->name ?? 'Administrator' }}</p>
                    <p class="text-xs text-slate-500 font-medium capitalize mt-0.5">{{ $user->role ?? 'Admin' }}</p>
                </div>
                <div class="py-1.5">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-primary-600 transition-colors focus:outline-none">
                        <i class="fa-regular fa-user text-slate-400"></i> Profil Saya
                    </a>
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-primary-600 transition-colors focus:outline-none">
                        <i class="fa-solid fa-gear text-slate-400"></i> Pengaturan
                    </a>
                </div>
                <div class="border-t border-slate-100"></div>
                <div class="py-1.5">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 transition-colors text-left focus:outline-none">
                            <i class="fa-solid fa-right-from-bracket text-red-400"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</header>