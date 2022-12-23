<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Branch;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('branches', function (Blueprint $table) {
      $table->id();
      $table->string('name', '31');
      $table->string('addr', '63');
      $table->timestamps();

      $table->unique('name');
    });
    Branch::factory()
      ->count(3)
      ->create();
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('branches');
  }
};
