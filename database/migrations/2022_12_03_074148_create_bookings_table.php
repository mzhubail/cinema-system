<?php

use App\Models\Booking;
use App\Models\Customer;
use App\Models\TimeSlot;
use Database\Factories\BookingFactory;
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
    Schema::create('bookings', function (Blueprint $table) {
      $table->id();
      $table->enum(
        'payment_method',
        ['paypal', 'apple-pay', 'benefit-pay']
      );

      $table->foreignIdFor(TimeSlot::class)
        ->cascadeOnDelete();
      $table->foreignIdFor(Customer::class)
        ->cascadeOnDelete();

      $table->enum(
        'status',
        ['pending', 'complete', 'canceled', 'suspended']
      )->default('pending');
      $table->timestamps();
    });
    // Booking::factory()
    //   ->count(100)
    //   ->create();
    for ($i = 0; $i < 1000; $i++)
      Booking::factory()
        ->count(1)
        ->create();
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('bookings');
  }
};
