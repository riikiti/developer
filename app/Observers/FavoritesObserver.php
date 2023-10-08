<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

class FavoritesObserver
{
    public function created(){
        Cache::forget("user_favorites");
    }
}
