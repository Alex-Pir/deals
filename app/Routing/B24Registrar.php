<?php

declare(strict_types=1);

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\B24Controller;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

final class B24Registrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')->group(function () {
            Route::post('/b24/install', [B24Controller::class, 'install'])
                ->name('b24.install');
        });
    }
}
