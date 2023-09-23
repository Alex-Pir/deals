<?php

namespace App\Providers;

use App\Contracts\RouteRegistrar;
use App\Routing\AppRegistrar;
use App\Routing\B24Registrar;
use App\Routing\DealRegistrar;
use App\Routing\TemplateRegistrar;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/home';

    public array $routers = [
        AppRegistrar::class,
        B24Registrar::class,
        DealRegistrar::class,
    ];

    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function (Registrar $registrar) {
            $this->mapRouters($registrar);
        });
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('global', function (Request $request) {
            return Limit::perMinute(500)
                ->by($request->user()?->id ?: $request->ip())
                ->response(
                    fn(Request $request, array $headers) => response(
                        'Take it easy',
                        Response::HTTP_TOO_MANY_REQUESTS,
                        $headers
                    )
                );
        });

        RateLimiter::for('auth', function (Request $request) {
            return Limit::perMinute(20)->by($request->ip());
        });

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    protected function mapRouters(Registrar $registrar): void
    {
        foreach ($this->routers as $router) {
            if (!class_exists($router) || !is_subclass_of($router, RouteRegistrar::class)) {
                throw new InvalidArgumentException("Невозможно подключить $router");
            }

            (new $router())->map($registrar);
        }
    }
}
