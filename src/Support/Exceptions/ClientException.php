<?php

namespace Support\Exceptions;

use Exception;

class ClientException extends Exception
{
    public static function requestError(string $methodNameOrUrl): self
    {
        return new self("Can't get data for $methodNameOrUrl");
    }
}
