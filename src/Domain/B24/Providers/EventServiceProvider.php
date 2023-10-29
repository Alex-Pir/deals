<?php

namespace Domain\B24\Providers;

use App\Events\AfterB24Auth;
use Domain\B24\Contracts\TokenStorage;
use Domain\B24\Models\Environment;
use Domain\B24\Observers\EnvironmentObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        Event::listen(AfterB24Auth::class, function (AfterB24Auth $afterB24Install) {
            app(TokenStorage::class)->set($afterB24Install->accessToken);
        });

        Environment::observe(EnvironmentObserver::class);
    }
}
