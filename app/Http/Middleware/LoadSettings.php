<?php

namespace App\Http\Middleware;

use Closure;
use Domain\B24\Actions\AuthAction;
use Domain\B24\Contracts\TokenStorage;
use Illuminate\Http\Request;
use Support\Exceptions\ClientException;
use Symfony\Component\HttpFoundation\Response;

class LoadSettings
{
    protected array $except = [
        '/b24/install',
    ];

    public function __construct(
        private readonly AuthAction $authAction,
        private readonly TokenStorage $tokenStorage
    ) {
    }

    /**
     * @throws ClientException
     */
    public function handle(Request $request, Closure $next): Response
    {
        foreach ($this->except as $value) {
            if ($request->fullUrlIs("*$value*")) {
                return $next($request);
            }
        }

        if ($this->tokenStorage->has()) {
            return $next($request);
        }

        $this->authAction->execute();

        return $next($request);
    }
}
