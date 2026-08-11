@props([
    'title',
    'value' => null,
    'total' => null,
    'icon',
    'color' => 'primary'
])

@php
    $angka = $value ?? $total ?? 0;
    
    $bgColors = [
        'primary' => 'bg-primary-100 text-primary-600',
        'success' => 'bg-emerald-100 text-emerald-600',
        'warning' => 'bg-amber-100 text-amber-600',
        'danger'  => 'bg-rose-100 text-rose-600',
        'info'    => 'bg-sky-100 text-sky-600',
    ];
    $iconClass = $bgColors[$color] ?? 'bg-slate-100 text-slate-600';
@endphp

<div {{ $attributes->merge(['class' => 'bg-white rounded-2xl p-5 border border-slate-200/60 shadow-sm flex items-center justify-between transition-transform hover:-translate-y-1 hover:shadow-md']) }}>

    <div>
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">{{ $title }}</p>
        <h3 class="text-2xl font-extrabold text-slate-800">{{ number_format($angka) }}</h3>
    </div>

    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl {{ $iconClass }}">
        <i class="fa-solid {{ $icon }}"></i>
    </div>

</div>