<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Dlomo Sibonginkosi',
            'email' => 'dlomo0308@gmail.com',
            'password' =>  Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@scanlen.com',
            'password' => Hash::make('password'), 
        ]);
    }
}
