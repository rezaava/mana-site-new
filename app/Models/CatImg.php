<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatImg extends Model
{
    use HasFactory;

    protected $table = 'cat_imgs';

    protected $fillable = [
        'title',
        'number',
    ];

    protected $casts = [
        'number' => 'integer',
    ];

    // تصاویر پروژه‌های این دسته
    public function galleries()
    {
        return $this->hasMany(ProjectGallery::class, 'cat_img_id');
    }
}