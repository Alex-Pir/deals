<?php

namespace Domain\B24\Providers;

use Illuminate\Support\ServiceProvider;

class B24ServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

    }

    public function register(): void
    {
        $this->app->register(
            ActionsServiceProvider::class
        );
    }
}
