<?php

namespace Database\Factories;

use Domain\B24\Models\Environment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Environment>
 */
class EnvironmentFactory extends Factory
{
    protected $model = Environment::class;

    public function definition(): array
    {
        return [
            'expires_in' => $this->faker->numberBetween(1, 1000),
            'application_token' => $this->faker->sha1,
            'refresh_token' => $this->faker->sha1,
            'domain' => $this->faker->domainName,
            'client_endpoint' => $this->faker->domainName,
        ];
    }
}
