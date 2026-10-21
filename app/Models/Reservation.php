<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Reservation extends Model
{
    public const STATUS_LABELS = [
        'pending'   => 'Menunggu',
        'confirmed' => 'Dikonfirmasi',
        'completed' => 'Selesai',
        'cancelled' => 'Dibatalkan',
    ];

    protected $fillable = [
        'user_id',
        'reservation_code',
        'reservation_date',
        'reservation_time',
        'guest_count',
        'table_number',
        'notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'reservation_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function generateCode(): string
    {
        do {
            $code = 'RSV-' . strtoupper(Str::random(6));
        } while (static::where('reservation_code', $code)->exists());

        return $code;
    }
}
