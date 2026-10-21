<x-admin-layout>
    <x-slot name="header">Edit Kategori</x-slot>

    <x-card class="max-w-2xl p-6 sm:p-8">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf @method('PUT')
            @include('admin.categories._form', ['category' => $category])
        </form>
    </x-card>
</x-admin-layout>
