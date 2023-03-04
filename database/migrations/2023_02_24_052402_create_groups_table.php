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
    if (!Schema::hasTable('group')) {
      Schema::create('group', function (Blueprint $table) {
        $table->id();
        $table->integer('grade');
        $table->string('name');
        $table->string('description')->nullable();
        $table->unsignedBigInteger('turnId');
        $table->boolean('active')->default(true);
        $table->foreign('turnId')->references('id')->on('turn')->onDelete('cascade');
        $table->unique(['name', 'grade']);
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
    Schema::dropIfExists('group');
  }
};
