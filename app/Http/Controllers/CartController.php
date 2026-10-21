<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        $cart->load('items.menu');

        // Samakan harga keranjang dengan harga menu terbaru
        foreach ($cart->items as $item) {
            if ($item->price != $item->menu->price) {
                $item->update(['price' => $item->menu->price]);
            }
        }

        return view('cart.index', compact('cart'));
    }

    public function store(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1', 'max:99'],
        ]);

        $quantity = $data['quantity'] ?? 1;

        if ($menu->status !== 'available') {
            return back()->with('error', 'Menu ini sedang tidak tersedia.');
        }

        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        $item = $cart->items()->where('menu_id', $menu->id)->first();

        if ($item) {
            $item->update([
                'quantity' => min(99, $item->quantity + $quantity),
                'price' => $menu->price,
            ]);
        } else {
            $cart->items()->create([
                'menu_id' => $menu->id,
                'quantity' => $quantity,
                'price' => $menu->price,
            ]);
        }

        return back()->with('success', $menu->name . ' ditambahkan ke keranjang.');
    }

    public function update(Request $request, CartItem $item)
    {
        abort_unless($item->cart->user_id === auth()->id(), 403);

        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $item->update(['quantity' => $data['quantity']]);

        return back()->with('success', 'Jumlah menu diperbarui.');
    }

    public function destroy(CartItem $item)
    {
        abort_unless($item->cart->user_id === auth()->id(), 403);

        $item->delete();

        return back()->with('success', 'Menu dihapus dari keranjang.');
    }
}
