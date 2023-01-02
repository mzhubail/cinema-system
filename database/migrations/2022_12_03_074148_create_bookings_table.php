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

      // $table->enum(
      //   'status',
      //   ['pending', 'complete', 'canceled', 'suspended']
      // )->default('pending');

      $table->decimal(
        'price',
        total: 5,
        places: 3,
        unsigned: true
      );
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
    Schema::dropIfExists('bookings');
  }
};
