<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $reservations = Reservation::with('user')
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->orderByDesc('reservation_date')
            ->orderByDesc('reservation_time')
            ->paginate(10)
            ->withQueryString();

        return view('admin.reservations.index', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        $reservation->load('user');

        return view('admin.reservations.show', compact('reservation'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(array_keys(Reservation::STATUS_LABELS))],
            'table_number' => ['nullable', 'string', 'max:10'],
        ]);

        $reservation->update($data);

        return back()->with('success', 'Reservasi berhasil diperbarui.');
    }
}
