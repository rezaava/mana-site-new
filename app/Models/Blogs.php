<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use App\Models\Images;

class Blogs extends Model
{
    use HasFactory;

    public $fillable = ['title', 'text', 'image_url', 'reding-time', 'number'];
        public $table = 'blogs';
        public $casts = [
            'reading-time'=> 'integer',
            'number' => 'integer'
        ];
    
        public function images(){
            return $this->hasMany(Images::class);
        }

}
