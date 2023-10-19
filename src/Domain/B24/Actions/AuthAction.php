<?php

namespace Domain\B24\Actions;

use Domain\B24\DTOs\SettingsDTO;
use Domain\B24\Enums\CacheEnum;
use Domain\B24\Models\Environment;
use Illuminate\Support\Facades\Cache;
use Support\Client\BaseClient;
use Support\Exceptions\ClientException;

class AuthAction
{
    public function __construct(
        private readonly PatchEnvironmentAction $patchEnvironmentAction,
    ) {
    }

    /**
     * @throws ClientException
     */
    public function execute(): void
    {
        $environment = Cache::rememberForever(
            CacheEnum::SettingsAll->value,
            fn () => Environment::query()->firstOrFail()
        );

        $response = BaseClient::auth($environment);

        $this->patchEnvironmentAction->execute($environment, SettingsDTO::fromArray($response->json()));
    }
}
