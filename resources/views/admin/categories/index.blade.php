<x-admin-layout>
    <x-slot name="header">Kategori Menu</x-slot>

    <div class="mb-4 flex justify-end">
        <x-btn :href="route('admin.categories.create')">+ Tambah Kategori</x-btn>
    </div>

    <x-card class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-stone-50 text-left text-stone-500">
                    <tr>
                        <th class="px-4 py-3 font-medium">Nama</th>
                        <th class="px-4 py-3 font-medium">Slug</th>
                        <th class="px-4 py-3 font-medium">Deskripsi</th>
                        <th class="px-4 py-3 font-medium">Jumlah Menu</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-stone-50">
                            <td class="px-4 py-3 font-semibold text-stone-900">{{ $category->name }}</td>
                            <td class="px-4 py-3 text-stone-500">{{ $category->slug }}</td>
                            <td class="max-w-xs truncate px-4 py-3 text-stone-500">{{ $category->description ?: '-' }}</td>
                            <td class="px-4 py-3">{{ $category->menus_count }}</td>
                            <td class="whitespace-nowrap px-4 py-3 text-right">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="font-semibold text-orange-700 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="ml-3 inline"
                                      onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-10 text-center text-stone-500">Belum ada kategori.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>

    <div class="mt-6">{{ $categories->links() }}</div>
</x-admin-layout>
