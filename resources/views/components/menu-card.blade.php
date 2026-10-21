@props(['menu'])

<div class="group flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-stone-200 transition hover:shadow-lg">
    <a href="{{ route('menu.show', $menu->slug) }}" class="block aspect-[4/3] overflow-hidden bg-gradient-to-br from-amber-100 to-orange-200">
        @if ($menu->image_url)
            <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
        @else
            <div class="flex h-full w-full items-center justify-center text-5xl">🍜</div>
        @endif
    </a>

    <div class="flex flex-1 flex-col p-4">
        <div class="flex items-center justify-between gap-2 text-xs">
            <span class="font-medium text-orange-700">{{ $menu->category->name }}</span>
            <x-status-badge :status="$menu->status" />
        </div>

        <h3 class="font-display mt-2 text-lg font-semibold text-stone-900">{{ $menu->name }}</h3>
        <p class="mt-1 line-clamp-2 text-sm text-stone-500">{{ $menu->description }}</p>

        <div class="mt-auto flex items-center justify-between gap-2 pt-4">
            <span class="font-bold text-stone-900">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
            <x-btn :href="route('menu.show', $menu->slug)" variant="outline">Detail</x-btn>
        </div>
    </div>
</div>
