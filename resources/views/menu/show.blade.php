<x-app-layout>
    <div class="mx-auto max-w-6xl px-4 py-8">
        <a href="{{ route('menu.index') }}" class="text-sm text-stone-500 hover:text-orange-700">&larr; Kembali ke menu</a>

        <div class="mt-4 grid gap-8 md:grid-cols-2">
            <div class="aspect-[4/3] overflow-hidden rounded-2xl bg-gradient-to-br from-amber-100 to-orange-200 shadow-sm ring-1 ring-stone-200">
                @if ($menu->image_url)
                    <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="h-full w-full object-cover">
                @else
                    <div class="flex h-full w-full items-center justify-center text-8xl">🍜</div>
                @endif
            </div>

            <div>
                <div class="flex items-center gap-3">
                    <span class="text-sm font-semibold text-orange-700">{{ $menu->category->name }}</span>
                    <x-status-badge :status="$menu->status" />
                </div>

                <h1 class="font-display mt-2 text-3xl font-bold text-stone-900">{{ $menu->name }}</h1>
                <p class="mt-3 text-2xl font-bold text-stone-900">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                <p class="mt-4 leading-relaxed text-stone-600">{{ $menu->description }}</p>

                <div class="mt-8">
                    @guest
                        <x-btn :href="route('login')">Masuk untuk memesan</x-btn>
                    @else
                        @if (auth()->user()->isAdmin())
                            <p class="rounded-xl bg-stone-100 px-4 py-3 text-sm text-stone-600">Anda masuk sebagai admin. Fitur pemesanan hanya untuk customer.</p>
                        @elseif (! $menu->isAvailable())
                            <p class="rounded-xl bg-stone-100 px-4 py-3 text-sm text-stone-600">Menu ini sedang tidak tersedia.</p>
                        @else
                            <form method="POST" action="{{ route('cart.store', $menu) }}" class="flex flex-wrap items-end gap-4">
                                @csrf
                                <div>
                                    <label for="quantity" class="block text-sm font-medium text-stone-700">Jumlah</label>
                                    <input type="number" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" min="1" max="99"
                                           class="mt-1 w-24 rounded-xl border border-stone-300 focus:border-orange-500 focus:ring-orange-500">
                                    @error('quantity') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                                <x-btn type="submit">🛒 Tambah ke Keranjang</x-btn>
                            </form>
                        @endif
                    @endguest
                </div>
            </div>
        </div>

        @if ($relatedMenus->isNotEmpty())
            <div class="mt-16">
                <h2 class="font-display text-2xl font-bold text-stone-900">Menu Lainnya di Kategori Ini</h2>
                <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($relatedMenus as $related)
                        <x-menu-card :menu="$related" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout> 
