<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Images;

class Services extends Model
{
    use HasFactory;
    public $table = 'services';
    public $fillable = ['title', 'text', 'image_url', 'number', 'icon'];

    public function images(){
        return $this->hasMany(Images::class);
    }
}
