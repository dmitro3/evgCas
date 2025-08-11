<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CrashBet extends Model
{
    protected $fillable = [
        'user_id',
        'game_id',
        'bet_amount',
        'multiplier',
        'auto_cash_out',
        'status'
    ];

    protected $casts = [
        'bet_amount' => 'float',
        'multiplier' => 'float',
        'auto_cash_out' => 'float',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(CrashGames::class, 'game_id');
    }
}
