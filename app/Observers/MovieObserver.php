<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

class MovieObserver
{
    public function created(){
        Cache::forget("all_movies");
    }
}
