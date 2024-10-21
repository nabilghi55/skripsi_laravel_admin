<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminAlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat akun admin alumni
        User::create([
            'name' => 'Admin Alumni',
            'email' => 'adminalumni@example.com',
            'password' => Hash::make('password123'), // Ganti dengan password yang diinginkan
            'role' => 'admin', // Role khusus admin alumni
            'address' => 'Jombang', 
            'graduation' => 2024,
            'phone'=>'62823867662678',
            'photo' => 'nabil'
        ]);
    }
}
