<?php

declare(strict_types=1);

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\TemplateController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

final class TemplateRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')->group(function () {
            Route::get('/templates', [TemplateController::class, 'index'])->name('templates');
            Route::post('/templates', [TemplateController::class, 'create'])->name('templates.create');
        });
    }
}
