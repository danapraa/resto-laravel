<x-admin-layout>
    <x-slot name="header">Kelola Pesanan</x-slot>

    <form method="GET" action="{{ route('admin.orders.index') }}" class="mb-4 flex gap-2">
        <select name="status" class="rounded-full border border-stone-300 px-4 py-2 text-sm focus:border-orange-500 focus:ring-orange-500">
            <option value="">Semua status</option>
            @foreach (\App\Models\Order::STATUS_LABELS as $value => $label)
                <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        <x-btn type="submit" variant="dark">Filter</x-btn>
    </form>

    <x-card class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-stone-50 text-left text-stone-500">
                    <tr>
                        <th class="px-4 py-3 font-medium">No. Order</th>
                        <th class="px-4 py-3 font-medium">Customer</th>
                        <th class="px-4 py-3 font-medium">Tanggal</th>
                        <th class="px-4 py-3 font-medium">Item</th>
                        <th class="px-4 py-3 font-medium">Total</th>
                        <th class="px-4 py-3 font-medium">Status</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-stone-50">
                            <td class="px-4 py-3 font-semibold text-stone-900">{{ $order->order_number }}</td>
                            <td class="px-4 py-3">{{ $order->user->name }}</td>
                            <td class="whitespace-nowrap px-4 py-3">{{ $order->created_at->translatedFormat('d M Y, H:i') }}</td>
                            <td class="px-4 py-3">{{ $order->items_count }}</td>
                            <td class="whitespace-nowrap px-4 py-3">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td class="px-4 py-3"><x-status-badge :status="$order->status" /></td>
                            <td class="px-4 py-3 text-right"><a href="{{ route('admin.orders.show', $order) }}" class="font-semibold text-orange-700 hover:underline">Detail</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-4 py-10 text-center text-stone-500">Tidak ada pesanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>

    <div class="mt-6">{{ $orders->links() }}</div>
</x-admin-layout>
