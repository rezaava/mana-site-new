<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    use HasFactory;
    public $fillable = ['name', 'title', 'number', 'image_url'];
    public $table = 'teams';
    public $casts = [
        'number'=> 'integer',
    ];
}
