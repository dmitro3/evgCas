<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoinFlip extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bet_amount',
        'player_choice',
        'result',
        'multiplier',
        'series_count',
        'status',
        'winnings'
    ];

    protected $casts = [
        'bet_amount' => 'decimal:2',
        'multiplier' => 'decimal:2',
        'winnings' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}