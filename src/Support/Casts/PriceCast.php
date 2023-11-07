<?php

namespace Support\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Support\ValueObjects\Price;

class PriceCast implements CastsAttributes
{
    protected const CURRENCY = 'RUB';
    protected const PRICE_PRECISION = 100;

    public function get($model, string $key, $value, array $attributes): Price
    {
        return Price::make($value);
    }

    public function set($model, string $key, $value, array $attributes): mixed
    {
        if (!$value instanceof Price) {
            $value = $this->createPrice($value);
        }

        return $value->raw();
    }

    protected function createPrice(int|float|string $value): Price
    {
        return Price::make((int)($value * self::PRICE_PRECISION), self::CURRENCY, self::PRICE_PRECISION);
    }
}
