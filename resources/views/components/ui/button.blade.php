@props([
    'type' => 'primary',
    'href' => null,
    'icon' => null,
])

@if($href)

<a href="{{ $href }}" {{ $attributes->class(['btn','btn-'.$type]) }}>

    @if($icon)
        <i class="{{ $icon }} me-2"></i>
    @endif

    {{ $slot }}

</a>

@else

<button {{ $attributes->class(['btn','btn-'.$type]) }}>

    @if($icon)
        <i class="{{ $icon }} me-2"></i>
    @endif

    {{ $slot }}

</button>

@endif