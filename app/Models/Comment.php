<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_name', 'content', 'is_approved'];

    protected $casts = [
        'is_approved' => 'boolean'
    ];
}
