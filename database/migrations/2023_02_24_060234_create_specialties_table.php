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
    if (!Schema::hasTable('specialty')) {
      Schema::create('specialty', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('matterId');
        $table->unsignedBigInteger('proffessorId');
        $table->foreign('matterId')->references('id')->on('matter')->onDelete('cascade');
        $table->foreign('proffessorId')->references('id')->on('proffessor')->onDelete('cascade');
        $table->unique(['matterId', 'proffessorId']);
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
    Schema::dropIfExists('specialty');
  }
};
