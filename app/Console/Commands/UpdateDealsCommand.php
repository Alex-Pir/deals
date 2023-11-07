<?php

namespace App\Console\Commands;

use Domain\B24\Actions\AuthAction;
use Domain\B24\Contracts\TokenStorage;
use Domain\B24\Enums\Event;
use Domain\Deal\Actions\GetDealIdsAction;
use Domain\Deal\Jobs\UpdateDeals;
use Illuminate\Console\Command;
use Support\Exceptions\ClientException;

class UpdateDealsCommand extends Command
{
    protected $signature = 'crm:update-deals';

    protected $description = 'Обновляет сделки из CRM в приложении';

    /**
     * @throws ClientException
     */
    public function handle(TokenStorage $tokenStorage, AuthAction $authAction): int
    {
        if (!$tokenStorage->has()) {
            $authAction->execute();
        }

        $dealIds = (new GetDealIdsAction())->execute(Event::DealUpdate);

        if ($dealIds) {
            UpdateDeals::dispatch($dealIds);
        }

        return self::SUCCESS;
    }

}
