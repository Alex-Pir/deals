<?php

namespace Domain\B24\Actions;

use App\Events\AfterB24Auth;
use Domain\B24\DTOs\SettingsDTO;
use Domain\B24\Exceptions\InstallException;
use Domain\B24\Models\Environment;
use Illuminate\Support\Facades\DB;

class CreateEnvironmentAction
{
    /**
     * @throws InstallException
     */
    public function execute(SettingsDTO $settingsDTO): void
    {
        if ($settingsDTO->placement !== SettingsDTO::DEFAULT_PLACEMENT) {
            throw InstallException::installError($settingsDTO->toArray());
        }

        $environment = DB::transaction(function () use ($settingsDTO) {
            Environment::query()->delete();

            return Environment::query()->create(
                array_filter(
                    data_combine_assoc((new Environment())->getFillable(), $settingsDTO->toArray()),
                    fn ($item) => !is_null($item)
                )
            );
        });

        AfterB24Auth::dispatch($environment, $settingsDTO->access_token);
    }
}
