<?php

namespace Domain\Deal\Actions;

use Domain\Deal\Models\Deal;
use Support\Client\CRM\DealsClient;

class CreateDealsAction
{
    public function execute(array $dealIds): void
    {
        $deals = DealsClient::list(['ID' => $dealIds]);

        foreach ($deals as $deal) {
            Deal::query()->updateOrCreate(['deal_id' => $deal->deal_id], $deal->toArray());
        }
    }
}
