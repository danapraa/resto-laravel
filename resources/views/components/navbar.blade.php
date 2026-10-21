@php
    $user = auth()->user();
    $isAdmin = $user && $user->isAdmin();

    $cartCount = 0;
    if ($user && ! $isAdmin && $user->cart) {
        $cartCount = (int) $user->cart->items()->sum('quantity');
    }

    $links = [
        ['label' => 'Beranda', 'route' => 'home', 'active' => request()->routeIs('home')],
        ['label' => 'Menu', 'route' => 'menu.index', 'active' => request()->routeIs('menu.*')],
    ];

    if ($user && ! $isAdmin) {
        $links[] = ['label' => 'Reservasi', 'route' => 'reservations.index', 'active' => request()->routeIs('reservations.*')];
        $links[] = ['label' => 'Pesanan', 'route' => 'orders.index', 'active' => request()->routeIs('orders.*')];
    }
@endphp

<nav x-data="{ open: false }" class="sticky top-0 z-40 bg-stone-900 text-amber-50 shadow">
    <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4">
       <a href="{{ route('home') }}" class="flex items-center gap-3 leading-tight">
    <img src="{{ asset('images/logo.jpg') }}" alt="Logo Lim Kok Tong" class="h-10 w-10 rounded-full bg-white object-contain p-0.5">
    <span>
        <span class="font-display block text-xl font-bold tracking-wide"><span class="text-orange-400">Lim Kok</span> Tong Kopitiam</span>
        <span class="block text-[10px] uppercase tracking-widest text-stone-400">Wiyung · Surabaya</span>
    </span>
</a>

        {{-- Menu desktop --}}
        <div class="hidden items-center gap-6 text-sm md:flex">
            @foreach ($links as $link)
                <a href="{{ route($link['route']) }}"
                   class="{{ $link['active'] ? 'font-semibold text-orange-400' : 'hover:text-orange-300' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>

        <div class="hidden items-center gap-4 text-sm md:flex">
            @guest
                <a href="{{ route('login') }}" class="hover:text-orange-300">Masuk</a>
                <x-btn :href="route('register')">Daftar</x-btn>
            @else
                @if ($isAdmin)
                    <x-btn :href="route('admin.dashboard')">Dashboard Admin</x-btn>
                @else
                    <a href="{{ route('cart.index') }}" class="relative hover:text-orange-300">
                        🛒 Keranjang
                        @if ($cartCount > 0)
                            <span class="absolute -right-4 -top-2 flex h-5 min-w-5 items-center justify-center rounded-full bg-orange-600 px-1 text-xs font-bold text-white">{{ $cartCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('profile.edit') }}" class="ml-3 hover:text-orange-300">{{ \Illuminate\Support\Str::limit($user->name, 14) }}</a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="button" @click="$dispatch('open-logout')" class="rounded-full border border-amber-50/30 px-4 py-1.5 hover:bg-amber-50/10">Keluar</button>
                </form>
            @endguest
        </div>

        {{-- Tombol hamburger --}}
        <button type="button" @click="open = ! open" class="rounded-lg p-2 hover:bg-stone-800 md:hidden" aria-label="Menu">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path x-show="! open" stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16" />
                <path x-show="open" x-cloak stroke-linecap="round" d="M6 6l12 12M18 6L6 18" />
            </svg>
        </button>
    </div>

    {{-- Menu mobile --}}
    <div x-show="open" x-cloak class="space-y-1 border-t border-stone-800 px-4 pb-4 pt-2 text-sm md:hidden">
        @foreach ($links as $link)
            <a href="{{ route($link['route']) }}" class="block rounded-lg px-3 py-2 {{ $link['active'] ? 'bg-stone-800 text-orange-400' : 'hover:bg-stone-800' }}">
                {{ $link['label'] }}
            </a>
        @endforeach

        @guest
            <a href="{{ route('login') }}" class="block rounded-lg px-3 py-2 hover:bg-stone-800">Masuk</a>
            <a href="{{ route('register') }}" class="block rounded-lg px-3 py-2 hover:bg-stone-800">Daftar</a>
        @else
            @if ($isAdmin)
                <a href="{{ route('admin.dashboard') }}" class="block rounded-lg px-3 py-2 hover:bg-stone-800">Dashboard Admin</a>
            @else
                <a href="{{ route('cart.index') }}" class="block rounded-lg px-3 py-2 hover:bg-stone-800">🛒 Keranjang ({{ $cartCount }})</a>
                <a href="{{ route('profile.edit') }}" class="block rounded-lg px-3 py-2 hover:bg-stone-800">Profil</a>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="button" @click="open = false; $dispatch('open-logout')" class="block w-full rounded-lg px-3 py-2 text-left hover:bg-stone-800">Keluar</button>
            </form>
        @endguest
    </div>
</nav>
