<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Images;

class Projects extends Model
{
    use HasFactory;
    public $table = 'projects';
    public $fillable = ['title', 'brief', 'desc', 'cat_id', 'image_url','number', 'challenge',
        'solution'];
    public $casts = [
        'cat_id' => 'integer',
        'number' => 'integer'
    ];

    public function Images(){
        return $this->hasMany(Images::class);
    }
}
