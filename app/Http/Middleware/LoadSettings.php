<?php

namespace App\Http\Middleware;

use Closure;
use Domain\B24\Actions\PatchEnvironmentAction;
use Domain\B24\DTOs\SettingsDTO;
use Domain\B24\Enums\CacheEnum;
use Domain\B24\Models\Environment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Support\Client\Client;
use Support\Exceptions\ClientException;
use Symfony\Component\HttpFoundation\Response;

class LoadSettings
{
    protected array $except = [
        '/b24/install',
    ];

    public function __construct(private readonly PatchEnvironmentAction $patchEnvironmentAction)
    {
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

        if ($request->session()->has(config('session.token_key'))) {
            return $next($request);
        }

        $environment = Cache::rememberForever(CacheEnum::SettingsAll->value, function () {
            return Environment::query()->firstOrFail();
        });

        $response = Client::auth($environment);

        $this->patchEnvironmentAction->execute($environment, SettingsDTO::fromArray($response->json()));

        return $next($request);
    }
}
