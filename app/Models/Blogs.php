<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use App\Models\Images;

class Blogs extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'text', 'image_url', 'reading-time', 'number'];
    protected $table = 'blogs';
    protected $casts = [
        'reading-time' => 'integer',
        'number' => 'integer'
];
    
        public function images(){
            return $this->hasMany(Images::class);
        }

}
