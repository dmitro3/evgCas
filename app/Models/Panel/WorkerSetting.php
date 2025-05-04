<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Model;

class WorkerSetting extends Model
{
    protected $fillable = [
        'worker_id',
        'win_mode',
        'abuse_promo',
        'verification_mode',
        'fake_withdraw',
        'multy_account',
        'minimal_deposit',
        'minimal_withdraw',
        'keyword_email',
        'payment_methods',
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }



}
