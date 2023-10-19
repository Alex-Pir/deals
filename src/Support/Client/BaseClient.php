<?php

namespace Support\Client;

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

        if (!$response->successful() || $response->json('error')) {
            throw ClientException::requestError(__METHOD__);
        }

        return $response;
    }

    protected static function asyncCall(string $method, array $parameters = [], Environment $environment = null): PromiseInterface
    {
        /** @var TokenStorage $tokenStorage */
        $tokenStorage = app(TokenStorage::class);

        $parameters['auth'] = $tokenStorage->get();

        if (!$environment) {
            $environment = Environment::query()->firstOrFail();
        }

        return Http::async()->post("$environment->client_endpoint$method.json", $parameters);
    }

    protected static function call(string $method, array $parameters = [], Environment $environment = null): Response
    {
        /** @var TokenStorage $tokenStorage */
        $tokenStorage = app(TokenStorage::class);

        $parameters['auth'] = $tokenStorage->get();

        if (!$environment) {
            $environment = Environment::query()->firstOrFail();
        }

        return Http::post("$environment->client_endpoint$method.json", $parameters);
    }
}
