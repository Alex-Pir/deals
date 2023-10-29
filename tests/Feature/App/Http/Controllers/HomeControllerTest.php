<?php

use App\Http\Controllers\HomeController;
use Database\Factories\EnvironmentFactory;
use Tests\B24TestCase;

uses()->group('component');

test('GET home page get 200', function () {
    EnvironmentFactory::new()->createOne();

    $this->get(action(HomeController::class))
        ->assertOk()
        ->assertViewIs('index');
});

test('GET home page without environment 404', function () {
    $this->get(action(HomeController::class))
        ->assertNotFound();
});
