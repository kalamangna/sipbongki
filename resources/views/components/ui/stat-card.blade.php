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

<div class="card border-0 shadow-sm rounded-4 h-100">
    <div class="card-body p-4">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <small class="text-muted fw-semibold d-block mb-1 text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">{{ $title }}</small>
                <h3 class="fw-extrabold text-dark mb-0">{{ number_format($angka) }}</h3>
            </div>
            <div class="bg-{{ $color }} text-white rounded-4 p-3 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                <i class="fa-solid {{ $icon }} fs-4"></i>
            </div>
        </div>
    </div>
</div>