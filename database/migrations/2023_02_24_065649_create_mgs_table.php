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
    if (!Schema::hasTable('mg')) {
      Schema::create('mg', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('matterId');
        $table->unsignedBigInteger('groupId');
        $table->foreign('matterId')->references('id')->on('matter')->onDelete('cascade');
        $table->foreign('groupId')->references('id')->on('group')->onDelete('cascade');
        $table->unique(['matterId', 'groupId']);
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
    Schema::dropIfExists('mg');
  }
};
