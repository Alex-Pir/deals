<?php

namespace Domain\B24\Tokens;

use Domain\B24\Contracts\TokenStorage;
use Illuminate\Support\Carbon;

class SessionToken implements TokenStorage
{
    public function has(): bool
    {
        $sessionTokenKey = config('session.token_key');
        $sessionTokenCreatedAtKey = config('session.token_created_at');

        return request()->session()->has($sessionTokenKey)
            && request()->session()->has($sessionTokenCreatedAtKey)
            && Carbon::parse(request()->session()->get($sessionTokenCreatedAtKey))->addSeconds(
                config('b24.token_lifetime')
            )->gt(now());
    }

    public function get(): ?string
    {
        return request()->session()->get(config('session.token_key'));
    }

    public function set(string $token): void
    {
        request()->session()->put(config('session.token_key'), $token);
        request()->session()->put(config('session.token_create_at'), now());
    }
}
