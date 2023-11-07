<?php

use Domain\B24\Enums\CacheEnum;
use Domain\B24\Models\Environment;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

if (!function_exists('data_combine_assoc')) {
    function data_combine_assoc(array $keys, array $values, mixed $defaultValue = null): array
    {
        return array_replace(
            array_fill_keys($keys, $defaultValue),
            Arr::only($values, $keys)
        );
    }
}

if (!function_exists('environment')) {
    function environment(): Environment {
        return Cache::rememberForever(
            CacheEnum::SettingsAll->value,
            fn () => Environment::query()->firstOrFail()
        );
    }
}
