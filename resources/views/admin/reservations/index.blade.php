<x-admin-layout>
    <x-slot name="header">Kelola Reservasi</x-slot>

    <form method="GET" action="{{ route('admin.reservations.index') }}" class="mb-4 flex gap-2">
        <select name="status" class="rounded-full border border-stone-300 px-4 py-2 text-sm focus:border-orange-500 focus:ring-orange-500">
            <option value="">Semua status</option>
            @foreach (\App\Models\Reservation::STATUS_LABELS as $value => $label)
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
                        <th class="px-4 py-3 font-medium">Kode</th>
                        <th class="px-4 py-3 font-medium">Customer</th>
                        <th class="px-4 py-3 font-medium">Tanggal</th>
                        <th class="px-4 py-3 font-medium">Waktu</th>
                        <th class="px-4 py-3 font-medium">Tamu</th>
                        <th class="px-4 py-3 font-medium">Meja</th>
                        <th class="px-4 py-3 font-medium">Status</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse ($reservations as $reservation)
                        <tr class="hover:bg-stone-50">
                            <td class="px-4 py-3 font-semibold text-stone-900">{{ $reservation->reservation_code }}</td>
                            <td class="px-4 py-3">{{ $reservation->user->name }}</td>
                            <td class="whitespace-nowrap px-4 py-3">{{ $reservation->reservation_date->translatedFormat('d M Y') }}</td>
                            <td class="px-4 py-3">{{ substr($reservation->reservation_time, 0, 5) }}</td>
                            <td class="px-4 py-3">{{ $reservation->guest_count }}</td>
                            <td class="px-4 py-3">{{ $reservation->table_number ?: '-' }}</td>
                            <td class="px-4 py-3"><x-status-badge :status="$reservation->status" /></td>
                            <td class="px-4 py-3 text-right"><a href="{{ route('admin.reservations.show', $reservation) }}" class="font-semibold text-orange-700 hover:underline">Detail</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="px-4 py-10 text-center text-stone-500">Tidak ada reservasi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>

    <div class="mt-6">{{ $reservations->links() }}</div>
</x-admin-layout>
