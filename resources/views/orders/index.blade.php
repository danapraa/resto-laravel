<x-app-layout>
    <div class="mx-auto max-w-6xl px-4 py-8">
        <h1 class="font-display text-3xl font-bold text-stone-900">Riwayat Pesanan</h1>

        @if ($orders->isEmpty())
            <x-card class="mt-8 p-12 text-center">
                <p class="text-5xl">🧾</p>
                <p class="mt-4 text-lg font-semibold text-stone-800">Belum ada pesanan</p>
                <p class="mt-1 text-sm text-stone-500">Pesanan Anda akan muncul di sini.</p>
                <div class="mt-6"><x-btn :href="route('menu.index')">Mulai Memesan</x-btn></div>
            </x-card>
        @else
            <x-card class="mt-8 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-stone-50 text-left text-stone-500">
                            <tr>
                                <th class="px-4 py-3 font-medium">No. Order</th>
                                <th class="px-4 py-3 font-medium">Tanggal</th>
                                <th class="px-4 py-3 font-medium">Item</th>
                                <th class="px-4 py-3 font-medium">Total</th>
                                <th class="px-4 py-3 font-medium">Status</th>
                                <th class="px-4 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-100">
                            @foreach ($orders as $order)
                                <tr class="hover:bg-stone-50">
                                    <td class="px-4 py-3 font-semibold text-stone-900">{{ $order->order_number }}</td>
                                    <td class="whitespace-nowrap px-4 py-3">{{ $order->created_at->translatedFormat('d M Y, H:i') }}</td>
                                    <td class="px-4 py-3">{{ $order->items_count }}</td>
                                    <td class="whitespace-nowrap px-4 py-3 font-semibold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3"><x-status-badge :status="$order->status" /></td>
                                    <td class="px-4 py-3 text-right"><a href="{{ route('orders.show', $order) }}" class="font-semibold text-orange-700 hover:underline">Detail</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card>

            <div class="mt-6">{{ $orders->links() }}</div>
        @endif
    </div>
</x-app-layout>
