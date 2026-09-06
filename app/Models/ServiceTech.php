<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceTech extends Model
{
    protected $table = 'service_techs';

    protected $fillable = [
        'service_id',
        'text',
        'icon',
        'number',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Services::class, 'service_id');
    }
}