<?php

declare(strict_types=1);

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\DealController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

final class DealRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::controller(DealController::class,)->group(function () {
            Route::any('/deals/create', 'create')->name('deals.create')->middleware('web');
            Route::any('/deals/patch', 'patch')->name('deals.patch');
            Route::any('/deals/delete', 'delete')->name('deals.delete');
        });
    }
}
