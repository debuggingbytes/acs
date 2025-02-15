<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SiteConfiguration extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get($key, $default = null)
    {
        $config = static::where('key', $key)->first();
        return $config ? $config->value : $default;
    }

    public static function set($key, $value)
    {
        return static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    public function getReadableKeyAttribute()
    {
        return Str::title(str_replace('_', ' ', $this->key));
    }
}
