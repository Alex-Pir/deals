<?php

namespace Domain\B24\Enums;

enum Event: string
{
    case DealCreate = 'onCrmDealAdd';
    case DealUpdate = 'onCrmDealUpdate';
    case DealDelete = 'onCrmDealDelete';

    public function event(): string
    {
        return $this->value;
    }

    public function handler(): string
    {
        return match ($this) {
            self::DealCreate => route('deals.create'),
            self::DealUpdate => route('deals.patch'),
            self::DealDelete => route('deals.delete'),
        };
    }
}
