<?php

namespace Domain\Deal\Actions;

use Domain\B24\Enums\Event;
use Support\Client\DTOs\EventDTO;
use Support\Client\EventClient;

class GetDealIdsAction
{
    public function execute(Event $event): array
    {
        $response = EventClient::getOfflineEvents($event);

        return array_map(fn (EventDTO $eventDto) => $eventDto->data_id, $response);
    }
}
