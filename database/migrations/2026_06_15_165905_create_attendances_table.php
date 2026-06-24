<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('attendances', function (Blueprint $table) {
      $table->id();

      $table->foreignId('user_id')
        ->constrained()
        ->cascadeOnDelete();

      $table->string('type');

      $table->date('work_date');

      $table->dateTime('clock_in')->nullable();
      $table->dateTime('break_in')->nullable();
      $table->dateTime('break_out')->nullable();
      $table->dateTime('clock_out')->nullable();

      $table->integer('work_minutes')->default(0);
      $table->integer('break_minutes')->default(0);

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('attendances');
  }
};
