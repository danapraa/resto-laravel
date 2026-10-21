<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lim Kok Tong</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}?v=1">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|playfair-display:600,700" rel="stylesheet" />
    <style>.font-display { font-family: 'Playfair Display', Georgia, serif; }</style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-amber-50 text-stone-800 antialiased font-sans">
    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-10">
        <a href="{{ route('home') }}" class="font-display text-3xl font-bold text-stone-900 mb-2">
            <span class="text-orange-600">Lim Kok</span> Tong
        </a>
        <p class="text-sm text-stone-500 mb-6">Reservasi meja &amp; pemesanan menu</p>

        <div class="w-full sm:max-w-md bg-white rounded-2xl shadow-lg ring-1 ring-stone-200 p-8">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
