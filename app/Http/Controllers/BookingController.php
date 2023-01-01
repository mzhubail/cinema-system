<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Branch;
use App\Models\Seat;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
  // TODO: remove
  public function show_add()
  {
    return view('booking.add');
  }

  public function store(Request $request)
  {
    // dd($request->all());
  }

  public function browse()
  {
  }

  public function show_bookings()
  {
  }

  public function show_confirm_booking()
  {
    // dd(
    //   session()->all()
    // );
    if (session()->missing('time_slot') || session()->missing('seats'))
      return redirect()->route('home');
    $time_slot = session('time_slot');
    $seats = session('seats');

    // $time_slot->start_time = Str::after($time_slot->start_time, 'time: ');
    // dd($time_slot->start_time);

    return view('booking.confirmation', [
      'time_slot' => $time_slot,
      'seats' => $seats,
    ]);
  }

  public function confirm_booking(Request $request)
  {
    $time_slot = session('time_slot');
    $seats = session('seats');

    DB::beginTransaction();
    $booking = Booking::create([
      'time_slot_id' => $time_slot->id,
      'customer_id' => session('userId'),
    ]);

    session()->forget(['time_slot_id', 'seats']);

    foreach ($seats as $seat) {
      preg_match('/^(\w)(\d{2})$/', $seat, $matches);
      [$row, $column] = [
        ord($matches[1]) - 65,
        $matches[2] - 1
      ];

      // TODO: test this, maybe
      if (SeatController::has_conflict(
        $time_slot,
        $row,
        $column,
      ))
        throw ValidationException::withMessages([
          'Sorry seat is already taken'
        ]);

      Seat::create([
        'booking_id' => $booking->id,
        'row' => $row,
        'column' => $column,
      ]);
      $tmp[] = [$row, $column];
    }
    // dd($tmp);

    DB::commit();

    session()->flash('message', 'Booking added succefully');
    return back();
  }
}
