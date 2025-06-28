<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mine extends Model
{
    protected $fillable = [
        'play_map',
        'bet_amount',
        'mines_count',
        'user_id',
    ];

    protected $casts = [
        'play_map' => 'array',
        'bet_amount' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
