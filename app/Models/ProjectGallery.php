<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectGallery extends Model
{
    protected $fillable = ['project_id', 'category', 'image_url'];

    public function project()
    {
        return $this->belongsTo(Projects::class, 'project_id');
    }
}
