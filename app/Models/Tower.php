<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tower extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bet_amount',
        'mines_per_row',
        'current_level',
        'game_map',
        'revealed_cells',
        'status',
        'winnings'
    ];

    protected $casts = [
        'game_map' => 'array',
        'revealed_cells' => 'array',
        'bet_amount' => 'decimal:2',
        'winnings' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}