<div class="space-y-5">
    <div>
        <label for="name" class="block text-sm font-medium text-stone-700">Nama Kategori</label>
        <input type="text" id="name" name="name" value="{{ old('name', $category?->name) }}" required maxlength="100"
               class="mt-1 w-full rounded-xl border border-stone-300 focus:border-orange-500 focus:ring-orange-500">
        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-stone-700">Deskripsi (opsional)</label>
        <textarea id="description" name="description" rows="3" maxlength="500"
                  class="mt-1 w-full rounded-xl border border-stone-300 focus:border-orange-500 focus:ring-orange-500">{{ old('description', $category?->description) }}</textarea>
        @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="flex flex-wrap gap-3">
        <x-btn type="submit">Simpan</x-btn>
        <x-btn :href="route('admin.categories.index')" variant="outline">Batal</x-btn>
    </div>
</div>
