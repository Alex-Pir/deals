<?php

namespace Tests\RequestFactories;

use Worksome\RequestFactories\RequestFactory;

class InstallRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'AUTH_ID' => $this->faker->sha1,
            'PLACEMENT' => 'DEFAULT',
            'AUTH_EXPIRES' => $this->faker->numberBetween(1, 1000),
            'APP_SID' => $this->faker->sha1,
            'REFRESH_ID' => $this->faker->sha1,
            'DOMAIN' => $this->faker->domainName,
        ];
    }
}
