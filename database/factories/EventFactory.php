<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<Event> */
class EventFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(4);
        $start = fake()->dateTimeBetween('+1 day', '+2 months');

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.Str::lower(Str::random(6)),
            'description' => fake()->paragraphs(2, true),
            'start_at' => $start,
            'end_at' => (clone $start)->modify('+2 hours'),
            'format' => fake()->randomElement(['in-person', 'online', 'hybrid']),
            'location_details' => fake()->randomElement(['Main Hall', 'Online meeting', 'Main Hall and online']),
            'is_published' => true,
            'published_at' => now(),
        ];
    }

    public function unpublished(): static
    {
        return $this->state(fn (): array => [
            'is_published' => false,
            'published_at' => null,
        ]);
    }
}
