<?php

namespace App\Console\Commands;

use Domain\B24\Actions\AuthAction;
use Domain\B24\Contracts\TokenStorage;
use Domain\Deal\Actions\CreateDealsAction;
use Domain\Deal\Actions\GetDealIdsAction;
use Illuminate\Console\Command;
use Support\Exceptions\ClientException;

class CreateDealsCommand extends Command
{
    protected $signature = 'crm:create-deals';

    protected $description = 'Переносит сделки из CRM в приложение';

    /**
     * @throws ClientException
     */
    public function handle(TokenStorage $tokenStorage, AuthAction $authAction): int
    {
        if (!$tokenStorage->has()) {
            $authAction->execute();
        }

        $dealIds = (new GetDealIdsAction())->execute();

        if ($dealIds) {
            (new CreateDealsAction())->execute($dealIds);
        }

        return self::SUCCESS;
    }
}
