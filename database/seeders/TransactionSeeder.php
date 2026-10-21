<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $demo  = User::where('email', 'customer@limkoktong.test')->firstOrFail();
        $budi  = User::where('email', 'budi@example.test')->firstOrFail();
        $siti  = User::where('email', 'siti@example.test')->firstOrFail();
        $agus  = User::where('email', 'agus@example.test')->firstOrFail();
        $dewi  = User::where('email', 'dewi@example.test')->firstOrFail();

        // Pesanan
        $this->makeOrder($demo, [['Nasi Goreng Lim Kok Tong', 2], ['Teh Tarik Jahe', 2]], 'completed', 'Tidak pedas.', 10);
        $this->makeOrder($demo, [['Bebek Peking Panggang', 1], ['Siomay Udang', 2]], 'processing', null, 1);
        $this->makeOrder($demo, [['Mie Hokkien Seafood', 1]], 'pending', 'Tanpa udang.', 0);
        $this->makeOrder($budi, [['Ayam Kung Pao', 2], ['Es Lemon Tea', 2]], 'ready', null, 2);
        $this->makeOrder($siti, [['Kwetiau Siram Sapi', 1], ['Kopi Susu Gula Aren', 1]], 'cancelled', 'Salah pesan.', 5);
        $this->makeOrder($agus, [['Ikan Kakap Saus Asam Manis', 1], ['Bubur Kacang Hijau Hangat', 2]], 'pending', null, 0);

        // Reservasi
        $this->makeReservation($demo, now()->addDays(2)->toDateString(), '19:00', 4, '5', 'Ulang tahun keluarga.', 'pending');
        $this->makeReservation($demo, now()->subDays(8)->toDateString(), '12:30', 2, '2', null, 'completed');
        $this->makeReservation($budi, now()->addDays(1)->toDateString(), '18:30', 6, '8', 'Dekat jendela.', 'confirmed');
        $this->makeReservation($dewi, now()->addDays(5)->toDateString(), '20:00', 3, null, null, 'pending');
        $this->makeReservation($siti, now()->subDays(3)->toDateString(), '13:00', 5, '4', null, 'cancelled');
    }

    private function makeOrder(User $user, array $items, string $status, ?string $notes, int $daysAgo): void
    {
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => Order::generateOrderNumber(),
            'total_amount' => 0,
            'status' => $status,
            'notes' => $notes,
        ]);

        $total = 0;

        foreach ($items as [$menuName, $qty]) {
            $menu = Menu::where('name', $menuName)->firstOrFail();
            $subtotal = $menu->price * $qty;

            $order->items()->create([
                'menu_id' => $menu->id,
                'menu_name' => $menu->name,
                'price' => $menu->price,
                'quantity' => $qty,
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        $order->total_amount = $total;
        $order->created_at = now()->subDays($daysAgo);
        $order->save();
    }

    private function makeReservation(User $user, string $date, string $time, int $guests, ?string $table, ?string $notes, string $status): void
    {
        Reservation::create([
            'user_id' => $user->id,
            'reservation_code' => Reservation::generateCode(),
            'reservation_date' => $date,
            'reservation_time' => $time,
            'guest_count' => $guests,
            'table_number' => $table,
            'notes' => $notes,
            'status' => $status,
        ]);
    }
}
