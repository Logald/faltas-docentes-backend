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
    if (!Schema::hasTable('absence')) {
      Schema::create('absence', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('gmpId');
        $table->unsignedBigInteger('turnId');
        $table->dateTime('startDate');
        $table->dateTime('endDate');
        $table->string('reason')->nullable();
        $table->boolean('active')->default(true);
        $table->foreign('gmpId')->references('id')->on('gmp')->onDelete('cascade');
        $table->foreign('turnId')->references('id')->on('turn')->onDelete('cascade');
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
    Schema::dropIfExists('absence');
  }
};
