<?php

namespace App\Views\ViewModels;

use Domain\Deal\Models\Deal;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;

class DealViewModel extends ViewModel
{
    public function deals(): LengthAwarePaginator
    {
        return Deal::query()
            ->select(['deal_id', 'name', 'stage', 'opportunity'])
            ->paginate(10);
    }
}
