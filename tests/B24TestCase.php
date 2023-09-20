<?php

namespace Tests;

use Database\Factories\EnvironmentFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

abstract class B24TestCase extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Http::fake([
             config('b24.auth_url') . '*' => Http::response(array_merge(
                 (new EnvironmentFactory())->make()->toArray(),
                 ['access_token' => sha1('access_token')],
             )),
        ]);
    }
}
