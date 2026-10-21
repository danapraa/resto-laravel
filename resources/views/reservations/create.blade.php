<x-app-layout>
    <div class="mx-auto max-w-2xl px-4 py-8">
        <h1 class="font-display text-3xl font-bold text-stone-900">Reservasi Tempat</h1>
        <p class="mt-1 text-stone-500">Isi data berikut. Reservasi akan dikonfirmasi oleh admin.</p>

        <x-card class="mt-6 p-6 sm:p-8">
            <form method="POST" action="{{ route('reservations.store') }}" class="space-y-5">
                @csrf

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="reservation_date" class="block text-sm font-medium text-stone-700">Tanggal</label>
                        <input type="date" id="reservation_date" name="reservation_date"
                               value="{{ old('reservation_date') }}" min="{{ now()->toDateString() }}" required
                               class="mt-1 w-full rounded-xl border border-stone-300 focus:border-orange-500 focus:ring-orange-500">
                        @error('reservation_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="reservation_time" class="block text-sm font-medium text-stone-700">Waktu</label>
                        <input type="time" id="reservation_time" name="reservation_time"
                               value="{{ old('reservation_time') }}" required
                               class="mt-1 w-full rounded-xl border border-stone-300 focus:border-orange-500 focus:ring-orange-500">
                        @error('reservation_time') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="guest_count" class="block text-sm font-medium text-stone-700">Jumlah Orang</label>
                        <input type="number" id="guest_count" name="guest_count" min="1" max="50"
                               value="{{ old('guest_count', 2) }}" required
                               class="mt-1 w-full rounded-xl border border-stone-300 focus:border-orange-500 focus:ring-orange-500">
                        @error('guest_count') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="table_number" class="block text-sm font-medium text-stone-700">Nomor Meja (opsional)</label>
                        <input type="text" id="table_number" name="table_number" maxlength="10"
                               value="{{ old('table_number') }}" placeholder="Contoh: 5"
                               class="mt-1 w-full rounded-xl border border-stone-300 focus:border-orange-500 focus:ring-orange-500">
                        @error('table_number') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium text-stone-700">Catatan (opsional)</label>
                    <textarea id="notes" name="notes" rows="3" maxlength="500" placeholder="Contoh: acara ulang tahun, butuh kursi bayi..."
                              class="mt-1 w-full rounded-xl border border-stone-300 focus:border-orange-500 focus:ring-orange-500">{{ old('notes') }}</textarea>
                    @error('notes') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-wrap gap-3">
                    <x-btn type="submit">Kirim Reservasi</x-btn>
                    <x-btn :href="route('reservations.index')" variant="outline">Batal</x-btn>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
