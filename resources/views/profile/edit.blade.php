@extends('layouts.admin')

@section('title', 'Profil Saya')

@section('content')
<div class="container-fluid">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <p class="page-description mb-1">
                Kelola akun, data profil, dan keamanan akses Anda.
            </p>
        </div>
        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2">
            <i class="fa-solid fa-circle-user me-2"></i>
            Akun Aktif
        </span>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center p-4">
                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 88px; height: 88px; font-size: 2rem; font-weight: 700;">
                        {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                    </div>

                    <h4 class="mb-1">{{ $user->name ?? 'Administrator' }}</h4>
                    <p class="text-muted mb-3">{{ $user->email ?? '-' }}</p>

                    <div class="d-grid gap-2">
                        <span class="badge bg-light text-dark border px-3 py-2">
                            <i class="fa-solid fa-shield-halved me-2"></i>
                            {{ ucfirst($user->role ?? 'admin') }}
                        </span>
                        <span class="badge bg-light text-dark border px-3 py-2">
                            <i class="fa-solid fa-clock me-2"></i>
                            Terakhir diperbarui
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card shadow-sm border-0 border-danger-subtle">
                <div class="card-body p-4">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
