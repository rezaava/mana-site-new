<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceState extends Model
{
    protected $fillable = [
        'service_id',
        'text_1',
        'value_1',
        'text_2',
        'value_2',
        'text_3',
        'value_3',
        'text_4',
        'value_4',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Services::class, 'service_id');
    }
}