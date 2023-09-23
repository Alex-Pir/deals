<?php

use App\Events\AfterB24Auth;
use App\Http\Controllers\B24Controller;
use App\Http\Requests\B24InstallRequest;
use Domain\B24\Models\Environment;
use Illuminate\Support\Facades\Event;
use Tests\B24TestCase;

uses()->group('component');

test('POST install 200', function () {
    Event::fake();
    $settingsTable = (new Environment())->getTable();
    $request = B24InstallRequest::factory()->create();

    $this->assertDatabaseEmpty($settingsTable);

    $this->post(action(
        [B24Controller::class, 'install']),
        $request
    )
        ->assertOk()
        ->assertViewIs('install');

    $this->assertDatabaseHas($settingsTable, [
        'expires_in' => $request['AUTH_EXPIRES'],
        'application_token' => $request['APP_SID'],
        'refresh_token' => $request['REFRESH_ID'],
        'domain' => $request['DOMAIN'],
        'client_endpoint' => "https://{$request['DOMAIN']}/rest/",
    ]);

    Event::assertDispatched(fn (AfterB24Auth $event) => $event->accessToken === $request['AUTH_ID']);
});
