<?php

namespace Domain\B24\Actions;

use Domain\B24\DTOs\SettingsDTO;
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
        $environment = environment();

        $response = BaseClient::auth($environment);

        $this->patchEnvironmentAction->execute($environment, SettingsDTO::fromArray($response->json()));
    }
}
