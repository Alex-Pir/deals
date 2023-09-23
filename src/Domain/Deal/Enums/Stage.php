<?php

namespace Domain\Deal\Enums;

enum Stage: string
{
    case New = 'NEW';
    case Preparation = 'PREPARATION';
    case PrepaymentInvoice = 'PREPAYMENT_INVOICE';
    case Executing = 'EXECUTING';
    case FinalInvoice = 'FINAL_INVOICE';
    case Won = 'WON';
    case Lose = 'LOSE';
    case Apology = 'APOLOGY';

    public static function all(): array
    {
        return array_map(fn (Stage $stage) => $stage->value, self::cases());
    }
}
