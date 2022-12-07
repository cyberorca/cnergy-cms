<?php

namespace App\Http\Utils;

use Illuminate\Support\Facades\Cache;

class CacheStorage
{
    public static function cache($cache_key, $model)
    {
        $cache_array = array();
        if (Cache::has($model)) {
            $cache_array = Cache::get($model);
            array_push($cache_array, $cache_key);
            Cache::forever($model, $cache_array);
        } else {
            $cache_array = [$cache_key];
            Cache::forever($model, $cache_array);
        }
    }
}
