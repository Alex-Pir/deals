<?php

namespace Domain\B24\Exceptions;

use Exception;

class InstallException extends Exception
{
    public static function installError(array $fields): self
    {
        return new self('Install error with fields: ' . implode(', ', $fields));
    }
}
