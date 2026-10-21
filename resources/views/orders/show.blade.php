<x-app-layout>
    <div class="mx-auto max-w-3xl px-4 py-8">
        <a href="{{ route('orders.index') }}" class="text-sm text-stone-500 hover:text-orange-700">&larr; Riwayat pesanan</a>

        <x-card class="mt-4 p-6 sm:p-8">
            <div class="flex flex-wrap items-start justify-between gap-3">
                <div>
                    <p class="text-sm text-stone-500">Nomor Pesanan</p>
                    <h1 class="font-display text-2xl font-bold text-stone-900">{{ $order->order_number }}</h1>
                    <p class="mt-1 text-sm text-stone-500">{{ $order->created_at->translatedFormat('l, d F Y, H:i') }} WIB</p>
                </div>
                <x-status-badge :status="$order->status" class="text-sm" />
            </div>

            <div class="mt-6 overflow-x-auto">
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
                        @foreach ($order->items as $item)
                            <tr>
                                <td class="py-3 pr-4 font-medium text-stone-900">{{ $item->menu_name }}</td>
                                <td class="py-3 pr-4">{{ $item->quantity }}</td>
                                <td class="py-3 pr-4 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="py-3 text-right font-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="border-t border-stone-200">
                            <td colspan="3" class="py-4 text-right font-semibold">Total</td>
                            <td class="py-4 text-right text-lg font-bold text-stone-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mt-4 rounded-xl bg-amber-50 p-4 text-sm">
                <p class="font-semibold text-stone-800">Catatan</p>
                <p class="mt-1 text-stone-600">{{ $order->notes ?: 'Tidak ada catatan.' }}</p>
            </div>
        </x-card>
    </div>
</x-app-layout>
