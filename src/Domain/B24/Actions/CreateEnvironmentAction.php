<?php

namespace Domain\B24\Actions;

use Domain\B24\DTOs\SettingsDTO;
use Domain\B24\Exceptions\InstallException;
use Domain\B24\Models\Environment;
use Illuminate\Support\Facades\DB;

class CreateEnvironmentAction
{
    public function execute(SettingsDTO $settingsDTO): void
    {
        try {
            if ($settingsDTO->placement !== 'DEFAULT') {
                throw InstallException::installError($settingsDTO->toArray());
            }

            DB::transaction(function () use ($settingsDTO) {
                Environment::query()->delete();

                Environment::query()->create(
                    array_filter(
                        data_combine_assoc((new Environment())->getFillable(), $settingsDTO->toArray()),
                        fn ($item) => !is_null($item)
                    )
                );
            });
        } catch (InstallException $ex) {
            logger()->error($ex->getMessage());
        }
    }
}
