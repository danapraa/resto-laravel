<x-app-layout>
    {{-- Hero --}}
    <section class="relative isolate -mt-6 overflow-hidden bg-stone-900 text-amber-50">
        <img src="{{ asset('images/gambar.jpg') }}" alt="Hidangan Resto Lim Kok Tong"
             class="absolute inset-0 -z-10 h-full w-full object-cover">
        <div class="absolute inset-0 -z-10 bg-stone-900/70"></div>

        <div class="mx-auto max-w-6xl px-4 py-24 md:py-36">
            <div class="max-w-2xl">
                <p class="text-sm font-semibold uppercase tracking-widest text-orange-400">Resto Lim Kok Tong Kopitiam · Wiyung, Surabaya</p>
                <h1 class="font-display mt-3 text-4xl font-bold leading-tight md:text-6xl">
                    Cita rasa Siantar yang hangat, siap dinikmati bersama.
                </h1>
                <p class="mt-4 max-w-lg text-stone-200">
                    Pesan menu favorit Anda atau reservasi meja secara online dengan mudah, tanpa antri dan tanpa repot.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <x-btn :href="route('menu.index')">Lihat Menu</x-btn>
                    <x-btn :href="route('reservations.create')" variant="light">Reservasi Meja</x-btn>
                </div>
            </div>
        </div>
    </section>

    {{-- Tentang --}}
    <section class="mx-auto max-w-6xl px-4 py-16">
        <div class="mx-auto max-w-2xl text-center">
            <p class="text-sm font-semibold uppercase tracking-widest text-orange-600">Tentang Kami</p>
            <h2 class="font-display mt-2 text-3xl font-bold text-stone-900">Resto Lim Kok Tong Kopitiam Wiyung Surabaya</h2>
            <p class="mt-4 text-stone-600">
                Kami menyajikan hidangan Siantar dengan bumbu yang dimasak segar setiap hari. Suasana nyaman, porsi
                pas untuk berbagi, dan pelayanan yang ramah menjadikan Lim Kok Tong tempat yang cocok untuk makan
                bersama keluarga, rekan kerja, maupun acara spesial.
            </p>
        </div>
    </section>

    {{-- Menu unggulan --}}
    <section class="mx-auto max-w-6xl px-4 pb-16">
        <div class="mb-8 flex items-end justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-widest text-orange-600">Pilihan Favorit</p>
                <h2 class="font-display mt-1 text-3xl font-bold text-stone-900">Menu Unggulan</h2>
            </div>
            <a href="{{ route('menu.index') }}" class="text-sm font-semibold text-orange-700 hover:underline">Lihat semua &rarr;</a>
        </div>

        @if ($featuredMenus->isEmpty())
            <x-card class="p-8 text-center text-stone-500">Menu belum tersedia.</x-card>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($featuredMenus as $menu)
                    <x-menu-card :menu="$menu" />
                @endforeach
            </div>
        @endif
    </section>

    {{-- Kategori --}}
    <section class="bg-white py-16">
        <div class="mx-auto max-w-6xl px-4">
            <div class="mb-8 text-center">
                <p class="text-sm font-semibold uppercase tracking-widest text-orange-600">Jelajahi</p>
                <h2 class="font-display mt-1 text-3xl font-bold text-stone-900">Kategori Menu</h2>
            </div>
            <div class="grid grid-cols-2 gap-4 md:grid-cols-5">
                @foreach ($categories as $category)
                    <a href="{{ route('menu.index', ['category' => $category->slug]) }}"
                       class="rounded-2xl bg-amber-50 p-5 text-center ring-1 ring-amber-200 transition hover:bg-orange-50 hover:ring-orange-300">
                        <p class="font-display font-semibold text-stone-900">{{ $category->name }}</p>
                        <p class="mt-1 text-xs text-stone-500">{{ $category->menus_count }} menu</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

        {{-- Informasi reservasi --}}
    @php
        $steps = [
            ['Isi formulir reservasi', 'Pilih tanggal, jam, dan jumlah tamu. Nomor meja boleh dikosongkan.'],
            ['Tunggu konfirmasi', 'Admin memeriksa ketersediaan, lalu status reservasi Anda berubah menjadi dikonfirmasi.'],
            ['Datang dan tunjukkan kode', 'Sebutkan kode reservasi kepada pelayan saat tiba di restoran.'],
        ];
    @endphp

    <section class="mx-auto max-w-6xl px-4 py-20">
        <div class="grid gap-12 lg:grid-cols-5 lg:gap-16">
            <div class="lg:col-span-3">
                <p class="text-sm font-semibold uppercase tracking-widest text-orange-600">Reservasi</p>
                <h2 class="font-display mt-2 max-w-lg text-3xl font-bold leading-snug text-stone-900 md:text-4xl">
                    Mau makan ramai-ramai? Amankan mejanya dulu.
                </h2>

                <ol class="mt-10 divide-y divide-stone-300 border-y border-stone-300">
                    @foreach ($steps as $i => [$title, $desc])
                        <li class="flex gap-6 py-5">
                            <span class="font-display w-10 shrink-0 text-3xl font-bold text-orange-600">{{ sprintf('%02d', $i + 1) }}</span>
                            <div>
                                <h3 class="font-semibold text-stone-900">{{ $title }}</h3>
                                <p class="mt-1 text-sm leading-relaxed text-stone-600">{{ $desc }}</p>
                            </div>
                        </li>
                    @endforeach
                </ol>

                <div class="mt-8">
                    <x-btn :href="route('reservations.create')">Buat Reservasi</x-btn>
                </div>
            </div>

            <aside class="lg:col-span-2">
                <div class="rounded-2xl bg-stone-900 p-8 text-amber-50 ring-1 ring-stone-900">
                    <p class="font-display text-xl font-semibold">Informasi Restoran</p>

                    <dl class="mt-6 space-y-5 text-sm">
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-widest text-orange-400">Jam Buka</dt>
                            <dd class="mt-1 text-stone-200">Setiap hari, 10.00 – 22.00 WIB</dd>
                        </div>
                        <div class="border-t border-stone-700 pt-5">
                            <dt class="text-xs font-semibold uppercase tracking-widest text-orange-400">Alamat</dt>
                            <dd class="mt-1 text-stone-200">Ruko Taman Pondok Indah No. 28A / A28, Jl. Raya Wiyung, Surabaya</dd>
                        </div>
                        <div class="border-t border-stone-700 pt-5">
                            <dt class="text-xs font-semibold uppercase tracking-widest text-orange-400">Telepon</dt>
                            <dd class="mt-1 text-stone-200">0878-8917-0199</dd>
                        </div>
                        <div class="border-t border-stone-700 pt-5">
                            <dt class="text-xs font-semibold uppercase tracking-widest text-orange-400">Catatan</dt>
                            <dd class="mt-1 text-stone-300">Reservasi baru berlaku setelah dikonfirmasi admin.</dd>
                        </div>
                    </dl>
                </div>
            </aside>
        </div>
    </section>

    {{-- Ajakan pesan --}}
    <section class="mx-auto max-w-6xl px-4">
        <div class="relative isolate overflow-hidden rounded-2xl bg-stone-900 px-6 py-16 text-center text-amber-50 md:py-20">
            <img src="{{ asset('images/hero.jpg') }}" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover">
            <div class="absolute inset-0 -z-10 bg-stone-900/75"></div>

            <h2 class="font-display mx-auto max-w-xl text-3xl font-bold leading-snug md:text-4xl">
                Sudah lapar? Pesan sekarang, atau siapkan meja untuk akhir pekan ini.
            </h2>
            <div class="mt-8 flex flex-wrap justify-center gap-3">
                <x-btn :href="route('menu.index')">Pesan Menu</x-btn>
                <x-btn :href="route('reservations.create')" variant="light">Reservasi Meja</x-btn>
            </div>
        </div>
    </section>
</x-app-layout>
