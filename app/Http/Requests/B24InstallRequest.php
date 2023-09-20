<?php

namespace App\Http\Requests;

use Domain\B24\DTOs\SettingsDTO;
use Illuminate\Foundation\Http\FormRequest;
use Tests\RequestFactories\InstallRequestFactory;
use Worksome\RequestFactories\Concerns\HasFactory;

class B24InstallRequest extends FormRequest
{
    use HasFactory;

    public static string $factory = InstallRequestFactory::class;

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
