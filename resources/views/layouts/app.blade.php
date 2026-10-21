<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Lim Kok Tong' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}?v=1">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|playfair-display:600,700" rel="stylesheet" />
    <style>
        [x-cloak] { display: none !important; }
        .font-display { font-family: 'Playfair Display', Georgia, serif; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-amber-50 text-stone-800 antialiased min-h-screen flex flex-col font-sans">
    <x-navbar />

    @isset($header)
        <header class="bg-white border-b border-stone-200">
            <div class="max-w-6xl mx-auto px-4 py-6">{{ $header }}</div>
        </header>
    @endisset

    <main class="flex-1">
        <div class="max-w-6xl mx-auto px-4 pt-6 empty:hidden">
            <x-alert />
        </div>

        {{ $slot }}
    </main>

    <x-footer />
    <x-logout-modal />
</body>
</html>
