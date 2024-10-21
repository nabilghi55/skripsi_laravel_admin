<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AlumniUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     'name' => 'Alumni User',
        //     'email' => 'alumni@example.com',
        //     'password' => Hash::make('password123'), // Hash the password
        //     'role' => 'alumni', // Assign alumni role
        // ]);
        User::create([
            'name' => 'Alumni',
            'email' => 'alumni@gmail.com',
            'password' => Hash::make('password123'), // Hash the password
            'role' => 'alumni', // Assign alumni role
            'address' => 'Jombang', 
            'graduation' => 2024,
            'phone'=>'62823867662678',
            'photo' => 'nabil'
        ]);
    }
}
