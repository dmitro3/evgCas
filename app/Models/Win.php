<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Win extends Model
{
    protected $fillable = ['amount', 'game_id', 'bet_amount', 'random_username'];

    /**
     * Get the game that owns the win.
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Slot::class, 'game_id');
    }

}
