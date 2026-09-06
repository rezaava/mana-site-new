<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceWhatReceive extends Model
{
    protected $fillable = [
        'service_id',
        'title',
        'text',
        'icon',
        'number',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Services::class, 'service_id');
    }
}