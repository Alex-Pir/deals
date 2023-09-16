<?php

namespace Domain\B24\DTOs;

use Illuminate\Support\Fluent;

/**
 * @property string $access_token
 * @property string $placement
 * @property int $expires_in
 * @property string $application_token
 * @property string $refresh_token
 * @property string $domain
 * @property string $client_endpoint
 */
class SettingsDTO extends Fluent
{
    public static function fromArray(array $fields): self
    {
        $self = new self();

        $self->access_token = $fields['AUTH_ID'];
        $self->placement = $fields['PLACEMENT'];
        $self->expires_in = $fields['AUTH_EXPIRES'];
        $self->application_token = $fields['APP_SID'];
        $self->refresh_token = $fields['REFRESH_ID'];
        $self->domain = $fields['DOMAIN'];
        $self->client_endpoint = "https://{$fields['DOMAIN']}/rest/";

        return $self;
    }
}
