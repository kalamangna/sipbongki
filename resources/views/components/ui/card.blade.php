@props([
    'title' => null,
    'subtitle' => null,
    'icon' => null,
    'headerAction' => null,
    'footer' => null,
    'variant' => 'default',
])

@php

$headerClass = match($variant){

    'primary' => 'bg-primary text-white',

    'success' => 'bg-success text-white',

    'warning' => 'bg-warning text-dark',

    'danger'  => 'bg-danger text-white',

    'info'    => 'bg-info text-white',

    default   => 'bg-white',

};

@endphp

<div {{ $attributes->class('card shadow-sm border-0 h-100') }}>

    @if($title || $headerAction)

    <div class="card-header {{ $headerClass }}">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                @if($title)

                    <h5 class="mb-1">

                        @if($icon)

                            <i class="fa-solid {{ $icon }} me-2"></i>

                        @endif

                        {{ $title }}

                    </h5>

                @endif

                @if($subtitle)

                    <small class="{{ $variant=='default' ? 'text-muted' : 'text-white-50' }}">

                        {{ $subtitle }}

                    </small>

                @endif

            </div>

            @if($headerAction)

                {{ $headerAction }}

            @endif

        </div>

    </div>

    @endif

    <div class="card-body">

        {{ $slot }}

    </div>

    @isset($footer)

        <div class="card-footer bg-white">

            {{ $footer }}

        </div>

    @endisset

</div>