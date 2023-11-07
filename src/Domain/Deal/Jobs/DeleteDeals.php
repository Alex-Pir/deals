<?php

namespace Domain\Deal\Jobs;

use Domain\Deal\Actions\DeleteDealsAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteDeals implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(protected array $dealIds)
    {
    }

    public function handle(DeleteDealsAction $action): void
    {
        $action->execute($this->dealIds);
    }
}
