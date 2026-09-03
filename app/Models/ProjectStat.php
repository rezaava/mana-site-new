<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectStat extends Model
{
    protected $fillable = ['project_id', 'value', 'label'];

    public function project()
    {
        return $this->belongsTo(Projects::class, 'project_id');
    }
}
