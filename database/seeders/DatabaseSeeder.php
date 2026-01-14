<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        $admin = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => Hash::make('Password123'),
            'role_id' => 1
        ];

        $staff = [
            'name' => 'Alice Doe',
            'email' => 'alice244doe@exaple.com',
            'password' => Hash::make('Password123'),
            'role_id' => 2
        ];

        $user = [
            'name' => 'Jame Doe',
            'email' => 'jamedoe@exaple.com',
            'password' => Hash::make('Password123'),
            'role_id' => 3
        ];

        User::create($admin);
        User::create($staff);
        User::create($user);

        User::factory(10)->create();

        Category::factory()->count(5)->create();

        Product::factory(30)->create();
    }
}
