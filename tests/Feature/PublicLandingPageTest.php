<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicLandingPageTest extends TestCase
{
    public function test_public_home_and_events_pages_are_accessible(): void
    {
        $this->get('/id')->assertOk();
        $this->get('/id/events')->assertOk();
    }
}
