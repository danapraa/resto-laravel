<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = auth()->user()->reservations()
            ->orderByDesc('reservation_date')
            ->orderByDesc('reservation_time')
            ->paginate(8);

        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        return view('reservations.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'reservation_date' => ['required', 'date', 'after_or_equal:today'],
            'reservation_time' => ['required', 'date_format:H:i'],
            'guest_count' => ['required', 'integer', 'min:1', 'max:50'],
            'table_number' => ['nullable', 'string', 'max:10'],
            'notes' => ['nullable', 'string', 'max:500'],
        ], [
            'reservation_date.required' => 'Tanggal reservasi wajib diisi.',
            'reservation_date.date' => 'Format tanggal tidak valid.',
            'reservation_date.after_or_equal' => 'Tanggal reservasi tidak boleh di masa lalu.',
            'reservation_time.required' => 'Waktu reservasi wajib diisi.',
            'reservation_time.date_format' => 'Format waktu tidak valid.',
            'guest_count.required' => 'Jumlah orang wajib diisi.',
            'guest_count.integer' => 'Jumlah orang harus berupa angka.',
            'guest_count.min' => 'Jumlah orang minimal 1.',
            'guest_count.max' => 'Jumlah orang maksimal 50.',
        ]);

        $reservation = Reservation::create([
            'user_id' => auth()->id(),
            'reservation_code' => Reservation::generateCode(),
            'reservation_date' => $data['reservation_date'],
            'reservation_time' => $data['reservation_time'],
            'guest_count' => $data['guest_count'],
            'table_number' => $data['table_number'] ?? null,
            'notes' => $data['notes'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('reservations.show', $reservation)
            ->with('success', 'Reservasi berhasil dibuat dan menunggu konfirmasi.');
    }

    public function show(Reservation $reservation)
    {
        abort_unless($reservation->user_id === auth()->id(), 403);

        return view('reservations.show', compact('reservation'));
    }
}
