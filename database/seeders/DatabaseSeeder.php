<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Speaker;
use App\Models\Venue;
use App\Models\Participant;
use App\Models\Document;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        EventCategory::factory(5)->create();
        Venue::factory(10)->create();
        $speakers = Speaker::factory(15)->create();

        Event::factory(30)->create()->each(function (Event $event) use ($speakers) {
            $event->speakers()->attach(
                $speakers->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        Participant::factory(100)->create();
        Document::factory(30)->create();
    }
}