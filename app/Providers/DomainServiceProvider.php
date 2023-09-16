<?php

namespace App\Providers;

use Carbon\Laravel\ServiceProvider;
use Domain\Template\Providers\TemplateServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(
            \Domain\B24\Providers\B24ServiceProvider::class
        );

        $this->app->register(
            TemplateServiceProvider::class
        );
    }
}
