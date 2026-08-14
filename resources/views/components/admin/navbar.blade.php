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
            <button id="userDropdownButton" data-dropdown-toggle="userDropdown" class="flex items-center gap-2.5 focus:outline-none p-1 rounded-full hover:bg-slate-50 transition-colors pr-3 border border-transparent hover:border-slate-200 cursor-pointer">
                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-primary-600 to-primary-400 text-white shadow-sm flex items-center justify-center font-bold text-sm shrink-0">
                    {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                </div>
                <p class="hidden md:block text-sm font-semibold text-slate-700 tracking-tight max-w-[220px] truncate">{{ $user->name ?? 'Administrator' }}</p>
                <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 ml-1"></i>
            </button>

            {{-- Dropdown Profile --}}
            <div id="userDropdown" class="hidden z-50 w-64 bg-white border border-slate-200 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] rounded-2xl overflow-hidden origin-top-right">
                <div class="px-4 py-3.5 border-b border-slate-100 bg-slate-50/50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-primary-100 text-primary-700 font-bold flex items-center justify-center text-base shrink-0 border border-primary-200 shadow-sm">
                            {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-bold text-slate-900 truncate leading-tight">{{ $user->name ?? 'Administrator' }}</p>
                            <p class="text-xs text-slate-500 font-mono truncate mt-0.5">&#64;{{ $user->username ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="mt-2.5">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-200/70 text-slate-700 tracking-wide uppercase">
                            {{ $user->role ?? 'Admin' }}
                        </span>
                    </div>
                </div>

                <div class="p-1.5 space-y-0.5">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-primary-600 rounded-xl transition-colors focus:outline-none">
                        <i class="fa-regular fa-user text-slate-400 text-xs w-4 text-center"></i> Profil Saya
                    </a>

                    @if($user && $user->role === 'admin')
                    <a href="{{ route('admin.website.pengaturan.index') }}" class="flex items-center gap-2.5 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-primary-600 rounded-xl transition-colors focus:outline-none">
                        <i class="fa-solid fa-gear text-slate-400 text-xs w-4 text-center"></i> Pengaturan Website
                    </a>
                    @endif

                    <a href="{{ url('/') }}" target="_blank" class="flex items-center gap-2.5 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-primary-600 rounded-xl transition-colors focus:outline-none">
                        <i class="fa-solid fa-arrow-up-right-from-square text-slate-400 text-xs w-4 text-center"></i> Lihat Website
                    </a>
                </div>

                <div class="border-t border-slate-100 p-1.5">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 text-sm font-medium text-rose-600 hover:bg-rose-50 hover:text-rose-700 rounded-xl transition-colors text-left focus:outline-none cursor-pointer">
                            <i class="fa-solid fa-right-from-bracket text-xs text-rose-400 w-4 text-center"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</header>