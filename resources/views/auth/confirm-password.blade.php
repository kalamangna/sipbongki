@extends('layouts.auth')

@section('title', 'Konfirmasi Password')

@section('content')

<h4 class="text-center fw-bold mb-3">

    Konfirmasi Password

</h4>

<p class="text-muted text-center mb-4">

    Demi keamanan, silakan masukkan password Anda untuk melanjutkan.

</p>

<form method="POST"
      action="{{ route('password.confirm') }}">

    @csrf

    <div class="mb-3">

        <label class="form-label">

            Password

        </label>

        <input
            type="password"
            name="password"
            class="form-control @error('password') is-invalid @enderror"
            required
            autofocus>

        @error('password')

            <div class="invalid-feedback">

                {{ $message }}

            </div>

        @enderror

    </div>

    <div class="d-grid">

        <button
            type="submit"
            class="btn btn-primary">

            <i class="fa-solid fa-shield-halved me-2"></i>

            Konfirmasi Password

        </button>

    </div>

</form>

@endsection