<?php

use App\Models\Booking;
use App\Models\Seat;
use App\Models\TimeSlot;
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
    Schema::create('seats', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Booking::class);
      $table->unsignedTinyInteger('row');
      $table->unsignedTinyInteger('column');
      $table->timestamps();
    });
    for ($i = 0; $i < 500; $i++)
      Seat::factory()
        ->create();
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('seats');
  }
};
