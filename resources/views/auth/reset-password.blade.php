@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')

<h4 class="text-center fw-bold mb-3">

    Reset Password

</h4>

<p class="text-muted text-center mb-4">

    Masukkan email dan password baru Anda.

</p>

<form method="POST"
      action="{{ route('password.store') }}">

    @csrf

    <input
        type="hidden"
        name="token"
        value="{{ request()->route('token') }}">

    <div class="mb-3">

        <label class="form-label">

            Email

        </label>

        <input
            type="email"
            name="email"
            value="{{ old('email', request('email')) }}"
            class="form-control @error('email') is-invalid @enderror"
            required>

        @error('email')

            <div class="invalid-feedback">

                {{ $message }}

            </div>

        @enderror

    </div>

    <div class="mb-3">

        <label class="form-label">

            Password Baru

        </label>

        <input
            type="password"
            name="password"
            class="form-control @error('password') is-invalid @enderror"
            required>

        @error('password')

            <div class="invalid-feedback">

                {{ $message }}

            </div>

        @enderror

    </div>

    <div class="mb-4">

        <label class="form-label">

            Konfirmasi Password

        </label>

        <input
            type="password"
            name="password_confirmation"
            class="form-control"
            required>

    </div>

    <div class="d-grid">

        <button
            type="submit"
            class="btn btn-primary">

            <i class="fa-solid fa-key me-2"></i>

            Simpan Password Baru

        </button>

    </div>

</form>

@endsection