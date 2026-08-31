<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventCategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Technology', 'Business', 'Design', 'Education',
                'Workshop', 'Conference', 'Entertainment', 'Community',
            ]),
            'description' => fake()->sentence(),
            'status' => 'active',
        ];
    }
}