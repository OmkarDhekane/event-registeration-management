<?php

namespace Tests\Feature\Public;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventDiscoveryTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_lists_only_published_upcoming_events(): void
    {
        $visible = Event::factory()->create(['title' => 'Visible event']);
        Event::factory()->unpublished()->create(['title' => 'Unpublished event']);
        Event::factory()->create([
            'title' => 'Past event',
            'start_at' => now()->subDay(),
            'end_at' => now()->subHours(22),
        ]);

        $this->get(route('events.index'))
            ->assertOk()
            ->assertSee($visible->title)
            ->assertDontSee('Unpublished event')
            ->assertDontSee('Past event');
    }

    public function test_events_can_be_searched_and_filtered(): void
    {
        Event::factory()->create([
            'title' => 'Accessible Web Workshop',
            'format' => 'online',
        ]);
        Event::factory()->create([
            'title' => 'Community Meetup',
            'format' => 'in-person',
        ]);

        $this->get(route('events.index', [
            'query' => 'Accessible',
            'format' => 'online',
        ]))
            ->assertOk()
            ->assertSee('Accessible Web Workshop')
            ->assertDontSee('Community Meetup');
    }

    public function test_unpublished_event_details_are_not_public(): void
    {
        $event = Event::factory()->unpublished()->create();

        $this->get(route('events.show', $event))->assertNotFound();
    }
}
