@extends('layouts.auth')

@section('title', 'Lupa Password')

@section('content')

<h4 class="text-center fw-bold mb-3">

    Lupa Password

</h4>

<p class="text-muted text-center mb-4">

    Masukkan alamat email Anda.
    Kami akan mengirimkan tautan untuk mengatur ulang password.

</p>

@if (session('status'))

    <div class="alert alert-success">

        {{ session('status') }}

    </div>

@endif

<form method="POST"
      action="{{ route('password.email') }}">

    @csrf

    <div class="mb-3">

        <label
            for="email"
            class="form-label">

            Email

        </label>

        <input
            id="email"
            type="email"
            name="email"
            value="{{ old('email') }}"
            class="form-control @error('email') is-invalid @enderror"
            placeholder="Masukkan email"
            required
            autofocus>

        @error('email')

            <div class="invalid-feedback">

                {{ $message }}

            </div>

        @enderror

    </div>

    <div class="d-grid">

        <button
            type="submit"
            class="btn btn-primary">

            <i class="bi bi-envelope-paper me-2"></i>

            Kirim Link Reset Password

        </button>

    </div>

    <div class="text-center mt-4">

        <a
            href="{{ route('login') }}"
            class="text-decoration-none">

            ← Kembali ke Login

        </a>

    </div>

</form>

@endsection