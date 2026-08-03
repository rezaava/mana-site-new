<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Services;
use App\Models\Projects;
use App\Models\Features;



class Images extends Model
{
    use HasFactory;
    public $fillable = ['type', 'url', 'sub-id'];
    public $table = 'images';
    public $casts = [
        'type'=> 'integer',
        'sub-id' => 'integer'
    ];

    public function services(){
        return $this->belongsTo(Services::class);
    }

    public function projects(){
        return $this->belongsTo(Projects::class);
    }

    public function features(){
        return $this->belongsTo(Features::class);
    }
    
}
