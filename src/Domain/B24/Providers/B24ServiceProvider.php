<?php

namespace Domain\B24\Providers;

use Domain\B24\Contracts\TokenStorage;
use Domain\B24\Tokens\CacheToken;
use Illuminate\Support\ServiceProvider;

class B24ServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(
            EventServiceProvider::class
        );

        $this->app->bind(TokenStorage::class, CacheToken::class);
    }
}
