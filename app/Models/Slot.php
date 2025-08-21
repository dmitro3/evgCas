<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $fillable = ['id_game', 'name', 'description', 'image', 'route', 'type', 'is_active', 'rtp'];

    public function slotSessions()
    {
        return $this->hasMany(SlotSession::class, 'slot_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
