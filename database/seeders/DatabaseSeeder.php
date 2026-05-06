<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::updateOrCreate(
            ['email' => 'admin@astanashelter.kz'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // Create some animals
        Animal::updateOrCreate(
            ['name' => 'Barbos'],
            [
                'species' => 'Dog',
                'age' => 3,
                'status' => 'available',
                'description' => 'A friendly dog looking for a home in Astana.',
            ]
        );

        Animal::updateOrCreate(
            ['name' => 'Murka'],
            [
                'species' => 'Cat',
                'age' => 1,
                'status' => 'pending',
                'description' => 'Very playful and sweet.',
            ]
        );

        Animal::updateOrCreate(
            ['name' => 'Kesha'],
            [
                'species' => 'Bird',
                'age' => 2,
                'status' => 'adopted',
                'description' => 'Likes to sing and talk.',
            ]
        );
    }
}
