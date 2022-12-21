<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Movie;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('movies', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->integer(
        'release_year',
        autoIncrement: false,
        unsigned: true
      );
      $table->enum(
        'lang',
        ['ar', 'en', 'hu']
      );
      $table->integer('duration');
      $table->decimal(
        'rating',
        total: 2,
        places: 1,
        unsigned: true
      );
      $table->enum(
        'genre',
        config('constants.genres'),
      );
      $table->string('desc', 511);
      $table->string('img_path', 255);
      $table->timestamps();
    });
    Movie::factory()
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
    Schema::dropIfExists('movies');
  }
};
