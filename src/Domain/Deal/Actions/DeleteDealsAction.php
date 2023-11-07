<?php

namespace Domain\Deal\Actions;

use Domain\Deal\Models\Deal;

class DeleteDealsAction
{
    public function execute(array $dealIds): void
    {
        Deal::query()->whereIn('deal_id', $dealIds)->delete();
    }
}
