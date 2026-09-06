<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $table = 'categories';

    public function projects()
    {
        return $this->hasMany(
            Projects::class,
            'cat_id',
            'id'
        );
    }

    public function blogs()
    {
        return $this->hasMany(
            Blogs::class,
            'cat_id',
            'id'
        );
    }
}