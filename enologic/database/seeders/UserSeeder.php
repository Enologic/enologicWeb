<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'Admin',
                'password' => bcrypt('contrasena123'),
                'email' => 'admin@enologic.com',
                'email_verified_at' => now(),
                'phone' => '657483923',
                'name' => 'Carlos Santana',
            ],
            [
                'username' => 'PussyDestroyer69',
                'password' => bcrypt('contrasena123'),
                'email' => 'usuario1@enologic.com',
                'email_verified_at' => now(),
                'phone' => '123456789',
                'name' => 'Thanos',
            ],
            [
                'username' => 'MissMeat',
                'password' => bcrypt('password456'),
                'email' => 'usuario2@enologic.com',
                'email_verified_at' => now(),
                'phone' => '987654321',
                'name' => 'Lady Gaga',
            ],
        ];  

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
