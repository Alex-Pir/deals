<?php

namespace Domain\B24\Tokens;

use Domain\B24\Contracts\TokenStorage;

class SessionToken implements TokenStorage
{
    public function has(): bool
    {
        return request()->session()->has(config('session.token_key'));
    }

    public function get(): ?string
    {
        return request()->session()->get(config('session.token_key'));
    }

    public function set(string $token): void
    {
        request()->session()->put(config('session.token_key'), $token);
    }
}
