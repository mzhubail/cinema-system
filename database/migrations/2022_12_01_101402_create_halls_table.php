<?php

use App\Models\Branch;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Hall;
use Mockery\LegacyMockInterface;

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
      $table->char('letter', length: 1);
      $table->foreignIdFor(Branch::class)
        ->cascadeOnDelete();
      $table->timestamps();
    });
    Hall::factory()
      ->count(10)
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
