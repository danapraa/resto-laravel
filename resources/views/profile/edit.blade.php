<x-app-layout>
    <div class="mx-auto max-w-3xl space-y-6 px-4 py-8">
        <h1 class="font-display text-3xl font-bold text-stone-900">Profil Saya</h1>

        <x-card class="p-6 sm:p-8">
            @include('profile.partials.update-profile-information-form')
        </x-card>

        <x-card class="p-6 sm:p-8">
            @include('profile.partials.update-password-form')
        </x-card>
    </div>
</x-app-layout>
