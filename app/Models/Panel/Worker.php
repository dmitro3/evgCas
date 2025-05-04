<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = [
        'login',
        'password',
        'telegram_id',
        'percent',
        'daily_bonus',
        'balance',
        'is_banned',
        'google2fa_secret',
        'google2fa_enabled',
    ];

    public function settings()
    {
        return $this->hasOne(WorkerSetting::class);
    }
}
