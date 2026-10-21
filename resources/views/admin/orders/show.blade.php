<x-admin-layout>
    <x-slot name="header">Detail Pesanan</x-slot>

    <a href="{{ route('admin.orders.index') }}" class="text-sm text-stone-500 hover:text-orange-700">&larr; Kembali</a>

    <div class="mt-4 grid gap-6 lg:grid-cols-3">
        <x-card class="p-6 lg:col-span-2">
            <div class="flex flex-wrap items-start justify-between gap-3">
                <div>
                    <h2 class="font-display text-xl font-bold text-stone-900">{{ $order->order_number }}</h2>
                    <p class="text-sm text-stone-500">{{ $order->created_at->translatedFormat('l, d F Y, H:i') }} WIB</p>
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
                            <td class="py-4 text-right text-lg font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mt-4 rounded-xl bg-amber-50 p-4 text-sm">
                <p class="font-semibold text-stone-800">Catatan Customer</p>
                <p class="mt-1 text-stone-600">{{ $order->notes ?: 'Tidak ada catatan.' }}</p>
            </div>
        </x-card>

        <div class="space-y-6">
            <x-card class="p-6">
                <h3 class="font-display font-semibold text-stone-900">Customer</h3>
                <p class="mt-2 text-sm font-medium text-stone-800">{{ $order->user->name }}</p>
                <p class="text-sm text-stone-500">{{ $order->user->email }}</p>
            </x-card>

            <x-card class="p-6">
                <h3 class="font-display font-semibold text-stone-900">Ubah Status</h3>
                <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="mt-3 space-y-3">
                    @csrf @method('PATCH')
                    <select name="status" class="w-full rounded-xl border border-stone-300 focus:border-orange-500 focus:ring-orange-500">
                        @foreach (\App\Models\Order::STATUS_LABELS as $value => $label)
                            <option value="{{ $value }}" @selected($order->status === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('status') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    <x-btn type="submit" class="w-full">Simpan Status</x-btn>
                </form>
            </x-card>
        </div>
    </div>
</x-admin-layout>
