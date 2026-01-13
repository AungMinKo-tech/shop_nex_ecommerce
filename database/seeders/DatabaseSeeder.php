<?php

namespace Database\Seeders;

use App\Models\Role;
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
        // User::factory(10)->create();
        Role::insert([
            ['name' => 'admin'],
            ['name' => 'staff'],
            ['name' => 'user'],
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'role_id' => 1,
            'email' => 'test@example.com',
        ]);
    }
}
