<?php

namespace Support\Client;

use Domain\B24\Enums\Event;
use Domain\B24\Models\Environment;
use Support\Client\DTOs\EventDTO;

class EventClient extends BaseClient
{
    public static function registrationOfHandler(Event $event, Environment $environment, bool $isOffline = true): void
    {
        $parameters = [
            'event' => $event->event(),
        ];

        if ($isOffline) {
            $parameters['event_type'] = 'offline';
        } else {
            $parameters['handler'] = $event->handler();
        }

        static::asyncCall('event.bind', $parameters, $environment);
    }

    public static function getOfflineEvents(Event $event): array
    {
        $response = static::call('event.offline.get', [
            'event' => $event->event()
        ])->json();

        if (!$response['result']) {
            return [];
        }

        return array_map(fn (array $item) => EventDTO::fromArray($item), $response['result']['events']);
    }
}
