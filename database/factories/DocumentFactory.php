<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    public function definition(): array
    {
        $fileName = fake()->randomElement(['Proposal', 'Rundown', 'Contract', 'Poster']) . '.pdf';

        return [
            'event_id' => Event::inRandomOrder()->first()?->id ?? Event::factory(),
            'document_name' => pathinfo($fileName, PATHINFO_FILENAME),
            'file_name' => $fileName,
            'file_path' => 'documents/' . fake()->uuid() . '_' . $fileName,
            'file_type' => 'application/pdf',
            'file_size' => fake()->numberBetween(50000, 5000000),
            'storage_disk' => 'local',
            'uploaded_by' => null,
        ];
    }
}