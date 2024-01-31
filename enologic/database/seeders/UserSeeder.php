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
          // Ejemplo de datos de usuarios
          $user = new User();
          $user->username = 'Admin';
          $user->password = bcrypt('contrasena123');
          $user->email = 'admin@admin.com';
          $user->phone = '657483923';
          $user->name = 'Carlos Santana';
          
  
          $user->save();
    }
}
