<x-app-layout>
    <div class="mx-auto max-w-6xl px-4 py-8">
        <h1 class="font-display text-3xl font-bold text-stone-900">Daftar Menu</h1>
        <p class="mt-1 text-stone-500">Temukan hidangan favorit Anda.</p>

        {{-- Search --}}
        <form method="GET" action="{{ route('menu.index') }}" class="mt-6 flex flex-col gap-3 sm:flex-row">
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari menu..."
                   class="w-full rounded-full border border-stone-300 px-5 py-2.5 focus:border-orange-500 focus:ring-orange-500">
            <x-btn type="submit">Cari</x-btn>
        </form>

        {{-- Filter kategori --}}
        <div class="mt-4 flex flex-wrap gap-2">
            <a href="{{ route('menu.index', array_filter(['q' => request('q')])) }}"
               class="rounded-full px-4 py-1.5 text-sm font-medium ring-1 {{ ! request('category') ? 'bg-stone-900 text-white ring-stone-900' : 'bg-white text-stone-700 ring-stone-300 hover:bg-stone-100' }}">
                Semua
            </a>
            @foreach ($categories as $category)
                <a href="{{ route('menu.index', array_filter(['category' => $category->slug, 'q' => request('q')])) }}"
                   class="rounded-full px-4 py-1.5 text-sm font-medium ring-1 {{ request('category') === $category->slug ? 'bg-stone-900 text-white ring-stone-900' : 'bg-white text-stone-700 ring-stone-300 hover:bg-stone-100' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        {{-- Daftar --}}
        @if ($menus->isEmpty())
            <x-card class="mt-8 p-10 text-center">
                <p class="text-4xl">🔍</p>
                <p class="mt-3 font-semibold text-stone-800">Menu tidak ditemukan</p>
                <p class="mt-1 text-sm text-stone-500">Coba kata kunci atau kategori lain.</p>
                <div class="mt-5"><x-btn :href="route('menu.index')" variant="outline">Reset Pencarian</x-btn></div>
            </x-card>
        @else
            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($menus as $menu)
                    <x-menu-card :menu="$menu" />
                @endforeach
            </div>

            <div class="mt-8">{{ $menus->links() }}</div>
        @endif
    </div>
</x-app-layout>
