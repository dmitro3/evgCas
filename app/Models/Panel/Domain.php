<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = [
        'domain',
        'worker_id',
        'status',
        'ns',
        'zone_id',
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public $casts = [
        'ns' => 'array',
    ];
}
