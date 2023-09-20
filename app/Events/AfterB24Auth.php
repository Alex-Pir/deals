<?php

namespace App\Events;

use Domain\B24\Models\Environment;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AfterB24Auth
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public Environment $environment, public string $accessToken)
    {
    }
}
