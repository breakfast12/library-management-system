<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Cache;

trait FlushCacheTrait
{
    /**
     * Flush the cache for the given tags.
     *
     * @param  array|string  $tags
     * @return void
     */
    public function flushCache($tags)
    {
        Cache::tags((array) $tags)->flush();
    }
}
