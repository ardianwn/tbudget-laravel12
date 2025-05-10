<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\TourismImageSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Run other seeders
        $this->call([
            AdminUserSeeder::class,
            LocalRouteSeeder::class,
            TransportationSeeder::class,
            TourismDataSeeder::class,
            TourismImageSeeder::class,
        ]);
    }
}
