<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipantFactory extends Factory
{
    public function definition(): array
    {
        return [
            'participant_code' => 'REG-' . str_pad(fake()->unique()->numberBetween(1, 99999), 5, '0', STR_PAD_LEFT),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'event_id' => Event::inRandomOrder()->first()?->id ?? Event::factory(),
            'ticket_type' => fake()->randomElement(['Regular', 'VIP', 'VVIP', 'Student']),
            'registration_date' => fake()->dateTimeBetween('-2 months', 'now'),
            'status' => fake()->randomElement(['Registered', 'Confirmed', 'Cancelled', 'Attended']),
        ];
    }
}