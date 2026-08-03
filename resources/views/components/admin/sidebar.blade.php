<aside class="sidebar">


{{-- =========================
        MENU
========================== --}}
<nav class="sidebar-menu">



{{-- DASHBOARD --}}
<div class="menu-group">

    <div class="menu-title">
        Dashboard
    </div>


    <a href="{{ route('admin.dashboard') }}"
       class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

        <i class="bi bi-grid-fill"></i>

        <span>
            Dashboard
        </span>

    </a>


</div>







{{-- KEPENDUDUKAN --}}
<div class="menu-group">


    <div class="menu-title">
        Kependudukan
    </div>



    <a href="{{ route('admin.penduduk.index') }}"
       class="{{ request()->routeIs('admin.penduduk.*') ? 'active' : '' }}">

        <i class="bi bi-people-fill"></i>

        <span>
            Data Penduduk
        </span>

    </a>





    <a href="{{ route('admin.kartu-keluarga.index') }}"
       class="{{ request()->routeIs('admin.kartu-keluarga.*') ? 'active' : '' }}">

        <i class="bi bi-house-door-fill"></i>

        <span>
            Kartu Keluarga
        </span>

    </a>





    <a href="{{ route('admin.perangkat.index') }}"
       class="{{ request()->routeIs('admin.perangkat.*') ? 'active' : '' }}">

        <i class="bi bi-person-workspace"></i>

        <span>
            Perangkat
        </span>

    </a>


</div>







{{-- PELAYANAN --}}
<div class="menu-group">


    <div class="menu-title">
        Pelayanan
    </div>




    <a href="{{ route('admin.permohonan-surat.index') }}"
       class="{{ request()->routeIs('admin.permohonan-surat.*') ? 'active' : '' }}">

        <i class="bi bi-envelope-paper-fill"></i>

        <span>
            Persuratan
        </span>

    </a>
    
<a href="{{ route('admin.pengaduan.index') }}"
   class="{{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}">

    <i class="bi bi-chat-left-dots-fill"></i>

    <span>
        Pengaduan
    </span>

</a>




    <a href="{{ route('admin.riwayat-pelayanan.index') }}"
       class="{{ request()->routeIs('admin.riwayat-pelayanan.*') ? 'active' : '' }}">


        <i class="bi bi-clock-history"></i>

        <span>
            History Pelayanan
        </span>


    </a>



</div>







{{-- MASTER DATA --}}
<div class="menu-group">


    <div class="menu-title">
        Master Data
    </div>




    <a href="{{ route('admin.lingkungan.index') }}"
       class="{{ request()->routeIs('admin.lingkungan.*') ? 'active' : '' }}">


        <i class="bi bi-geo-alt-fill"></i>

        <span>
            Lingkungan
        </span>


    </a>





    <a href="{{ route('admin.jabatan.index') }}"
       class="{{ request()->routeIs('admin.jabatan.*') ? 'active' : '' }}">


        <i class="bi bi-person-badge-fill"></i>

        <span>
            Jabatan
        </span>


    </a>





    <a href="{{ route('admin.jenis-surat.index') }}"
       class="{{ request()->routeIs('admin.jenis-surat.*') ? 'active' : '' }}">


        <i class="bi bi-file-earmark-text-fill"></i>

        <span>
            Jenis Persuratan
        </span>


    </a>



</div>








{{-- WEBSITE --}}
<div class="menu-group">


    <div class="menu-title">
        Website
    </div>





    <a href="{{ route('admin.website.berita.index') }}"
       class="{{ request()->routeIs('admin.website.berita.*') ? 'active' : '' }}">


        <i class="bi bi-newspaper"></i>

        <span>
            Berita
        </span>


    </a>





    
        <a href="{{ route('admin.website.pengumuman.index') }}"
   class="{{ request()->routeIs('admin.website.pengumuman.*') ? 'active' : '' }}">

    <i class="bi bi-megaphone-fill"></i>

    <span>
        Pengumuman
    </span>

</a>




    <a href="{{ route('admin.website.agenda.index') }}"
       class="{{ request()->routeIs('admin.website.agenda.*') ? 'active' : '' }}">


        <i class="bi bi-calendar-event-fill"></i>

        <span>
            Agenda
        </span>


    </a>






    <a href="{{ route('admin.website.galeri.index') }}"
   class="{{ request()->routeIs('admin.website.galeri.*') ? 'active' : '' }}">

    <i class="bi bi-images"></i>

    <span>
        Galeri
    </span>

</a>


<a href="{{ route('admin.website.halaman.index') }}"
   class="{{ request()->routeIs('admin.website.halaman.*') ? 'active' : '' }}">

    <i class="bi bi-file-earmark-text-fill"></i>

    <span>
        Halaman
    </span>

</a>



</div>






{{-- LAPORAN --}}
<div class="menu-group">

    <div class="menu-title">
        Laporan
    </div>

    <a href="{{ route('admin.laporan.index') }}"
       class="{{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">

        <i class="bi bi-bar-chart-line-fill"></i>

        <span>
            Menu Laporan
        </span>

    </a>

</div>








{{-- PENGATURAN --}}
<div class="menu-group">


    <div class="menu-title">
        Pengaturan
    </div>




    <a href="{{ route('admin.website.pengaturan.index') }}"
       class="{{ request()->routeIs('admin.website.pengaturan.*') ? 'active' : '' }}">


        <i class="bi bi-building"></i>

        <span>
            Setting Website
        </span>


    </a>





    <a href="#">

        <i class="bi bi-people-fill"></i>

        <span>
            Manajemen User
        </span>


    </a>





    <a href="#">

        <i class="bi bi-shield-lock-fill"></i>

        <span>
            Hak Akses
        </span>


    </a>



</div>





</nav>







{{-- FOOTER --}}
<div class="sidebar-footer">


    <div class="system-status">

        <span class="status-dot"></span>

        <span>
            Sistem Berjalan Normal
        </span>

    </div>




    <form
    method="POST"
    action="{{ route('logout') }}"
    class="mt-3">

    @csrf

    <button
        type="submit"
        class="sidebar-logout">

        <i class="bi bi-box-arrow-right"></i>

        <span>Keluar</span>

    </button>

</form>





    <small class="copyright">

        SiPBongki v2.0

        <br>

        © {{ date('Y') }} Kelurahan Bongki

    </small>


</div>



</aside>