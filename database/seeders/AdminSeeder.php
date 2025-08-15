<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name'              => 'Admin',
            'username'          => 'admin',
            'email'             => 'admin@gmail.com',
            'email_verified_at' => null,
            'is_admin'          => true,
            'password'          => Hash::make('admin'),
        ]);
    }
}
