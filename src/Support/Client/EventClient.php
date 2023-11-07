<?php

namespace Support\Client;

use Domain\B24\Enums\Event;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Support\Client\DTOs\EventDTO;

class EventClient extends BaseClient
{
    public static function registrationOfHandler(Event $event, bool $isOffline = true): void
    {
        $parameters = [
            'event' => $event->event(),
        ];

        if ($isOffline) {
            $parameters['event_type'] = 'offline';
        } else {
            $parameters['handler'] = $event->handler();
        }

        static::call('event.bind', $parameters);
    }

    public static function getOfflineEvents(Event $event): array
    {
        $response = static::call('event.offline.get', [
            'event' => $event->event()
        ])->json();

        if (!isset($response['result']) || !$response['result']) {
            return [];
        }

        return array_map(fn (array $item) => EventDTO::fromArray($item), $response['result']['events']);
    }

    protected static function asyncCall(string $method, array $parameters = []): PromiseInterface
    {
        return Http::async()->get(
            environment()->client_endpoint . $method,
            static::prepareParameters($parameters)
        );
    }

    protected static function call(string $method, array $parameters = []): Response
    {
        return Http::get(
            environment()->client_endpoint . "$method.json",
            static::prepareParameters($parameters)
        );
    }
}
