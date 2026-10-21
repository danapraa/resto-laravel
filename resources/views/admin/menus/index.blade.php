<x-admin-layout>
    <x-slot name="header">Kelola Menu</x-slot>

    <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <form method="GET" action="{{ route('admin.menus.index') }}" class="flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama menu..."
                   class="w-full rounded-full border border-stone-300 px-4 py-2 text-sm focus:border-orange-500 focus:ring-orange-500 sm:w-64">
            <x-btn type="submit" variant="dark">Cari</x-btn>
        </form>
        <x-btn :href="route('admin.menus.create')">+ Tambah Menu</x-btn>
    </div>

    <x-card class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-stone-50 text-left text-stone-500">
                    <tr>
                        <th class="px-4 py-3 font-medium">Foto</th>
                        <th class="px-4 py-3 font-medium">Nama</th>
                        <th class="px-4 py-3 font-medium">Kategori</th>
                        <th class="px-4 py-3 font-medium">Harga</th>
                        <th class="px-4 py-3 font-medium">Status</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse ($menus as $menu)
                        <tr class="hover:bg-stone-50">
                            <td class="px-4 py-3">
                                <div class="h-12 w-16 overflow-hidden rounded-lg bg-gradient-to-br from-amber-100 to-orange-200">
                                    @if ($menu->image_url)
                                        <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center text-xl">🍜</div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-3 font-semibold text-stone-900">{{ $menu->name }}</td>
                            <td class="px-4 py-3">{{ $menu->category->name }}</td>
                            <td class="whitespace-nowrap px-4 py-3">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3"><x-status-badge :status="$menu->status" /></td>
                            <td class="whitespace-nowrap px-4 py-3 text-right">
                                <a href="{{ route('admin.menus.edit', $menu) }}" class="font-semibold text-orange-700 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('admin.menus.destroy', $menu) }}" class="ml-3 inline"
                                      onsubmit="return confirm('Hapus menu ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-4 py-10 text-center text-stone-500">Belum ada menu.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>

    <div class="mt-6">{{ $menus->links() }}</div>
</x-admin-layout>
