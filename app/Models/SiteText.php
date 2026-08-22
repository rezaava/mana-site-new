<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteText extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get($key, $default = null)
    {
        $text = self::where('key', $key)->first();
        return $text ? $text->value : $default;
    }
}
