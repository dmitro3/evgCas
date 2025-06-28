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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assistant()
    {
        return $this->belongsTo(Assistant::class);
    }

    protected $casts = [
        'created_at' => 'datetime:d.m.Y H:i',
    ];

}
