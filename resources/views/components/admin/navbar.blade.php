@php
    $user = auth()->user();
@endphp

<header class="navbar navbar-expand bg-white border-bottom shadow-sm px-4 py-2.5 d-flex align-items-center justify-content-between">

    {{-- LEFT: HEADING --}}
    <div>
        <h4 class="fw-bold mb-0 text-dark">
            @yield('title', 'Dashboard')
        </h4>
        <small class="text-muted">
            @yield('subtitle', 'Sistem Informasi dan Pelayanan Kelurahan Bongki')
        </small>
    </div>

    {{-- RIGHT: NOTIFICATION & USER PROFILE --}}
    <div class="d-flex align-items-center gap-3">

        {{-- Notification Bell --}}
        <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-light position-relative border-0 rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" title="Pengaduan Baru">
            <i class="fa-regular fa-bell text-secondary fs-5"></i>
            @if(isset($jumlahPengaduanBaru) && $jumlahPengaduanBaru > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px;">
                    {{ $jumlahPengaduanBaru }}
                </span>
            @endif
        </a>

        {{-- User Dropdown --}}
        <div class="dropdown">
            <button class="btn btn-light d-flex align-items-center gap-2 border-0 bg-transparent py-1 px-2 rounded-3 shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 36px; height: 36px; font-size: 14px;">
                    {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                </div>
                <div class="text-start d-none d-md-block">
                    <div class="fw-bold small text-dark leading-tight">{{ $user->name ?? 'Administrator' }}</div>
                    <small class="text-muted d-block" style="font-size: 11px;">Administrator</small>
                </div>
                <i class="fa-solid fa-chevron-down text-muted small ms-1"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2 rounded-3">
                <li><h6 class="dropdown-header">Akun Administrator</h6></li>
                <li><a class="dropdown-item d-flex align-items-center gap-2 small" href="{{ route('profile.edit') }}"><i class="fa-regular fa-user text-muted"></i> Profil Saya</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item d-flex align-items-center gap-2 small text-danger">
                            <i class="fa-solid fa-right-from-bracket"></i> Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </div>

</header>