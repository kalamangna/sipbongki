@props([
    'title',
    'value' => null,
    'total' => null,
    'icon',
    'color' => 'primary'
])

@php
    $angka = $value ?? $total ?? 0;
@endphp

<div class="stat-card">

    <div class="card-body">

        <div class="stat-content">

            <div>

                <small>{{ $title }}</small>

                <h2>{{ number_format($angka) }}</h2>

            </div>

            <div class="stat-icon bg-{{ $color }} text-white">

                <i class="fa-solid {{ $icon }}"></i>

            </div>

        </div>

    </div>

</div>