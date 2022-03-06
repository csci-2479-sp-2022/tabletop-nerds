<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\GameInterface;
use App\Services\GameService;
use App\Contracts\AccountInterface;
use App\Services\AccountService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GameInterface::class, GameService::class);
        $this->app->bind(AccountInterface::class, AccountService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
