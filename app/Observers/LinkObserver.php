<?php

namespace App\Observers;

use App\Models\Link;
use Illuminate\Support\Facades\Cache;
class LinkObserver
{
    /**
     * @param Link $link
     */
    public function created(Link $link)
    {
        //
    }

    public function updated(Link $link)
    {
        //
    }

    //在保存时清空cache_key对应的缓存
    public function saved(Link $link)
    {
        Cache::forget($link->cache_key);
    }

    public function deleted(Link $link)
    {
        //
    }

    public function restored(Link $link)
    {
        //
    }

    public function forceDeleted(Link $link)
    {
        //
    }
}
