<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VenueFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' ' . fake()->randomElement(['Convention Center', 'Creative Hub', 'Grand Hall', 'Business Center']),
            'address' => fake()->streetAddress(),
            'city' => fake()->randomElement(['Jakarta', 'Bandung', 'Bandar Lampung', 'Surabaya', 'Yogyakarta']),
            'province' => fake()->randomElement(['DKI Jakarta', 'Jawa Barat', 'Lampung', 'Jawa Timur', 'DI Yogyakarta']),
            'postal_code' => fake()->postcode(),
            'capacity' => fake()->numberBetween(50, 1000),
            'description' => fake()->sentence(),
            'latitude' => fake()->latitude(-8, -6),
            'longitude' => fake()->longitude(105, 115),
            'status' => 'active',
        ];
    }
}