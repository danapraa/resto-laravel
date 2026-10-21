<div x-data="{ open: false }"
     x-on:open-logout.window="open = true"
     x-on:keydown.escape.window="open = false"
     x-effect="document.body.classList.toggle('overflow-hidden', open)"
     x-show="open"
     x-cloak
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-[100] flex items-center justify-center p-4"
     role="dialog" aria-modal="true" aria-labelledby="logout-title">

    {{-- Latar gelap --}}
    <div class="absolute inset-0 bg-stone-900/60 backdrop-blur-sm" x-on:click="open = false"></div>

    {{-- Kotak dialog --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 scale-90"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-2 scale-95"
         class="relative w-full max-w-sm rounded-2xl bg-white p-6 text-center shadow-2xl ring-1 ring-stone-200">

        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-orange-100 text-orange-600">
            <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
            </svg>
        </div>

        <h3 id="logout-title" class="font-display mt-4 text-xl font-bold text-stone-900">Yakin ingin keluar?</h3>
        <p class="mt-2 text-sm text-stone-500">Anda akan keluar dari akun ini. Anda bisa masuk kembali kapan saja.</p>

        <div class="mt-6 flex gap-3">
            <x-btn type="button" variant="outline" class="flex-1" x-on:click="open = false">Batal</x-btn>

            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                @csrf
                <x-btn type="submit" variant="danger" class="w-full">Ya, Keluar</x-btn>
            </form>
        </div>
    </div>
</div>
