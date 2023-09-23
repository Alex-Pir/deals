<?php

namespace Domain\B24\Actions;

use App\Events\AfterB24Auth;
use Domain\B24\DTOs\SettingsDTO;
use Domain\B24\Models\Environment;

class PatchEnvironmentAction
{
    public function execute(Environment $environment, SettingsDTO $settingsDTO): void
    {
        $environment->fill(
            array_filter(
                data_combine_assoc((new Environment())->getFillable(), $settingsDTO->toArray()),
                fn ($item) => !is_null($item)
            )
        )->save();

        AfterB24Auth::dispatch($environment, $settingsDTO->access_token);
    }
}
