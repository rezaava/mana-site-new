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
        'meta',
        'title_head',
        'cat_id',
        'slug',
        'is_active',         
        'display_position',  
    ];
    public function category()
    {
        return $this->belongsTo(Categories::class, 'cat_id', 'id');
    }
    public function tags()
    {
        return $this->hasMany(BlogTag::class, 'blog_id', 'id');
    }
    public function services()
    {
        return $this->belongsToMany(Services::class, 'blog_service', 'blog_id', 'service_id');
    }
}