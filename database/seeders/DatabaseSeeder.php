<?php

namespace Database\Seeders;

use App\Models\Students;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        User::factory(1000)->create();
        // User::factory(10)->create();

        Students::create([
            'name' => 'Arnel',
            'age' => 20,
        ]);

    }
}
