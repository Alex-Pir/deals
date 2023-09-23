<?php

namespace Domain\B24\Contracts;

interface TokenStorage
{
    public function has(): bool;
    public function get(): string;
    public function set(string $token): void;
}
