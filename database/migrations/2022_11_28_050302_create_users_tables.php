<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Customer;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('customers', function (Blueprint $table) {
      $table->id();
      $table->string("fName", 31);
      $table->string("lName", 31);
      $table->string("email", 31);
      $table->date("birthday");
      $table->string("hash", 255);

      $table->timestamps();

      $table->unique("email");
    });

    Schema::create('admins', function (Blueprint $table) {
      $table->id();
      $table->string("email", 31);
      $table->string("hash", 255);

      $table->timestamps();

      $table->unique("email");
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('customers');
  }
};
