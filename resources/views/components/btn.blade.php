@props(['variant' => 'primary', 'type' => 'button', 'href' => null])

@php
    $base = 'inline-flex items-center justify-center gap-2 rounded-full px-5 py-2.5 text-sm font-semibold transition focus:outline-none focus:ring-2 focus:ring-orange-400 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';

    $variants = [
        'primary' => 'bg-orange-600 text-white hover:bg-orange-700',
        'dark'    => 'bg-stone-900 text-white hover:bg-stone-700',
        'outline' => 'bg-white text-stone-800 border border-stone-300 hover:bg-stone-100',
        'danger'  => 'bg-red-600 text-white hover:bg-red-700',
        'light'   => 'bg-amber-50 text-stone-900 hover:bg-white',
    ];

    $classes = $base . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@endif
