<?php

namespace Tests\Feature\Admin;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin_dashboard(): void
    {
        $this->get(route('admin.events.index'))
            ->assertRedirect(route('login'));
    }

    public function test_administrator_can_sign_in_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'secret-password',
        ]);

        $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'secret-password',
        ])
            ->assertRedirect(route('admin.events.index'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_authenticated_admin_can_create_an_unpublished_event(): void
    {
        $this->actingAs(User::factory()->create());

        $this->post(route('admin.events.store'), [
            'title' => 'New event',
            'description' => 'A complete event description.',
            'start_at' => now()->addWeek()->format('Y-m-d H:i:s'),
            'end_at' => now()->addWeek()->addHours(2)->format('Y-m-d H:i:s'),
            'format' => 'hybrid',
            'location_details' => 'Main Hall and online',
        ])->assertRedirect(route('admin.events.index'));

        $this->assertDatabaseHas('events', [
            'title' => 'New event',
            'is_published' => false,
        ]);
    }

    public function test_authenticated_admin_can_publish_an_event(): void
    {
        $this->actingAs(User::factory()->create());
        $event = Event::factory()->unpublished()->create();

        $this->post(route('admin.events.publish', $event))
            ->assertRedirect(route('admin.events.index'));

        $this->assertTrue($event->fresh()->is_published);
        $this->assertNotNull($event->fresh()->published_at);
    }
}
