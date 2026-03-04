<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Teacher Account
        \App\Models\User::create([
            'name' => 'Teacher Sahab',
            'email' => 'teacher@quiz.com',
            'password' => bcrypt('password123'), // Ye hai password
        ]);

        // Student Account
        \App\Models\User::create([
            'name' => 'Student Boy',
            'email' => 'student@quiz.com',
            'password' => bcrypt('password123'), // Ye bhi wahi
        ]);
    }
}
