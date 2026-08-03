<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Images;


class Features extends Model
{
    use HasFactory;
    public $fillable = ['text', 'image_url', 'type', 'sub-id'];
    public $table = 'features';
    public $casts = [
        'type'=> 'integer',
        'sub-id' => 'integer'
    ];

    public function images(){
        return $this->hasMany(Images::class);
    }
}
