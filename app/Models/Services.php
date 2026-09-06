<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Services extends Model
{
    protected $fillable = [
        'title',
        'text',
        'description',
        'number',
        'icon',

        'delivery_time',
        'price_text',
        'support',

        'suitable_for',
        'contract',

        'overview_title',
        'overview_text',
        'overview_text_2',

        'challenge_title',
        'challenge_text',

        'solution_title',
        'solution_text',

        'quote_text',
        'quote_person',
        'quote_role',

        'cta_title',
        'cta_text',
    ];

    public function states(): HasMany
    {
        return $this->hasMany(ServiceState::class, 'service_id');
    }

    public function whatReceives(): HasMany
    {
        return $this->hasMany(ServiceWhatReceive::class, 'service_id')
            ->orderBy('number');
    }

    public function techs(): HasMany
    {
        return $this->hasMany(ServiceTech::class, 'service_id')
            ->orderBy('number');
    }

    public function projectServices(): HasMany
    {
        return $this->hasMany(ProjectServices::class, 'service_id');
    }
        public function images(){
        return $this->hasMany(Images::class);
    }
}