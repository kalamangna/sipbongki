<aside class="sidebar">

    <button type="button"
            class="sidebar-toggle"
            aria-label="Sembunyikan sidebar"
            title="Sembunyikan sidebar">
        <i class="fa-solid fa-angles-left"></i>
    </button>

    <nav class="sidebar-menu">

        {{-- =========================
                DASHBOARD
        ========================== --}}
        <div class="menu-group">

            <div class="menu-title">
                Dashboard
            </div>

            <a href="{{ route('operator.dashboard') }}"
               class="{{ request()->routeIs('operator.dashboard') ? 'active' : '' }}">

                <i class="bi bi-grid-fill"></i>

                <span>Dashboard</span>

            </a>

        </div>



        {{-- =========================
                KEPENDUDUKAN
        ========================== --}}
        <div class="menu-group">

            <div class="menu-title">
                Kependudukan
            </div>

            <a href="{{ route('operator.penduduk.index') }}"
               class="{{ request()->routeIs('operator.penduduk.*') ? 'active' : '' }}">

                <i class="bi bi-people-fill"></i>

                <span>Data Penduduk</span>

            </a>

            <a href="{{ route('operator.kartu-keluarga.index') }}"
               class="{{ request()->routeIs('operator.kartu-keluarga.*') ? 'active' : '' }}">

                <i class="bi bi-house-door-fill"></i>

                <span>Kartu Keluarga</span>

            </a>

        </div>



        {{-- =========================
                PELAYANAN
        ========================== --}}
        <div class="menu-group">

            <div class="menu-title">
                Pelayanan
            </div>

            <a href="{{ route('operator.permohonan-surat.index') }}"
               class="{{ request()->routeIs('operator.permohonan-surat.*') ? 'active' : '' }}">

                <i class="bi bi-envelope-paper-fill"></i>

                <span>Permohonan Surat</span>

            </a>

            <a href="{{ route('operator.pengaduan.index') }}"
               class="{{ request()->routeIs('operator.pengaduan.*') ? 'active' : '' }}">

                <i class="bi bi-chat-left-dots-fill"></i>

                <span>Pengaduan</span>

            </a>

            <a href="{{ route('operator.riwayat-pelayanan.index') }}"
               class="{{ request()->routeIs('operator.riwayat-pelayanan.*') ? 'active' : '' }}">

                <i class="bi bi-clock-history"></i>

                <span>Riwayat Pelayanan</span>

            </a>

        </div>


{{-- =========================
        LAPORAN
========================== --}}
<div class="menu-group">

    <div class="menu-title">
        Laporan
    </div>

    <a href="{{ route('operator.laporan.penduduk') }}"
       class="{{ request()->routeIs('operator.laporan.penduduk') ? 'active' : '' }}">

        <i class="bi bi-people-fill"></i>

        <span>Laporan Penduduk</span>

    </a>

    <a href="{{ route('operator.laporan.kartu-keluarga') }}"
       class="{{ request()->routeIs('operator.laporan.kartu-keluarga') ? 'active' : '' }}">

        <i class="bi bi-house-door-fill"></i>

        <span>Laporan KK</span>

    </a>

    <a href="{{ route('operator.laporan.persuratan') }}"
       class="{{ request()->routeIs('operator.laporan.persuratan') ? 'active' : '' }}">

        <i class="bi bi-file-earmark-text-fill"></i>

        <span>Laporan Persuratan</span>

    </a>

</div>



        {{-- =========================
                AKUN
        ========================== --}}
        <div class="menu-group">

            <div class="menu-title">
                Akun
            </div>

            <a href="{{ route('profile.edit') }}">

                <i class="bi bi-person-circle"></i>

                <span>Profil Saya</span>

            </a>

        </div>

    </nav>



    {{-- =========================
            FOOTER SIDEBAR
    ========================== --}}
    <div class="sidebar-footer">

        <div class="system-status">

            <span class="status-dot"></span>

            <span>Sistem Berjalan Normal</span>

        </div>

        <form action="{{ route('logout') }}"
              method="POST"
              class="mt-3">

            @csrf

            <button type="submit"
                    class="sidebar-logout">

                <i class="bi bi-box-arrow-right"></i>

                <span>Keluar</span>

            </button>

        </form>

        <small class="copyright">

            SIP Bongki v2.0

            <br>

            Operator Pelayanan

            <br>

            © {{ date('Y') }} Kelurahan Bongki

        </small>

    </div>

</aside>