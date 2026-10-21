<x-admin-layout>
    <x-slot name="header">Dashboard</x-slot>

    @php
        $cards = [
            ['Total Menu', $stats['menus'], '🍜', 'text-stone-900'],
            ['Total Customer', $stats['customers'], '👥', 'text-stone-900'],
            ['Total Pesanan', $stats['orders'], '🧾', 'text-stone-900'],
            ['Total Reservasi', $stats['reservations'], '📅', 'text-stone-900'],
            ['Pesanan Pending', $stats['pending_orders'], '⏳', 'text-amber-600'],
            ['Reservasi Pending', $stats['pending_reservations'], '🔔', 'text-amber-600'],
        ];
    @endphp

    <div class="grid grid-cols-2 gap-4 lg:grid-cols-3">
        @foreach ($cards as [$label, $value, $icon, $color])
            <x-card class="p-5">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-stone-500">{{ $label }}</p>
                    <span class="text-2xl">{{ $icon }}</span>
                </div>
                <p class="mt-2 text-3xl font-bold {{ $color }}">{{ $value }}</p>
            </x-card>
        @endforeach
    </div>

    <div class="mt-8 grid gap-6 xl:grid-cols-2">
        <x-card class="overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4">
                <h2 class="font-display font-semibold text-stone-900">Pesanan Terbaru</h2>
                <a href="{{ route('admin.orders.index') }}" class="text-sm font-semibold text-orange-700 hover:underline">Lihat semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <tbody class="divide-y divide-stone-100 border-t border-stone-100">
                        @forelse ($latestOrders as $order)
                            <tr>
                                <td class="px-5 py-3">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="font-semibold text-stone-900 hover:text-orange-700">{{ $order->order_number }}</a>
                                    <p class="text-xs text-stone-500">{{ $order->user->name }}</p>
                                </td>
                                <td class="whitespace-nowrap px-5 py-3">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td class="px-5 py-3"><x-status-badge :status="$order->status" /></td>
                            </tr>
                        @empty
                            <tr><td class="px-5 py-8 text-center text-stone-500">Belum ada pesanan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>

        <x-card class="overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4">
                <h2 class="font-display font-semibold text-stone-900">Reservasi Terbaru</h2>
                <a href="{{ route('admin.reservations.index') }}" class="text-sm font-semibold text-orange-700 hover:underline">Lihat semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <tbody class="divide-y divide-stone-100 border-t border-stone-100">
                        @forelse ($latestReservations as $reservation)
                            <tr>
                                <td class="px-5 py-3">
                                    <a href="{{ route('admin.reservations.show', $reservation) }}" class="font-semibold text-stone-900 hover:text-orange-700">{{ $reservation->reservation_code }}</a>
                                    <p class="text-xs text-stone-500">{{ $reservation->user->name }}</p>
                                </td>
                                <td class="whitespace-nowrap px-5 py-3">{{ $reservation->reservation_date->translatedFormat('d M Y') }}, {{ substr($reservation->reservation_time, 0, 5) }}</td>
                                <td class="px-5 py-3"><x-status-badge :status="$reservation->status" /></td>
                            </tr>
                        @empty
                            <tr><td class="px-5 py-8 text-center text-stone-500">Belum ada reservasi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>
    </div>
</x-admin-layout>
