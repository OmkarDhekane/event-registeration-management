<?php

namespace Tests\Feature\Public;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitor_can_register_for_a_published_upcoming_event(): void
    {
        $event = Event::factory()->create();

        $response = $this->post(route('registrations.store', $event), [
            'name' => 'Maya Visitor',
            'email' => 'maya@example.com',
        ]);

        $response->assertRedirect(route('registrations.confirmation', $event));
        $this->assertDatabaseHas('registrations', [
            'event_id' => $event->id,
            'email' => 'maya@example.com',
        ]);
    }

    public function test_registration_requires_a_name_and_valid_email(): void
    {
        $event = Event::factory()->create();

        $this->from(route('registrations.create', $event))
            ->post(route('registrations.store', $event), [
                'name' => '',
                'email' => 'not-an-email',
            ])
            ->assertRedirect(route('registrations.create', $event))
            ->assertSessionHasErrors(['name', 'email']);
    }
}
