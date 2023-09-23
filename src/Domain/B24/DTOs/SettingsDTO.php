<?php

namespace Domain\B24\DTOs;

use Illuminate\Support\Fluent;

/**
 * @property string $access_token
 * @property string|null $placement
 * @property int $expires_in
 * @property string|null $application_token
 * @property string $refresh_token
 * @property string|null $domain
 * @property string $client_endpoint
 */
class SettingsDTO extends Fluent
{
    public const DEFAULT_PLACEMENT = 'DEFAULT';

    public static function fromArray(array $fields): self
    {
        $self = new self();

        $self->access_token = $fields['AUTH_ID'] ?? $fields['access_token'];
        $self->placement = $fields['PLACEMENT'] ?? null;
        $self->expires_in = $fields['AUTH_EXPIRES'] ?? $fields['expires_in'];
        $self->application_token = $fields['APP_SID'] ?? null;
        $self->refresh_token = $fields['REFRESH_ID'] ?? $fields['refresh_token'];
        $self->domain = $fields['DOMAIN'] ?? null;
        $self->client_endpoint = isset($fields['DOMAIN'])
            ? "https://{$fields['DOMAIN']}/rest/"
            : $fields['client_endpoint'];

        return $self;
    }
}
