<?php

namespace Domain\B24\Observers;

use Domain\B24\Enums\CacheEnum;
use Domain\B24\Models\Environment;
use Illuminate\Support\Facades\Cache;

class EnvironmentObserver
{
    public function saved(Environment $environment): void
    {
        $this->clearCache();
    }

    public function deleted(Environment $environment): void
    {
        $this->clearCache();
    }

    protected function clearCache(): void
    {
        Cache::deleteMultiple(array_map(fn (CacheEnum $case) => $case->value, CacheEnum::cases()));
    }
}
