<?php

namespace Database\Seeders;

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
        // User::factory(10)->create();

        User::factory()->create([
            'username' => 'guest1@example.com',
            'is_admin' => false,
            'password' => bcrypt('guest1'), // password
        ]);

        User::factory()->create([
            'username' => 'admin@example.com',
            'is_admin' => true,
            'password' => bcrypt('123'), // password
        ]);
    }
}
