<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Team extends Model
{
    use HasFactory;
    public $fillable = ['name', 'title', 'number', 'image_url'];
    public $table = 'team';
    public $casts = [
        'number'=> 'integer',
    ];


    public function images(){
        return $this->belongsTo(Images::class);
    }
}
