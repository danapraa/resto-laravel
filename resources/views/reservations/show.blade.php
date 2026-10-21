<x-app-layout>
    <div class="mx-auto max-w-2xl px-4 py-8">
        <a href="{{ route('reservations.index') }}" class="text-sm text-stone-500 hover:text-orange-700">&larr; Riwayat reservasi</a>

        <x-card class="mt-4 p-6 sm:p-8">
            <div class="flex flex-wrap items-start justify-between gap-3">
                <div>
                    <p class="text-sm text-stone-500">Kode Reservasi</p>
                    <h1 class="font-display text-2xl font-bold text-stone-900">{{ $reservation->reservation_code }}</h1>
                </div>
                <x-status-badge :status="$reservation->status" class="text-sm" />
            </div>

            <dl class="mt-6 grid gap-4 text-sm sm:grid-cols-2">
                <div>
                    <dt class="text-stone-500">Tanggal</dt>
                    <dd class="font-semibold text-stone-900">{{ $reservation->reservation_date->translatedFormat('l, d F Y') }}</dd>
                </div>
                <div>
                    <dt class="text-stone-500">Waktu</dt>
                    <dd class="font-semibold text-stone-900">{{ substr($reservation->reservation_time, 0, 5) }} WIB</dd>
                </div>
                <div>
                    <dt class="text-stone-500">Jumlah Orang</dt>
                    <dd class="font-semibold text-stone-900">{{ $reservation->guest_count }} orang</dd>
                </div>
                <div>
                    <dt class="text-stone-500">Nomor Meja</dt>
                    <dd class="font-semibold text-stone-900">{{ $reservation->table_number ?: 'Akan ditentukan restoran' }}</dd>
                </div>
            </dl>

            <div class="mt-6 rounded-xl bg-amber-50 p-4 text-sm">
                <p class="font-semibold text-stone-800">Catatan</p>
                <p class="mt-1 text-stone-600">{{ $reservation->notes ?: 'Tidak ada catatan.' }}</p>
            </div>

            <p class="mt-6 text-xs text-stone-500">Dibuat pada {{ $reservation->created_at->translatedFormat('d F Y, H:i') }} WIB. Tunjukkan kode reservasi saat tiba di restoran.</p>
        </x-card>
    </div>
</x-app-layout>
