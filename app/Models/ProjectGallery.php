<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectGallery extends Model
{
    use HasFactory;

    protected $table = 'project_galleries';

    protected $fillable = [
        'project_id',
        'cat_img_id',
        'image_url',
    ];

    // پروژه مربوط به تصویر
    public function project()
    {
        return $this->belongsTo(Projects::class, 'project_id');
    }

    // دسته‌بندی تصویر
    public function category()
    {
        return $this->belongsTo(CatImg::class, 'cat_img_id');
    }
}