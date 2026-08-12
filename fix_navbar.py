with open('resources/views/components/public/navbar.blade.php', 'r') as f:
    content = f.read()

desktop_login = """                <a href="{{ route('login') }}"
                   class="hidden lg:inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold
                          transition-all duration-200 active:scale-95
                          focus:outline-none bg-primary text-white hover:bg-primary-dark shadow-md">
                    <i class="fa-solid fa-arrow-right"></i>
                    Masuk
                </a>"""

desktop_auth = """                @auth
                    <a href="{{ route('dashboard') }}"
                       class="hidden lg:inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold
                              transition-all duration-200 active:scale-95
                              focus:outline-none bg-emerald-600 text-white hover:bg-emerald-700 shadow-md">
                        <i class="fa-solid fa-gauge"></i>
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="hidden lg:inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold
                              transition-all duration-200 active:scale-95
                              focus:outline-none bg-primary text-white hover:bg-primary-dark shadow-md">
                        <i class="fa-solid fa-arrow-right"></i>
                        Masuk
                    </a>
                @endauth"""

mobile_login = """                <a href="{{ route('login') }}"
                   class="btn-primary w-full justify-center py-3 rounded-xl">
                    <i class="fa-solid fa-arrow-right"></i>
                    Masuk sebagai Admin / Operator
                </a>"""

mobile_auth = """                @auth
                    <a href="{{ route('dashboard') }}"
                       class="btn-primary !bg-emerald-600 hover:!bg-emerald-700 w-full justify-center py-3 rounded-xl">
                        <i class="fa-solid fa-gauge"></i>
                        Ke Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="btn-primary w-full justify-center py-3 rounded-xl">
                        <i class="fa-solid fa-arrow-right"></i>
                        Masuk sebagai Admin / Operator
                    </a>
                @endauth"""

content = content.replace(desktop_login, desktop_auth)
content = content.replace(mobile_login, mobile_auth)

with open('resources/views/components/public/navbar.blade.php', 'w') as f:
    f.write(content)
