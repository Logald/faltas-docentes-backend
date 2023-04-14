<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Turn;

class TurnSeeder extends Seeder
{
  public function run()
  {
    $turns = [
      ['name' => 'Matutino', 'start_time' => '08:00:00', 'end_time' => '13:00:00'],
      ['name' => 'Vespertino', 'start_time' => '14:00:00', 'end_time' => '19:00:00'],
      ['name' => 'Nocturno', 'start_time' => '20:00:00', 'end_time' => '00:00:00'],
    ];
    foreach ($turns as $turn) {
      Turn::firstOrCreate($turn);
    }
  }
}
