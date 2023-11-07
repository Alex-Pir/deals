<?php

namespace Domain\B24\Actions;

use Domain\B24\Enums\Event;
use Support\Client\EventClient;

class CreateEventHandlersAction
{
    public function execute(): void
    {
        foreach (Event::cases() as $event) {
            EventClient::registrationOfHandler($event);
        }
    }
}
