<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socials extends Model
{
    use HasFactory;
    public $fillable = ['name', 'image_url', 'url'];
    public $table = 'socials';
}
