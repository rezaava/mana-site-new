<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFeature extends Model
{
    use HasFactory;

    protected $table = 'project_features';

    protected $fillable = [
        'icon',
        'title',
        'text',
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Projects::class, 'project_id', 'id');
    }
}