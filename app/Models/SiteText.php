<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteText extends Model
{
    use HasFactory;

    protected $table = 'site_texts';
    protected $fillable = ['key', 'value'];

    public static function get($key, $default = null)
    {
        $record = self::where('key', $key)->first();
        return $record ? $record->value : $default;
    }
}