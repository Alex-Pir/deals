<?php

namespace Support\Client;

use App\Events\AfterB24Auth;
use Closure;
use Domain\B24\Contracts\TokenStorage;
use Domain\B24\Enums\Event;
use Domain\B24\Models\Environment;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Support\Exceptions\ClientException;

class BaseClient
{
    /**
     * @throws ClientException
     */
    public static function auth(Environment $environment): Response
    {
        $parameters = [
            'grant_type' => 'refresh_token',
            'client_id' => config('b24.client_id'),
            'client_secret' => config('b24.client_secret'),
            'refresh_token' => $environment->refresh_token,
        ];

        $response = Http::get(config('b24.auth_url'), $parameters);

        if (!$response->successful()) {
            throw ClientException::requestError(__METHOD__);
        }

        return $response;
    }

    public static function getById(int $id)
    {
        static::call('crm.deal.get', ['ID' => 8]);
    }

    public static function registrationOfHandler(Event $event, Environment $environment): void
    {
        static::call('event.bind', [
            'event' => $event->event(),
            'handler' => $event->handler()
        ], $environment);
    }

    protected static function call(string $method, array $parameters = [], Environment $environment = null)
    {
        /** @var TokenStorage $tokenStorage */
        $tokenStorage = app(TokenStorage::class);

        $parameters['auth'] = $tokenStorage->get();

        if (!$environment) {
            $environment = Environment::query()->firstOrFail();
        }

        Http::async()->post("$environment->client_endpoint$method.json", $parameters)->then(function ($r) use ($method, $parameters, $environment) {
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logAsyncRes12345.txt', print_r($r->json(), true) . "\n", FILE_APPEND);
            return $r;
        })->wait();
    }
}
