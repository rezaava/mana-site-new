<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['user_name', 'email', 'subject', 'message', 'status'];

    protected $casts = [
        'status' => 'string'
    ];
}
