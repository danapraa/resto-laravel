<x-app-layout>
    <div class="mx-auto max-w-6xl px-4 py-8">
        <h1 class="font-display text-3xl font-bold text-stone-900">Keranjang Saya</h1>

        @if ($cart->items->isEmpty())
            <x-card class="mt-8 p-12 text-center">
                <p class="text-5xl">🛒</p>
                <p class="mt-4 text-lg font-semibold text-stone-800">Keranjang Anda masih kosong</p>
                <p class="mt-1 text-sm text-stone-500">Yuk, pilih menu favorit Anda terlebih dahulu.</p>
                <div class="mt-6"><x-btn :href="route('menu.index')">Lihat Menu</x-btn></div>
            </x-card>
        @else
            <div class="mt-8 grid gap-6 lg:grid-cols-3">
                <div class="space-y-4 lg:col-span-2">
                    @foreach ($cart->items as $item)
                        <x-card class="flex flex-col gap-4 p-4 sm:flex-row sm:items-center">
                            <div class="h-24 w-full shrink-0 overflow-hidden rounded-xl bg-gradient-to-br from-amber-100 to-orange-200 sm:w-28">
                                @if ($item->menu->image_url)
                                    <img src="{{ $item->menu->image_url }}" alt="{{ $item->menu->name }}" class="h-full w-full object-cover">
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-3xl">🍜</div>
                                @endif
                            </div>

                            <div class="flex-1">
                                <a href="{{ route('menu.show', $item->menu->slug) }}" class="font-display font-semibold text-stone-900 hover:text-orange-700">{{ $item->menu->name }}</a>
                                <p class="text-sm text-stone-500">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                @if (! $item->menu->isAvailable())
                                    <p class="mt-1 text-xs font-semibold text-red-600">Menu ini tidak tersedia. Hapus untuk melanjutkan checkout.</p>
                                @endif
                            </div>

                            <div class="flex items-center gap-2">
                                <form method="POST" action="{{ route('cart.update', $item) }}">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                                    <button type="submit" @disabled($item->quantity <= 1)
                                            class="h-8 w-8 rounded-full border border-stone-300 font-bold hover:bg-stone-100 disabled:cursor-not-allowed disabled:opacity-40">&minus;</button>
                                </form>
                                <span class="w-8 text-center font-semibold">{{ $item->quantity }}</span>
                                <form method="POST" action="{{ route('cart.update', $item) }}">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                    <button type="submit" @disabled($item->quantity >= 99)
                                            class="h-8 w-8 rounded-full border border-stone-300 font-bold hover:bg-stone-100 disabled:cursor-not-allowed disabled:opacity-40">+</button>
                                </form>
                            </div>

                            <div class="flex items-center justify-between gap-4 sm:w-40 sm:flex-col sm:items-end sm:gap-2">
                                <p class="font-bold text-stone-900">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                <form method="POST" action="{{ route('cart.destroy', $item) }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-sm font-medium text-red-600 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </x-card>
                    @endforeach
                </div>

                <div>
                    <x-card class="sticky top-24 p-6">
                        <h2 class="font-display text-xl font-semibold text-stone-900">Ringkasan</h2>
                        <div class="mt-4 flex justify-between text-sm text-stone-600">
                            <span>Jumlah item</span>
                            <span>{{ $cart->items->sum('quantity') }}</span>
                        </div>
                        <div class="mt-2 flex justify-between border-t border-stone-200 pt-4 text-lg font-bold text-stone-900">
                            <span>Total</span>
                            <span>Rp {{ number_format($cart->total, 0, ',', '.') }}</span>
                        </div>
                        <div class="mt-6 flex flex-col gap-2">
                            <x-btn :href="route('checkout.index')">Lanjut ke Checkout</x-btn>
                            <x-btn :href="route('menu.index')" variant="outline">Tambah Menu Lagi</x-btn>
                        </div>
                    </x-card>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
