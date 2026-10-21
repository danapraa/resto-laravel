<x-admin-layout>
    <x-slot name="header">Detail Reservasi</x-slot>

    <a href="{{ route('admin.reservations.index') }}" class="text-sm text-stone-500 hover:text-orange-700">&larr; Kembali</a>

    <div class="mt-4 grid gap-6 lg:grid-cols-3">
        <x-card class="p-6 lg:col-span-2">
            <div class="flex flex-wrap items-start justify-between gap-3">
                <div>
                    <p class="text-sm text-stone-500">Kode Reservasi</p>
                    <h2 class="font-display text-xl font-bold text-stone-900">{{ $reservation->reservation_code }}</h2>
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
                    <dd class="font-semibold text-stone-900">{{ $reservation->table_number ?: 'Belum ditentukan' }}</dd>
                </div>
            </dl>

            <div class="mt-6 rounded-xl bg-amber-50 p-4 text-sm">
                <p class="font-semibold text-stone-800">Catatan Customer</p>
                <p class="mt-1 text-stone-600">{{ $reservation->notes ?: 'Tidak ada catatan.' }}</p>
            </div>
        </x-card>

        <div class="space-y-6">
            <x-card class="p-6">
                <h3 class="font-display font-semibold text-stone-900">Customer</h3>
                <p class="mt-2 text-sm font-medium text-stone-800">{{ $reservation->user->name }}</p>
                <p class="text-sm text-stone-500">{{ $reservation->user->email }}</p>
            </x-card>

            <x-card class="p-6">
                <h3 class="font-display font-semibold text-stone-900">Ubah Status</h3>
                <form method="POST" action="{{ route('admin.reservations.update', $reservation) }}" class="mt-3 space-y-3">
                    @csrf @method('PATCH')

                    <div>
                        <label for="status" class="block text-sm font-medium text-stone-700">Status</label>
                        <select id="status" name="status" class="mt-1 w-full rounded-xl border border-stone-300 focus:border-orange-500 focus:ring-orange-500">
                            @foreach (\App\Models\Reservation::STATUS_LABELS as $value => $label)
                                <option value="{{ $value }}" @selected($reservation->status === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="table_number" class="block text-sm font-medium text-stone-700">Nomor Meja</label>
                        <input type="text" id="table_number" name="table_number" maxlength="10"
                               value="{{ old('table_number', $reservation->table_number) }}"
                               class="mt-1 w-full rounded-xl border border-stone-300 focus:border-orange-500 focus:ring-orange-500">
                        @error('table_number') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <x-btn type="submit" class="w-full">Simpan</x-btn>
                </form>
            </x-card>
        </div>
    </div>
</x-admin-layout>
