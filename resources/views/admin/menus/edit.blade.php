<x-admin-layout>
    <x-slot name="header">Edit Menu</x-slot>

    <x-card class="max-w-2xl p-6 sm:p-8">
        <form method="POST" action="{{ route('admin.menus.update', $menu) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.menus._form', ['menu' => $menu])
        </form>
    </x-card>
</x-admin-layout>
