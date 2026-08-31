<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SpeakerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'photo' => null,
            'job_title' => fake()->randomElement([
                'Product Designer', 'Software Engineer', 'Data Scientist',
                'Marketing Manager', 'CEO', 'UX Researcher', 'Business Analyst',
            ]),
            'company' => fake()->company(),
            'biography' => fake()->paragraph(),
            'email' => fake()->unique()->safeEmail(),
            'linkedin' => 'https://linkedin.com/in/' . fake()->userName(),
            'website' => fake()->optional()->url(),
            'status' => 'active',
        ];
    }
}