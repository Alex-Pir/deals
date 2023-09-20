<?php

namespace Support\Client;

use App\Events\AfterB24Auth;
use Domain\B24\Models\Environment;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Support\Exceptions\ClientException;

class Client
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
}
