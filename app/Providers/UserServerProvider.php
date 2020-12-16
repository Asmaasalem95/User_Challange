<?php

namespace App\Providers;

use App\Contracts\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class UserServerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class,UserRepositoryInterface::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
