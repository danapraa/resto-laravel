<x-admin-layout>
    <x-slot name="header">Tambah Menu</x-slot>

    <x-card class="max-w-2xl p-6 sm:p-8">
        <form method="POST" action="{{ route('admin.menus.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.menus._form', ['menu' => null])
        </form>
    </x-card>
</x-admin-layout>
