<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (!Schema::hasTable('proffessor')) {
      Schema::create('proffessor', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('lastname');
        $table->integer('ci')->unique();
        $table->boolean('active')->default(true);
      });
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('proffessor');
  }
};
