<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
  public function run()
  {
    User::firstOrCreate([
      'name' => 'Administrador',
      'password' => '$2y$10$uRvpgdadTqTleZzDBamJjejuEwiTTsdxFBP3I5Ke/zMuuZZa9xitC',
      'firstname' => 'Administrador',
      'lastname' => 'Administrador',
      'type' => 'Director',
    ]);
  }
}