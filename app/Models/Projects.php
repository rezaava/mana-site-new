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
    public $fillable = ['title', 'brief', 'desc', 'cat-id', 'image_url'];
    public $casts = [
        'cat-id' => 'integer',
    ];

    public function Images(){
        return $this->hasMany(Images::class);
    }
}
