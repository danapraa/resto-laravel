@if (session('success'))
    <div x-data="{ show: true }" x-show="show" class="mb-4 flex items-start justify-between gap-3 rounded-xl bg-green-50 px-4 py-3 text-sm text-green-800 ring-1 ring-green-200">
        <span>{{ session('success') }}</span>
        <button type="button" @click="show = false" class="font-bold leading-none text-green-700" aria-label="Tutup">&times;</button>
    </div>
@endif

@if (session('error'))
    <div x-data="{ show: true }" x-show="show" class="mb-4 flex items-start justify-between gap-3 rounded-xl bg-red-50 px-4 py-3 text-sm text-red-800 ring-1 ring-red-200">
        <span>{{ session('error') }}</span>
        <button type="button" @click="show = false" class="font-bold leading-none text-red-700" aria-label="Tutup">&times;</button>
    </div>
@endif
