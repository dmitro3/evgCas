<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationApplication extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'birth_date',
        'country',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
