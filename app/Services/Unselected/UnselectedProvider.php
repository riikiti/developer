<?php

namespace App\Services\Unselected;


use Illuminate\Support\ServiceProvider;

class UnselectedProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Unselected::class,UnselectedService::class);
    }
}
