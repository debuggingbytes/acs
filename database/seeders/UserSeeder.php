<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create testing admin user
        User::create([
            'name' => 'Admin',
            'email' => 'test@test.com',
            'password' => bcrypt('password')
    ]);

    }
}
