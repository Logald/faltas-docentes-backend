<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
  public function run()
  {
    User::firstOrCreate([
      'name' => 'admin',
      'password' => '$2y$10$uRvpgdadTqTleZzDBamJjejuEwiTTsdxFBP3I5Ke/zMuuZZa9xitC'
    ]);
  }
}