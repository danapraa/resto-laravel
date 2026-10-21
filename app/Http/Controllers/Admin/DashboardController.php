<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'menus' => Menu::count(),
            'customers' => User::where('role', 'customer')->count(),
            'orders' => Order::count(),
            'reservations' => Reservation::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'pending_reservations' => Reservation::where('status', 'pending')->count(),
        ];

        $latestOrders = Order::with('user')->latest()->take(5)->get();
        $latestReservations = Reservation::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestOrders', 'latestReservations'));
    }
}
