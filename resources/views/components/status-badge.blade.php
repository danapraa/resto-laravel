@props(['status'])

@php
    $map = [
        'pending'     => ['Menunggu',      'bg-amber-100 text-amber-800 ring-amber-200'],
        'processing'  => ['Diproses',      'bg-blue-100 text-blue-800 ring-blue-200'],
        'ready'       => ['Siap Diambil',  'bg-teal-100 text-teal-800 ring-teal-200'],
        'completed'   => ['Selesai',       'bg-green-100 text-green-800 ring-green-200'],
        'cancelled'   => ['Dibatalkan',    'bg-red-100 text-red-800 ring-red-200'],
        'confirmed'   => ['Dikonfirmasi',  'bg-sky-100 text-sky-800 ring-sky-200'],
        'available'   => ['Tersedia',      'bg-green-100 text-green-800 ring-green-200'],
        'unavailable' => ['Tidak Tersedia','bg-stone-200 text-stone-600 ring-stone-300'],
    ];

    [$label, $color] = $map[$status] ?? [ucfirst($status), 'bg-stone-100 text-stone-700 ring-stone-200'];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center whitespace-nowrap rounded-full px-2.5 py-0.5 text-xs font-semibold ring-1 ring-inset ' . $color]) }}>{{ $label }}</span>
