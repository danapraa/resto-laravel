<x-admin-layout>
    <x-slot name="header">Daftar Customer</x-slot>

    <x-card class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-stone-50 text-left text-stone-500">
                    <tr>
                        <th class="px-4 py-3 font-medium">Nama</th>
                        <th class="px-4 py-3 font-medium">Email</th>
                        <th class="px-4 py-3 font-medium">Jumlah Pesanan</th>
                        <th class="px-4 py-3 font-medium">Jumlah Reservasi</th>
                        <th class="px-4 py-3 font-medium">Tanggal Registrasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse ($customers as $customer)
                        <tr class="hover:bg-stone-50">
                            <td class="px-4 py-3 font-semibold text-stone-900">{{ $customer->name }}</td>
                            <td class="px-4 py-3">{{ $customer->email }}</td>
                            <td class="px-4 py-3">{{ $customer->orders_count }}</td>
                            <td class="px-4 py-3">{{ $customer->reservations_count }}</td>
                            <td class="whitespace-nowrap px-4 py-3">{{ $customer->created_at->translatedFormat('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-10 text-center text-stone-500">Belum ada customer.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>

    <div class="mt-6">{{ $customers->links() }}</div>
</x-admin-layout>
