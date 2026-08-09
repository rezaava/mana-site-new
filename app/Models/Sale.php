<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'text', 'image_url', 'price', 'number'];

    protected $table = 'sales';

    protected $casts = [
        'price' => 'integer',
        'number' => 'integer'
    ];
}
