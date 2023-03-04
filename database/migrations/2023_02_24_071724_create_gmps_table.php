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
    if (!Schema::hasTable('gmp')) {
      Schema::create('gmp', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('mgId');
        $table->unsignedBigInteger('proffessorId');
        $table->boolean('active')->default(true);
        $table->foreign('mgId')->references('id')->on('mg')->onDelete('cascade');
        $table->foreign('proffessorId')->references('id')->on('proffessor')->onDelete('cascade');
        $table->unique(['mgId', 'proffessorId']);
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
    Schema::dropIfExists('gmp');
  }
};
