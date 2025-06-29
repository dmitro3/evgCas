<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bet_amount',
        'target_number',
        'roll_result',
        'multiplier',
        'status',
        'winnings'
    ];

    protected $casts = [
        'bet_amount' => 'decimal:2',
        'target_number' => 'decimal:2',
        'roll_result' => 'decimal:2',
        'multiplier' => 'decimal:2',
        'winnings' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}