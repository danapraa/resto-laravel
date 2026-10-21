@php
    $navItems = [
        ['Dashboard', 'admin.dashboard', 'admin.dashboard', '📊'],
        ['Kategori', 'admin.categories.index', 'admin.categories.*', '🏷️'],
        ['Menu', 'admin.menus.index', 'admin.menus.*', '🍜'],
        ['Pesanan', 'admin.orders.index', 'admin.orders.*', '🧾'],
        ['Reservasi', 'admin.reservations.index', 'admin.reservations.*', '📅'],
        ['Customer', 'admin.customers.index', 'admin.customers.*', '👥'],
    ];
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin – Resto Lim Kok Tong</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|playfair-display:600,700" rel="stylesheet" />
    <style>
        [x-cloak] { display: none !important; }
        .font-display { font-family: 'Playfair Display', Georgia, serif; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-stone-100 font-sans text-stone-800 antialiased" x-data="{ sidebar: false }">
    <div class="min-h-screen md:flex">

        {{-- Overlay mobile --}}
        <div x-show="sidebar" x-cloak @click="sidebar = false" class="fixed inset-0 z-30 bg-black/40 md:hidden"></div>

        {{-- Sidebar --}}
        <aside :class="sidebar ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-40 w-64 transform bg-stone-900 text-amber-50 transition md:static md:translate-x-0">
            <div class="px-6 py-6">
                <p class="font-display text-xl font-bold"><span class="text-orange-400">Lim Kok</span> Tong</p>
                <p class="text-xs text-stone-400">Panel Admin</p>
            </div>

            <nav class="space-y-1 px-3 text-sm">
                @foreach ($navItems as [$label, $route, $pattern, $icon])
                    <a href="{{ route($route) }}"
                       class="flex items-center gap-3 rounded-xl px-4 py-2.5 {{ request()->routeIs($pattern) ? 'bg-orange-600 font-semibold text-white' : 'text-stone-300 hover:bg-stone-800' }}">
                        <span>{{ $icon }}</span> {{ $label }}
                    </a>
                @endforeach

                <a href="{{ route('home') }}" class="mt-6 flex items-center gap-3 rounded-xl px-4 py-2.5 text-stone-300 hover:bg-stone-800">🌐 Lihat Website</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                <button type="button" @click="sidebar = false; $dispatch('open-logout')" class="flex w-full items-center gap-3 rounded-xl px-4 py-2.5 text-left text-stone-300 hover:bg-stone-800">🚪 Keluar</button>
                </form>
            </nav>
        </aside>

        {{-- Konten --}}
        <div class="min-w-0 flex-1">
            <div class="flex items-center justify-between border-b border-stone-200 bg-white px-4 py-4 sm:px-8">
                <div class="flex items-center gap-3">
                    <button type="button" @click="sidebar = true" class="rounded-lg p-2 hover:bg-stone-100 md:hidden" aria-label="Menu">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16" /></svg>
                    </button>
                    <h1 class="font-display text-xl font-bold text-stone-900">{{ $header ?? 'Admin' }}</h1>
                </div>
                <p class="hidden text-sm text-stone-500 sm:block">{{ auth()->user()->name }}</p>
            </div>

            <main class="p-4 sm:p-8">
                <x-alert />
                {{ $slot }}
            </main>
        </div>
    </div>

    <x-logout-modal />
</body>
</html>
