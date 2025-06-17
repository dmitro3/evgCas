<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['user_id', 'worker_id', 'assistant_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function worker()
    {
        return $this->belongsTo(Panel\Worker::class);
    }

    public function assistant()
    {
        return $this->belongsTo(Assistant::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
