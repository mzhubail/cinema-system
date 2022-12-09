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
      $table->string("fName");
      $table->string("lName");
      $table->string("email");
      $table->date("birthday");
      $table->string("hash", 255);
      // Make it a float
      $table->integer("credit")
        ->default(0);

      $table->timestamps();

      $table->unique("email");
      // $table->primary('id');
    });
    Customer::factory()
      ->count(10)
      ->create();
    // $passwords = Customer::factory()::$passwords;
    // $passwords = join("  ", $passwords);
    // DB::statement(
    //     "ALTER TABLE `customers` comment :passwords",
    //     [':passwords' => $passwords]
    // );
    // DB::statement(
    //     DB::raw("ALTER TABLE `customers` comment ?"),
    //     [$passwords]
    // );
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
