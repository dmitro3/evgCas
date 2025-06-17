<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlotSession extends Model
{
    protected $fillable = ['slot_id', 'user_id', 'session_id'];

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }


}
