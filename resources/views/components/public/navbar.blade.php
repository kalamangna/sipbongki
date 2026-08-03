<nav class="navbar navbar-expand-lg navbar-public fixed-top">

    <div class="container">


        <a href="{{ url('/') }}"
           class="navbar-brand d-flex align-items-center">


            {{-- LOGO WEBSITE --}}

            @if(isset($website) && $website?->logo)


                <img
                    src="{{ asset('storage/'.$website->logo) }}"
                    alt="Logo {{ $website->nama_kelurahan ?? 'Kelurahan Bongki' }}"
                    class="navbar-logo">


            @else


                <img
                    src="{{ asset('images/logo/logo.png') }}"
                    alt="Logo Kelurahan Bongki"
                    class="navbar-logo">


            @endif







            <div class="ms-">


               <div class="brand-title">

    {{ 
        $website?->nama_website 
        ?? 
        'SIP Bongki'
    }}

</div>




                <small class="brand-subtitle">

    {{ 
        $website?->nama_kelurahan 
        ?? 
        'Kelurahan Bongki'
    }}

</small>


            </div>



        </a>


        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarPublic">


            <span class="navbar-toggler-icon"></span>


        </button>








        <div
    class="collapse navbar-collapse justify-content-end"
    id="navbarPublic">




<ul class="navbar-nav">

    <li class="nav-item">
        <a class="nav-link active" href="{{ url('/') }}">
            Beranda
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/#profil') }}">
            Profil
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/#struktur-organisasi') }}">
            Organisasi
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/#layanan') }}">
            Layanan
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/#berita') }}">
            Berita
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/#galeri') }}">
            Galeri
        </a>
    </li>

    {{-- Menu Baru --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pengaduan') }}">
            Pengaduan
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/#kontak') }}">
            Kontak
        </a>
    </li>

</ul>
            

              








            <a
    href="{{ route('login') }}"
    class="btn btn-primary px-4 rounded-pill ms-4">

    <i class="bi bi-box-arrow-in-right"></i>

    Masuk

</a>





        </div>


    </div>


</nav>