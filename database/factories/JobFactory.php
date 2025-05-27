<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
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
            'title' => fake()->jobTitle,
            'company_id' => Company::factory(),
            'description' => fake()->paragraphs(5,true),
            'location' => fake()->country,
            'salary' => fake()->numberBetween(5000, 300000),
            'experience' => fake()->randomElement(Job::$experiences),
            'category' => fake()->randomElement(Job::$categories),

        ];
    }
}
