<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Students;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create a single test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create 10 more users
        User::factory(10)->create();

        // Create 1000 more users (if needed, or remove this line)
        User::factory(1000)->create();

        // Seed some students
        Students::create([
            'name' => 'Christian',
            'age' => 20,
        ]);

        Students::create([
            'name' => 'Zee',
            'age' => 22,
        ]);
    }
}
