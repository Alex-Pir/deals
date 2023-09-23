<?php

use Illuminate\Support\Arr;

if (!function_exists('data_combine_assoc')) {
    function data_combine_assoc(array $keys, array $values, mixed $defaultValue = null): array
    {
        return array_replace(
            array_fill_keys($keys, $defaultValue),
            Arr::only($values, $keys)
        );
    }
}
