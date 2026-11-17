<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class DemoEventSeeder extends Seeder
{
    /**
     * Seed sample events for local development only.
     */
    public function run(): void
    {
        Event::factory()->count(6)->create();
        Event::factory()->unpublished()->count(2)->create();
    }
}
