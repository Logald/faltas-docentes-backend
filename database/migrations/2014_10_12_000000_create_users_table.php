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
    if (!Schema::hasTable('user')) {
      Schema::create('user', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->string('password');
        $table->string('firstname');
        $table->string('lastname');
        $table->enum('type', ['Director', 'Administrativo', 'Adscripto'])->default('Adscripto');
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
    Schema::dropIfExists('user');
  }
};
