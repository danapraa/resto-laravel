<x-app-layout>
    <div class="mx-auto max-w-6xl px-4 py-8">
        <h1 class="font-display text-3xl font-bold text-stone-900">Checkout</h1>
        <p class="mt-1 text-stone-500">Periksa kembali pesanan Anda. Pembayaran dilakukan langsung di restoran.</p>

        <form method="POST" action="{{ route('checkout.store') }}" class="mt-8 grid gap-6 lg:grid-cols-3">
            @csrf

            <x-card class="p-6 lg:col-span-2">
                <h2 class="font-display text-xl font-semibold text-stone-900">Pesanan Anda</h2>

                <div class="mt-4 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b border-stone-200 text-left text-stone-500">
                                <th class="py-2 pr-4 font-medium">Menu</th>
                                <th class="py-2 pr-4 font-medium">Qty</th>
                                <th class="py-2 pr-4 text-right font-medium">Harga</th>
                                <th class="py-2 text-right font-medium">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-100">
                            @foreach ($cart->items as $item)
                                <tr>
                                    <td class="py-3 pr-4 font-medium text-stone-900">{{ $item->menu->name }}</td>
                                    <td class="py-3 pr-4">{{ $item->quantity }}</td>
                                    <td class="py-3 pr-4 text-right">Rp {{ number_format($item->menu->price, 0, ',', '.') }}</td>
                                    <td class="py-3 text-right font-semibold">Rp {{ number_format($item->quantity * $item->menu->price, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    <label for="notes" class="block text-sm font-medium text-stone-700">Catatan (opsional)</label>
                    <textarea id="notes" name="notes" rows="3" maxlength="500" placeholder="Contoh: tidak pedas, tanpa bawang..."
                              class="mt-1 w-full rounded-xl border border-stone-300 focus:border-orange-500 focus:ring-orange-500">{{ old('notes') }}</textarea>
                    @error('notes') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </x-card>

            <div>
                <x-card class="sticky top-24 p-6">
                    <h2 class="font-display text-xl font-semibold text-stone-900">Total</h2>
                    <p class="mt-3 text-3xl font-bold text-stone-900">Rp {{ number_format($total, 0, ',', '.') }}</p>
                    <div class="mt-6 flex flex-col gap-2">
                        <x-btn type="submit">Buat Pesanan</x-btn>
                        <x-btn :href="route('cart.index')" variant="outline">Kembali ke Keranjang</x-btn>
                    </div>
                </x-card>
            </div>
        </form>
    </div>
</x-app-layout>
