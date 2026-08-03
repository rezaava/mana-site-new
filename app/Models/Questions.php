<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Questions extends Model
{
    use HasFactory;

    public $fillable = ['title', 'answer', 'number'];
    public $table = 'questions';
    public $casts = [
        'number' => 'integer',
    ];

    
}
