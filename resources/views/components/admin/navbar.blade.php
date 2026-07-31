@php
    $user = auth()->user();
@endphp

<header class="navbar-admin">

    {{-- ==========================================================
        LEFT
    ========================================================== --}}
    <div class="navbar-left">

        <div class="navbar-heading">

            <h1 class="navbar-title">
                @yield('title', 'Dashboard')
            </h1>

            <p class="navbar-subtitle">
                @yield('subtitle', 'Sistem Informasi & Pelayanan Kelurahan Bongki')
            </p>

        </div>

    </div>

    {{-- ==========================================================
        RIGHT
    ========================================================== --}}
    <div class="navbar-right">

        {{-- Notification --}}
        <button
            type="button"
            class="btn-icon"
            title="Notifikasi">

            <i class="fa-regular fa-bell"></i>

            <span class="notification-dot"></span>

        </button>

        {{-- Message --}}
        <button
            type="button"
            class="btn-icon"
            title="Pesan">

            <i class="fa-regular fa-envelope"></i>

        </button>

        {{-- User --}}
        <div class="dropdown">

            <button
                class="navbar-user"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false">

                <div class="navbar-avatar">

                    {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}

                </div>

                <div class="navbar-user-info">

                    <strong>
                        {{ $user->name ?? 'Administrator' }}
                    </strong>

                    <small>
                        Administrator
                    </small>

                </div>

                <i class="fa-solid fa-chevron-down navbar-chevron"></i>

            </button>

            <ul class="dropdown-menu dropdown-menu-end shadow border-0">

                <li class="dropdown-header">

                    <strong>
                        {{ $user->name ?? 'Administrator' }}
                    </strong>

                    <small class="d-block text-muted">
                        Administrator SIPBongki
                    </small>

                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>

                    <a
                        class="dropdown-item"
                        href="{{ route('profile.edit') }}">

                        <i class="fa-solid fa-user me-2"></i>

                        Profil Saya

                    </a>

                </li>

                <li>

                    <a
                        class="dropdown-item"
                        href="#">

                        <i class="fa-solid fa-gear me-2"></i>

                        Pengaturan Akun

                    </a>

                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>

<form
    method="POST"
    action="{{ route('logout') }}">

    @csrf

    <button
        type="submit"
        class="dropdown-item text-danger">

        <i class="fa-solid fa-right-from-bracket me-2"></i>

        Keluar

    </button>

</form>                    

                </li>

            </ul>

        </div>

    </div>

</header>