<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = ['ip_address', 'country', 'region', 'visited_at'];

    protected $casts = [
        'visited_at' => 'datetime'
    ];
}
