<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'text',
        'image_url',
        'reading-time',
        'number',
        'cat_id',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'cat_id', 'id');
    }
    
    public function tags()
    {
        return $this->hasMany(BlogTag::class, 'blog_id', 'id');
    }
}
