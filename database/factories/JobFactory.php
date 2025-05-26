<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'title' => fake()->jobTitle,
            'description' => fake()->paragraphs(5,true),
            'location' => fake()->country,
            'salary' => fake()->numberBetween(5000, 300000),
            'experience' => fake()->randomElement(Job::$experiences),
            'category' => fake()->randomElement(Job::$categories),

        ];
    }
}
