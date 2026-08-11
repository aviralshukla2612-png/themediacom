<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    protected $guarded = [];

    protected static function booted()
    {
        static::saved(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('global_seo_settings');
        });
        static::deleted(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('global_seo_settings');
        });
    }
}
