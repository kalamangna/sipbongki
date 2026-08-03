@extends('layouts.auth')

@section('title', 'Verifikasi Email')

@section('content')

<h4 class="text-center fw-bold mb-3">

    Verifikasi Email

</h4>

@if (session('status') == 'verification-link-sent')

<div class="alert alert-success">

    Link verifikasi baru telah berhasil dikirim ke alamat email Anda.

</div>

@endif

<p class="text-muted text-center mb-4">

    Terima kasih telah mendaftar.

    Sebelum melanjutkan, silakan periksa email Anda dan klik tautan verifikasi yang telah dikirim.

    Jika belum menerima email, Anda dapat mengirim ulang melalui tombol di bawah.

</p>

<form method="POST"
      action="{{ route('verification.send') }}">

    @csrf

    <div class="d-grid mb-3">

        <button
            type="submit"
            class="btn btn-primary">

            <i class="fa-solid fa-envelope-circle-check me-2"></i>

            Kirim Ulang Email Verifikasi

        </button>

    </div>

</form>

<form method="POST"
      action="{{ route('logout') }}">

    @csrf

    <div class="d-grid">

        <button
            type="submit"
            class="btn btn-outline-secondary">

            <i class="fa-solid fa-right-from-bracket me-2"></i>

            Keluar

        </button>

    </div>

</form>

@endsection