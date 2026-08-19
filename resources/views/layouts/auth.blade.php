<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Login - SIP Bongki')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <meta property="og:image" content="{{ asset('images/meta.png') }}">
    <meta name="twitter:image" content="{{ asset('images/meta.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Alpine CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Anti-FOUC Dark Mode Init -->
    <script>
        if (localStorage.theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full flex flex-col justify-center items-center p-4 sm:p-6 bg-slate-50 font-sans antialiased text-slate-800 relative dark:bg-slate-950 dark:text-slate-100">

    {{-- Top Action Bar --}}
    <div class="fixed top-4 inset-x-4 sm:top-6 sm:inset-x-8 flex items-center justify-between z-20 pointer-events-none"
         x-data="{
             darkMode: localStorage.theme === 'dark',
             toggleTheme() {
                 this.darkMode = !this.darkMode;
                 if (this.darkMode) {
                     document.documentElement.classList.add('dark');
                     localStorage.theme = 'dark';
                 } else {
                     document.documentElement.classList.remove('dark');
                     localStorage.theme = 'light';
                 }
             }
         }">
        <a href="{{ url('/') }}"
           class="pointer-events-auto inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-white/90 border border-slate-200/80 text-slate-700 hover:text-primary hover:border-slate-300 shadow-sm backdrop-blur-md transition-all active:scale-95 dark:bg-slate-900/90 dark:border-slate-800 dark:text-slate-300 dark:hover:text-primary-400 dark:hover:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary">
            <i class="fa-solid fa-arrow-left text-xs"></i>
            <span>Beranda</span>
        </a>

        <button type="button"
                @click="toggleTheme()"
                class="pointer-events-auto w-9 h-9 flex items-center justify-center rounded-full bg-white/90 border border-slate-200/80 text-slate-500 hover:text-amber-500 hover:border-slate-300 shadow-sm backdrop-blur-md transition-all focus:outline-none cursor-pointer active:scale-95 dark:bg-slate-900/90 dark:border-slate-800 dark:text-slate-400 dark:hover:text-amber-400 dark:hover:border-slate-700"
                :title="darkMode ? 'Beralih ke Mode Terang' : 'Beralih ke Mode Gelap'"
                aria-label="Toggle dark mode">
            <i class="fa-solid fa-moon text-sm" x-show="!darkMode"></i>
            <i class="fa-solid fa-sun text-sm text-amber-400" x-show="darkMode" style="display: none;"></i>
        </button>
    </div>

    <div class="w-full max-w-md relative z-10 my-auto py-12">
        @yield('content')
    </div>

</body>
</html>