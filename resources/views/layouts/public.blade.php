<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- STATIC META --}}
    <meta name="author" content="Kelurahan Bongki">
    <meta name="robots" content="index, follow">
    <meta name="language" content="id">
    <meta name="geo.region" content="ID-SN">
    <meta name="geo.placename" content="Kelurahan Bongki, Kecamatan Sinjai Utara, Kabupaten Sinjai">
    <meta name="theme-color" content="#059669">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- DYNAMIC SEO META --}}
    <x-seo-meta />


    {{-- STRUCTURED DATA --}}
    <script type="application/ld+json">
    {
        "@@context":"https://schema.org",
        "@type":"GovernmentOrganization",
        "name":"Kelurahan Bongki",
        "url":"{{ url('/') }}",
        "logo":"{{ asset('images/logo.png') }}",
        "description":"Website resmi Kelurahan Bongki yang menyediakan layanan publik digital, statistik kependudukan, berita, agenda, pengumuman, galeri, dan informasi pemerintahan.",
        "address":{
            "@type":"PostalAddress",
            "addressLocality":"Sinjai Utara",
            "addressRegion":"Sulawesi Selatan",
            "addressCountry":"ID"
        }
    }
    </script>
    @stack('schema')


    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Alpine CDN --}}
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    {{-- ApexCharts CDN --}}
    <script defer src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Anti-FOUC Dark Mode Init -->
    <script>
        if (localStorage.theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    {{-- VITE — Tailwind (Frontend & Backend) --}}
    @vite([
        'resources/css/frontend.css',
        'resources/js/app.js'
    ])

    {{-- PAGE STYLE --}}
    @stack('styles')

</head>

<body class="antialiased bg-white text-slate-800 dark:bg-slate-950 dark:text-slate-100">

    {{-- SCROLL PROGRESS --}}
    <div id="scrollProgress" class="fixed top-0 left-0 h-1 bg-primary z-[9998] transition-all duration-100" style="width:0%"></div>

    {{-- BACK TO TOP --}}
    <button id="backToTop"
            aria-label="Kembali ke atas"
            class="fixed bottom-6 right-6 z-50 h-11 w-11 rounded-full bg-primary text-white flex items-center justify-center shadow-lg opacity-0 pointer-events-none transition-all duration-300 hover:bg-primary-dark hover:scale-110 focus:outline-none focus:ring-2 focus:ring-primary-ring">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    {{-- PRELOADER --}}
    <div id="preloader" class="fixed inset-0 z-[9999] flex items-center justify-center bg-white dark:bg-slate-950 transition-opacity duration-500">
        <div class="text-center">
            <div class="w-12 h-12 rounded-full border-4 border-primary-light border-t-primary mx-auto mb-3 animate-spin"></div>
            <p class="text-sm text-slate-500 dark:text-slate-400">Memuat SIP Bongki...</p>
        </div>
    </div>

    {{-- NAVBAR --}}
    <x-public.navbar />

    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <x-public.footer />

    {{-- PAGE SCRIPT --}}
    @stack('scripts')

    {{-- Preloader & Scroll scripts --}}
    <script>
        // Preloader
        window.addEventListener('load', () => {
            const pre = document.getElementById('preloader');
            pre.style.opacity = '0';
            setTimeout(() => pre.style.display = 'none', 500);
        });

        // Scroll progress + back to top
        const progress = document.getElementById('scrollProgress');
        const backTop  = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            const s  = document.documentElement;
            const pct = (s.scrollTop / (s.scrollHeight - s.clientHeight)) * 100;
            if (progress) progress.style.width = pct + '%';
            if (backTop) {
                if (window.scrollY > 300) {
                    backTop.classList.remove('opacity-0','pointer-events-none');
                    backTop.classList.add('opacity-100');
                } else {
                    backTop.classList.add('opacity-0','pointer-events-none');
                    backTop.classList.remove('opacity-100');
                }
            }
        });
        backTop?.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
    </script>

</body>

</html>