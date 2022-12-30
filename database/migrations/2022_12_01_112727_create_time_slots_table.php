<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\{Hall, Movie, TimeSlot};
use Ramsey\Uuid\Type\Time;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('time_slots', function (Blueprint $table) {
      $table->id();
      $table->dateTime('start_time');
      $table->foreignIdFor(Hall::class)
        ->cascadeOnDelete();
      $table->foreignIdFor(Movie::class)
        ->cascadeOnDelete();
      $table->timestamps();
    });
    for ($i = 0; $i < 500; $i++)
      TimeSlot::factory()
        ->create();
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('time_slots');
  }
};
