<?php

namespace App\Http\Middleware;

use Closure;
use Domain\B24\Actions\PatchEnvironmentAction;
use Domain\B24\Contracts\TokenStorage;
use Domain\B24\DTOs\SettingsDTO;
use Domain\B24\Enums\CacheEnum;
use Domain\B24\Models\Environment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Support\Client\BaseClient;
use Support\Exceptions\ClientException;
use Symfony\Component\HttpFoundation\Response;

class LoadSettings
{
    protected array $except = [
        '/b24/install',
    ];

    public function __construct(
        private readonly PatchEnvironmentAction $patchEnvironmentAction,
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
file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logToken.txt', print_r($this->tokenStorage, true) . "\n", FILE_APPEND);
        $environment = Cache::rememberForever(CacheEnum::SettingsAll->value, function () {
            return Environment::query()->firstOrFail();
        });

        $response = BaseClient::auth($environment);

        $this->patchEnvironmentAction->execute($environment, SettingsDTO::fromArray($response->json()));

        return $next($request);
    }
}
