<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['chat_id', 'user_id', 'assistant_id', 'message', 'type', 'rule_id', 'read_at'];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }


}
