<aside class="sidebar">

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

                <i class="fa-solid fa-gauge-high"></i>

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

                <i class="fa-solid fa-users"></i>

                <span>Data Penduduk</span>

            </a>

            <a href="{{ route('operator.kartu-keluarga.index') }}"
               class="{{ request()->routeIs('operator.kartu-keluarga.*') ? 'active' : '' }}">

                <i class="fa-solid fa-house"></i>

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

                <i class="fa-solid fa-envelope-open-text"></i>

                <span>Permohonan Surat</span>

            </a>

            <a href="{{ route('operator.riwayat-pelayanan.index') }}"
               class="{{ request()->routeIs('operator.riwayat-pelayanan.*') ? 'active' : '' }}">

                <i class="fa-solid fa-clock-rotate-left"></i>

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

        <i class="fa-solid fa-users"></i>

        <span>Laporan Penduduk</span>

    </a>

    <a href="{{ route('operator.laporan.kartu-keluarga') }}"
       class="{{ request()->routeIs('operator.laporan.kartu-keluarga') ? 'active' : '' }}">

        <i class="fa-solid fa-house"></i>

        <span>Laporan KK</span>

    </a>

    <a href="{{ route('operator.laporan.persuratan') }}"
       class="{{ request()->routeIs('operator.laporan.persuratan') ? 'active' : '' }}">

        <i class="fa-solid fa-file-lines"></i>

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

                <i class="fa-solid fa-circle-user"></i>

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

                <i class="fa-solid fa-right-from-bracket"></i>

                <span>Keluar</span>

            </button>

        </form>

        <small class="copyright">

            SiPBongki v2.0

            <br>

            Operator Pelayanan

            <br>

            © {{ date('Y') }} Kelurahan Bongki

        </small>

    </div>

</aside>