<?php

namespace App\Http\Requests;

use Domain\B24\DTOs\SettingsDTO;
use Illuminate\Foundation\Http\FormRequest;

class B24InstallRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'DOMAIN' => ['string', 'required'],
            'APP_SID' => ['string', 'required'],
            'AUTH_ID' => ['string', 'required'],
            'AUTH_EXPIRES' => ['integer', 'required'],
            'REFRESH_ID' => ['string', 'required'],
            'PLACEMENT' => ['string', 'required'],
        ];
    }

    public function createDTO(): SettingsDTO
    {
        return SettingsDTO::fromArray($this->validated());
    }
}
