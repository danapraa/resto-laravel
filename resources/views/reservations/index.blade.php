<x-app-layout>
    <div class="mx-auto max-w-6xl px-4 py-8">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h1 class="font-display text-3xl font-bold text-stone-900">Riwayat Reservasi</h1>
            <x-btn :href="route('reservations.create')">+ Reservasi Baru</x-btn>
        </div>

        @if ($reservations->isEmpty())
            <x-card class="mt-8 p-12 text-center">
                <p class="text-5xl">📅</p>
                <p class="mt-4 text-lg font-semibold text-stone-800">Belum ada reservasi</p>
                <p class="mt-1 text-sm text-stone-500">Amankan meja Anda untuk kunjungan berikutnya.</p>
                <div class="mt-6"><x-btn :href="route('reservations.create')">Buat Reservasi</x-btn></div>
            </x-card>
        @else
            <x-card class="mt-8 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-stone-50 text-left text-stone-500">
                            <tr>
                                <th class="px-4 py-3 font-medium">Kode</th>
                                <th class="px-4 py-3 font-medium">Tanggal</th>
                                <th class="px-4 py-3 font-medium">Waktu</th>
                                <th class="px-4 py-3 font-medium">Tamu</th>
                                <th class="px-4 py-3 font-medium">Meja</th>
                                <th class="px-4 py-3 font-medium">Status</th>
                                <th class="px-4 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-100">
                            @foreach ($reservations as $reservation)
                                <tr class="hover:bg-stone-50">
                                    <td class="px-4 py-3 font-semibold text-stone-900">{{ $reservation->reservation_code }}</td>
                                    <td class="whitespace-nowrap px-4 py-3">{{ $reservation->reservation_date->translatedFormat('d M Y') }}</td>
                                    <td class="px-4 py-3">{{ substr($reservation->reservation_time, 0, 5) }}</td>
                                    <td class="px-4 py-3">{{ $reservation->guest_count }} orang</td>
                                    <td class="px-4 py-3">{{ $reservation->table_number ?: '-' }}</td>
                                    <td class="px-4 py-3"><x-status-badge :status="$reservation->status" /></td>
                                    <td class="px-4 py-3 text-right"><a href="{{ route('reservations.show', $reservation) }}" class="font-semibold text-orange-700 hover:underline">Detail</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card>

            <div class="mt-6">{{ $reservations->links() }}</div>
        @endif
    </div>
</x-app-layout>
