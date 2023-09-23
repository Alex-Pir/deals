<?php

namespace Domain\B24\Actions;

use Domain\B24\Enums\Event;
use Domain\B24\Models\Environment;
use Support\Client\BaseClient;

class CreateEventHandlersAction
{
    public function execute(Environment $environment): void
    {
        foreach (Event::cases() as $event) {
            BaseClient::registrationOfHandler($event, $environment);
        }
    }
}
