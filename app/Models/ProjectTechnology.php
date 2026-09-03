<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTechnology extends Model
{
    use HasFactory;

    protected $table = 'project_technologies';
    protected $fillable = ['project_id', 'name', 'icon', 'order'];

    public function project()
    {
        return $this->belongsTo(Projects::class, 'project_id');
    }
}