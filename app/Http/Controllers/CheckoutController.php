<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::with('items.menu')->where('user_id', auth()->id())->first();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda masih kosong.');
        }

        $total = $cart->items->sum(fn ($item) => $item->quantity * $item->menu->price);

        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $cart = Cart::with('items.menu')->where('user_id', auth()->id())->first();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda masih kosong.');
        }

        foreach ($cart->items as $item) {
            if ($item->menu->status !== 'available') {
                return redirect()->route('cart.index')
                    ->with('error', 'Menu "' . $item->menu->name . '" sudah tidak tersedia. Hapus dari keranjang untuk melanjutkan.');
            }
        }

        $order = DB::transaction(function () use ($cart, $data) {
            $total = $cart->items->sum(fn ($item) => $item->quantity * $item->menu->price);

            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $total,
                'status' => 'pending',
                'notes' => $data['notes'] ?? null,
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'menu_id' => $item->menu_id,
                    'menu_name' => $item->menu->name,
                    'price' => $item->menu->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->quantity * $item->menu->price,
                ]);
            }

            $cart->items()->delete();

            return $order;
        });

        return redirect()->route('orders.show', $order)->with('success', 'Pesanan berhasil dibuat. Terima kasih!');
    }
}
