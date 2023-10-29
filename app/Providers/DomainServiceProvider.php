<?php

namespace App\Providers;

use Carbon\Laravel\ServiceProvider;
use Domain\B24\Providers\B24ServiceProvider;
use Domain\Deal\Providers\DealServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(
            DealServiceProvider::class
        );

        $this->app->register(
            B24ServiceProvider::class
        );
    }
}
