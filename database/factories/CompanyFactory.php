<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Uuid::uuid4(),
            'user_id' => User::factory(),
            'name' => fake()->company,
            'location' => fake()->country,
            'industry' => fake()->randomElement(Company::$industries),
            'website' => fake()->url,
            'is_verified' => fake()->boolean,
        ];
    }
}
