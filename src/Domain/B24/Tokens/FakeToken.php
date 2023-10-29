<?php

namespace Domain\B24\Tokens;

use Domain\B24\Contracts\TokenStorage;

class FakeToken implements TokenStorage
{
    public function has(): bool
    {
        return true;
    }

    public function get(): ?string
    {
        return 'test_token';
    }

    public function set(string $token): void
    {
        return;
    }
}
