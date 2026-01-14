<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::insert([
            ['name' => 'admin'],
            ['name' => 'staff'],
            ['name' => 'user'],
        ]);
        // Create the test user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => 'Password123',
            'role_id' => 1
        ]);

        Category::factory()->count(5)->create();

        Product::factory(30)->create();
    }
}
