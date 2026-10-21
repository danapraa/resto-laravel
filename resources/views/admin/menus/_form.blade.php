<div class="space-y-5">
    <div>
        <label for="category_id" class="block text-sm font-medium text-stone-700">Kategori</label>
        <select id="category_id" name="category_id" required
                class="mt-1 w-full rounded-xl border border-stone-300 focus:border-orange-500 focus:ring-orange-500">
            <option value="">-- Pilih kategori --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $menu?->category_id) == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="name" class="block text-sm font-medium text-stone-700">Nama Menu</label>
        <input type="text" id="name" name="name" value="{{ old('name', $menu?->name) }}" required maxlength="150"
               class="mt-1 w-full rounded-xl border border-stone-300 focus:border-orange-500 focus:ring-orange-500">
        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-stone-700">Deskripsi</label>
        <textarea id="description" name="description" rows="4" maxlength="1000"
                  class="mt-1 w-full rounded-xl border border-stone-300 focus:border-orange-500 focus:ring-orange-500">{{ old('description', $menu?->description) }}</textarea>
        @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="price" class="block text-sm font-medium text-stone-700">Harga (Rp)</label>
            <input type="number" id="price" name="price" min="0" step="500" value="{{ old('price', $menu?->price) }}" required
                   class="mt-1 w-full rounded-xl border border-stone-300 focus:border-orange-500 focus:ring-orange-500">
            @error('price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-stone-700">Status</label>
            <select id="status" name="status" required
                    class="mt-1 w-full rounded-xl border border-stone-300 focus:border-orange-500 focus:ring-orange-500">
                <option value="available" @selected(old('status', $menu?->status ?? 'available') === 'available')>Tersedia</option>
                <option value="unavailable" @selected(old('status', $menu?->status) === 'unavailable')>Tidak Tersedia</option>
            </select>
            @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label for="image" class="block text-sm font-medium text-stone-700">Foto (JPG, PNG, WEBP, maks 2 MB)</label>
        @if ($menu?->image_url)
            <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="mt-2 h-32 w-48 rounded-xl object-cover ring-1 ring-stone-200">
        @endif
        <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp"
               class="mt-2 block w-full text-sm text-stone-600 file:mr-4 file:rounded-full file:border-0 file:bg-orange-50 file:px-4 file:py-2 file:font-semibold file:text-orange-700 hover:file:bg-orange-100">
        @error('image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="flex flex-wrap gap-3">
        <x-btn type="submit">Simpan</x-btn>
        <x-btn :href="route('admin.menus.index')" variant="outline">Batal</x-btn>
    </div>
</div>
