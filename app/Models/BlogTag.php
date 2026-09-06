<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    use HasFactory;

    protected $table = 'blog_tags';

    protected $fillable = [
        'blog_id',
        'text',
    ];

    public function blog()
    {
        return $this->belongsTo(Blogs::class, 'blog_id');
    }
}