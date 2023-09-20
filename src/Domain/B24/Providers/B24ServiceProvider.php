<?php

namespace Domain\B24\Providers;

use Illuminate\Support\ServiceProvider;

class B24ServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(
            ActionsServiceProvider::class
        );

        $this->app->register(
            EventServiceProvider::class
        );
    }
}
