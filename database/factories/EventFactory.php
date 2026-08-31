<?php

namespace Database\Factories;

use App\Models\EventCategory;
use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->randomElement([
            'Tech Summit Indonesia', 'Creative Design Week', 'Digital Business Conference',
            'Startup Connect', 'UI/UX Workshop', 'Laravel Community Meetup',
            'AI Innovation Summit', 'Marketing Growth Forum', 'Data Science Bootcamp',
            'Product Management Day',
        ]) . ' ' . fake()->year();

        $startDate = fake()->dateTimeBetween('-1 month', '+3 months');

        return [
            'event_code' => 'EVT-' . str_pad(fake()->unique()->numberBetween(1, 99999), 5, '0', STR_PAD_LEFT),
            'name' => $name,
            'slug' => Str::slug($name) . '-' . fake()->unique()->numberBetween(1, 9999),
            'description' => fake()->paragraphs(3, true),
            'category_id' => EventCategory::inRandomOrder()->first()?->id ?? EventCategory::factory(),
            'venue_id' => Venue::inRandomOrder()->first()?->id ?? Venue::factory(),
            'start_date' => $startDate,
            'end_date' => (clone $startDate)->modify('+1 day'),
            'start_time' => '09:00',
            'end_time' => '17:00',
            'capacity' => fake()->numberBetween(50, 500),
            'ticket_price' => fake()->randomElement([0, 50000, 100000, 150000, 250000]),
            'status' => fake()->randomElement(['draft', 'published', 'completed', 'cancelled']),
            'is_featured' => fake()->boolean(30),
            'cover_image' => null,
            'created_by' => null,
        ];
    }
}