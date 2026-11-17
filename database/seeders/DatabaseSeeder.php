<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate([
            'email' => env('ADMIN_EMAIL', 'admin@example.com'),
        ], [
            'name' => env('ADMIN_NAME', 'Event Administrator'),
            'password' => env('ADMIN_PASSWORD', 'change-me-before-deployment'),
        ]);

        if (app()->environment('local')) {
            $this->call(DemoEventSeeder::class);
        }
    }
}
