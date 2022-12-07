<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Hall;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('halls', function (Blueprint $table) {
      $table->id();
      $table->char('letter');
      $table->foreignId('branch_id')
        ->constrained();
      $table->timestamps();
    });
    Hall::factory()
      ->count(20)
      ->create();
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('halls');
  }
};
