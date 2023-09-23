<?php

namespace Domain\B24\Tokens;

use Domain\B24\Contracts\TokenStorage;
use Illuminate\Support\Facades\Cache;

class CacheToken implements TokenStorage
{
    protected const CACHE_KEY = 'TOKEN_KEY';
    protected const CACHE_TTL = 300;

    public function has(): bool
    {
        return Cache::has(static::CACHE_KEY);
    }

    public function get(): string
    {
        return Cache::get(static::CACHE_KEY);
    }

    public function set(string $token): void
    {
        Cache::set(static::CACHE_KEY, $token, static::CACHE_TTL);
    }
}
