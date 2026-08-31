<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AdminSidebarNavigationTest extends TestCase
{
    public function test_sidebar_routes_are_accessible_for_authenticated_admin(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $routes = [
            '/id/admin/dashboard',
            '/id/admin/events',
            '/id/admin/categories',
            '/id/admin/speakers',
            '/id/admin/venues',
            '/id/admin/participants',
            '/id/admin/documents',
            '/id/admin/users',
            '/id/admin/import',
            '/id/admin/export',
            '/id/admin/settings',
            '/id/admin/categories/create',
            '/id/admin/speakers/create',
            '/id/admin/venues/create',
            '/id/admin/participants/create',
            '/id/admin/documents/create',
            '/id/admin/users/create',
        ];

        foreach ($routes as $route) {
            $this->get($route)->assertOk();
        }

        $category = \App\Models\EventCategory::factory()->create();
        $speaker = \App\Models\Speaker::factory()->create();
        $venue = \App\Models\Venue::factory()->create();
        $event = \App\Models\Event::factory()->create([
            'category_id' => $category->id,
            'venue_id' => $venue->id,
        ]);

        $this->get('/id/admin/categories/' . $category->id . '/edit')->assertOk();
        $this->get('/id/admin/speakers/' . $speaker->id . '/edit')->assertOk();
        $this->get('/id/admin/venues/' . $venue->id . '/edit')->assertOk();
        $this->get('/id/admin/users/' . User::factory()->create()->id . '/edit')->assertOk();
        $this->get('/id/admin/participants/' . \App\Models\Participant::factory()->create([
            'event_id' => $event->id,
        ])->id . '/edit')->assertOk();
        $this->get('/id/admin/documents/' . \App\Models\Document::factory()->create([
            'event_id' => $event->id,
        ])->id . '/edit')->assertOk();
    }
}
