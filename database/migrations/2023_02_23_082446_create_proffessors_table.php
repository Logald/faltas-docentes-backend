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
    Schema::create('proffessor', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('personId')->unique();
      $table->foreign('personId')->references('id')->on('person')->onDelete('cascade');
      $table->boolean('active')->default(true);
    });
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
