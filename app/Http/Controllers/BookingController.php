<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Branch;
use App\Models\Seat;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

  public function confirm_booking()
  {
    // dd(
    //   session()->all()
    // );
    if (session()->missing('time_slot') || session()->missing('seats'))
      dd('');
    $time_slot = session('time_slot');
    $seats = session('seats');

    // $time_slot->start_time = Str::after($time_slot->start_time, 'time: ');
    // dd($time_slot->start_time);

    return view('booking.confirmation', [
      'time_slot' => $time_slot,
      'seats' => $seats,
    ]);
  }
}
