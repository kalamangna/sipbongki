<aside class="bg-dark text-white p-3 d-flex flex-column border-end border-secondary border-opacity-25" style="width: 260px; min-height: 100vh; background-color: #0f172a !important;">

    {{-- BRAND --}}
    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-2.5 mb-4 text-white text-decoration-none px-2 py-1">
        <img src="{{ asset('images/sinjai.png') }}" alt="Logo" class="img-fluid" style="height: 38px; width: 38px; object-fit: contain;">
        <div>
            <h6 class="fw-extrabold mb-0 tracking-tight text-white" style="letter-spacing: -0.3px;">SIP BONGKI</h6>
            <small class="text-success fw-semibold d-block" style="font-size: 10px; color: #34d399 !important;">ADMINISTRATOR PANEL</small>
        </div>
    </a>

    {{-- MENU NAV --}}
    <nav class="nav nav-pills flex-column mb-auto gap-1">

        <small class="text-uppercase text-muted fw-bold px-3 mb-1" style="font-size: 10px; letter-spacing: 0.8px;">Dashboard</small>
        <a href="{{ route('admin.dashboard') }}" class="nav-link d-flex align-items-center gap-2.5 py-2 px-3 rounded-3 small transition-all {{ request()->routeIs('admin.dashboard') ? 'active bg-success text-white fw-bold shadow-sm' : 'text-light text-opacity-75 hover:bg-secondary hover:bg-opacity-25' }}" style="{{ request()->routeIs('admin.dashboard') ? 'background-color: #059669 !important;' : '' }}">
            <i class="fa-solid fa-gauge-high me-1" style="width: 18px;"></i>
            <span>Dashboard</span>
        </a>

        <small class="text-uppercase text-muted fw-bold px-3 mt-3 mb-1" style="font-size: 10px; letter-spacing: 0.8px;">Kependudukan</small>
        <a href="{{ route('admin.penduduk.index') }}" class="nav-link d-flex align-items-center gap-2.5 py-2 px-3 rounded-3 small transition-all {{ request()->routeIs('admin.penduduk.*') ? 'active bg-success text-white fw-bold shadow-sm' : 'text-light text-opacity-75' }}" style="{{ request()->routeIs('admin.penduduk.*') ? 'background-color: #059669 !important;' : '' }}">
            <i class="fa-solid fa-users me-1" style="width: 18px;"></i>
            <span>Data Penduduk</span>
        </a>
        <a href="{{ route('admin.kartu-keluarga.index') }}" class="nav-link d-flex align-items-center gap-2.5 py-2 px-3 rounded-3 small transition-all {{ request()->routeIs('admin.kartu-keluarga.*') ? 'active bg-success text-white fw-bold shadow-sm' : 'text-light text-opacity-75' }}" style="{{ request()->routeIs('admin.kartu-keluarga.*') ? 'background-color: #059669 !important;' : '' }}">
            <i class="fa-solid fa-address-card me-1" style="width: 18px;"></i>
            <span>Kartu Keluarga</span>
        </a>
        <a href="{{ route('admin.perangkat.index') }}" class="nav-link d-flex align-items-center gap-2.5 py-2 px-3 rounded-3 small transition-all {{ request()->routeIs('admin.perangkat.*') ? 'active bg-success text-white fw-bold shadow-sm' : 'text-light text-opacity-75' }}" style="{{ request()->routeIs('admin.perangkat.*') ? 'background-color: #059669 !important;' : '' }}">
            <i class="fa-solid fa-user-tie me-1" style="width: 18px;"></i>
            <span>Perangkat Kelurahan</span>
        </a>

        <small class="text-uppercase text-muted fw-bold px-3 mt-3 mb-1" style="font-size: 10px; letter-spacing: 0.8px;">Pelayanan</small>
        <a href="{{ route('admin.permohonan-surat.index') }}" class="nav-link d-flex align-items-center gap-2.5 py-2 px-3 rounded-3 small transition-all {{ request()->routeIs('admin.permohonan-surat.*') ? 'active bg-success text-white fw-bold shadow-sm' : 'text-light text-opacity-75' }}" style="{{ request()->routeIs('admin.permohonan-surat.*') ? 'background-color: #059669 !important;' : '' }}">
            <i class="fa-solid fa-envelope-open-text me-1" style="width: 18px;"></i>
            <span>Persuratan</span>
        </a>
        <a href="{{ route('admin.pengaduan.index') }}" class="nav-link d-flex align-items-center gap-2.5 py-2 px-3 rounded-3 small transition-all {{ request()->routeIs('admin.pengaduan.*') ? 'active bg-success text-white fw-bold shadow-sm' : 'text-light text-opacity-75' }}" style="{{ request()->routeIs('admin.pengaduan.*') ? 'background-color: #059669 !important;' : '' }}">
            <i class="fa-solid fa-comments me-1" style="width: 18px;"></i>
            <span>Pengaduan</span>
        </a>
        <a href="{{ route('admin.riwayat-pelayanan.index') }}" class="nav-link d-flex align-items-center gap-2.5 py-2 px-3 rounded-3 small transition-all {{ request()->routeIs('admin.riwayat-pelayanan.*') ? 'active bg-success text-white fw-bold shadow-sm' : 'text-light text-opacity-75' }}" style="{{ request()->routeIs('admin.riwayat-pelayanan.*') ? 'background-color: #059669 !important;' : '' }}">
            <i class="fa-solid fa-clock-rotate-left me-1" style="width: 18px;"></i>
            <span>Riwayat Pelayanan</span>
        </a>

        <small class="text-uppercase text-muted fw-bold px-3 mt-3 mb-1" style="font-size: 10px; letter-spacing: 0.8px;">Master Data</small>
        <a href="{{ route('admin.lingkungan.index') }}" class="nav-link d-flex align-items-center gap-2.5 py-2 px-3 rounded-3 small transition-all {{ request()->routeIs('admin.lingkungan.*') ? 'active bg-success text-white fw-bold shadow-sm' : 'text-light text-opacity-75' }}" style="{{ request()->routeIs('admin.lingkungan.*') ? 'background-color: #059669 !important;' : '' }}">
            <i class="fa-solid fa-location-dot me-1" style="width: 18px;"></i>
            <span>Lingkungan</span>
        </a>
        <a href="{{ route('admin.jabatan.index') }}" class="nav-link d-flex align-items-center gap-2.5 py-2 px-3 rounded-3 small transition-all {{ request()->routeIs('admin.jabatan.*') ? 'active bg-success text-white fw-bold shadow-sm' : 'text-light text-opacity-75' }}" style="{{ request()->routeIs('admin.jabatan.*') ? 'background-color: #059669 !important;' : '' }}">
            <i class="fa-solid fa-id-badge me-1" style="width: 18px;"></i>
            <span>Jabatan</span>
        </a>
        <a href="{{ route('admin.jenis-surat.index') }}" class="nav-link d-flex align-items-center gap-2.5 py-2 px-3 rounded-3 small transition-all {{ request()->routeIs('admin.jenis-surat.*') ? 'active bg-success text-white fw-bold shadow-sm' : 'text-light text-opacity-75' }}" style="{{ request()->routeIs('admin.jenis-surat.*') ? 'background-color: #059669 !important;' : '' }}">
            <i class="fa-solid fa-file-lines me-1" style="width: 18px;"></i>
            <span>Jenis Surat</span>
        </a>

        <small class="text-uppercase text-muted fw-bold px-3 mt-3 mb-1" style="font-size: 10px; letter-spacing: 0.8px;">CMS Website</small>
        <a href="{{ route('admin.website.berita.index') }}" class="nav-link d-flex align-items-center gap-2.5 py-2 px-3 rounded-3 small transition-all {{ request()->routeIs('admin.website.berita.*') ? 'active bg-success text-white fw-bold shadow-sm' : 'text-light text-opacity-75' }}" style="{{ request()->routeIs('admin.website.berita.*') ? 'background-color: #059669 !important;' : '' }}">
            <i class="fa-solid fa-newspaper me-1" style="width: 18px;"></i>
            <span>Berita</span>
        </a>
        <a href="{{ route('admin.website.pengumuman.index') }}" class="nav-link d-flex align-items-center gap-2.5 py-2 px-3 rounded-3 small transition-all {{ request()->routeIs('admin.website.pengumuman.*') ? 'active bg-success text-white fw-bold shadow-sm' : 'text-light text-opacity-75' }}" style="{{ request()->routeIs('admin.website.pengumuman.*') ? 'background-color: #059669 !important;' : '' }}">
            <i class="fa-solid fa-bullhorn me-1" style="width: 18px;"></i>
            <span>Pengumuman</span>
        </a>
        <a href="{{ route('admin.website.agenda.index') }}" class="nav-link d-flex align-items-center gap-2.5 py-2 px-3 rounded-3 small transition-all {{ request()->routeIs('admin.website.agenda.*') ? 'active bg-success text-white fw-bold shadow-sm' : 'text-light text-opacity-75' }}" style="{{ request()->routeIs('admin.website.agenda.*') ? 'background-color: #059669 !important;' : '' }}">
            <i class="fa-solid fa-calendar-days me-1" style="width: 18px;"></i>
            <span>Agenda</span>
        </a>
        <a href="{{ route('admin.website.galeri.index') }}" class="nav-link d-flex align-items-center gap-2.5 py-2 px-3 rounded-3 small transition-all {{ request()->routeIs('admin.website.galeri.*') ? 'active bg-success text-white fw-bold shadow-sm' : 'text-light text-opacity-75' }}" style="{{ request()->routeIs('admin.website.galeri.*') ? 'background-color: #059669 !important;' : '' }}">
            <i class="fa-solid fa-images me-1" style="width: 18px;"></i>
            <span>Galeri</span>
        </a>
        <a href="{{ route('admin.website.halaman.index') }}" class="nav-link d-flex align-items-center gap-2.5 py-2 px-3 rounded-3 small transition-all {{ request()->routeIs('admin.website.halaman.*') ? 'active bg-success text-white fw-bold shadow-sm' : 'text-light text-opacity-75' }}" style="{{ request()->routeIs('admin.website.halaman.*') ? 'background-color: #059669 !important;' : '' }}">
            <i class="fa-solid fa-file-alt me-1" style="width: 18px;"></i>
            <span>Halaman</span>
        </a>

        <small class="text-uppercase text-muted fw-bold px-3 mt-3 mb-1" style="font-size: 10px; letter-spacing: 0.8px;">Laporan & Setting</small>
        <a href="{{ route('admin.laporan.index') }}" class="nav-link d-flex align-items-center gap-2.5 py-2 px-3 rounded-3 small transition-all {{ request()->routeIs('admin.laporan.*') ? 'active bg-success text-white fw-bold shadow-sm' : 'text-light text-opacity-75' }}" style="{{ request()->routeIs('admin.laporan.*') ? 'background-color: #059669 !important;' : '' }}">
            <i class="fa-solid fa-chart-bar me-1" style="width: 18px;"></i>
            <span>Laporan</span>
        </a>
        <a href="{{ route('admin.website.pengaturan.index') }}" class="nav-link d-flex align-items-center gap-2.5 py-2 px-3 rounded-3 small transition-all {{ request()->routeIs('admin.website.pengaturan.*') ? 'active bg-success text-white fw-bold shadow-sm' : 'text-light text-opacity-75' }}" style="{{ request()->routeIs('admin.website.pengaturan.*') ? 'background-color: #059669 !important;' : '' }}">
            <i class="fa-solid fa-building me-1" style="width: 18px;"></i>
            <span>Setting Website</span>
        </a>

    </nav>

    {{-- FOOTER / LOGOUT --}}
    <div class="pt-3 border-top border-secondary border-opacity-25 mt-3">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2 py-2 rounded-3 small">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Keluar Sesi</span>
            </button>
        </form>
    </div>

</aside>