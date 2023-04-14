<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Turn;

class TurnSeeder extends Seeder
{
  public function run()
  {
    $turns = [
      ['name' => 'Matutino'],
      ['name' => 'Vespertino'],
      ['name' => 'Nocturno'],
    ];
    foreach ($turns as $turn) {
      Turn::firstOrCreate($turn);
    }
  }
}
