<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Branch;
use App\Models\Customer;
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

  public function browse_by_customer()
  {
    return view('booking.browse_by_customer', [
      'customers' => Customer::select(['id', 'email'])->get()
    ]);
  }

  public function show_bookings()
  {
  }

  public function show_confirm_booking()
  {
    // dd(
    //   session()->all()
    // );
    if (
      session()->missing('time_slot') ||
      session()->missing('seats') ||
      session()->missing('price')
    )
      return redirect()->route('home');
    $time_slot = session('time_slot');
    $seats = session('seats');
    $price = session('price');

    // Note that the price we show in booking confirmation is taken from the
    // client, and thus is inherently unreliable.  However, the price inserted
    // in the database (see `confirm_booking`) is calculated on the server, and
    // could be used for billing.

    return view('booking.confirmation', [
      'time_slot' => $time_slot,
      'seats' => $seats,
      'price' => $price,
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
      'price' => 1,
    ]);
    $price = 0;

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
      $price += Seat::price($row, $column);
    }

    $booking->price = $price;
    $booking->save();

    DB::commit();

    session()->flash('message', 'Booking added succefully');
    return back();
  }


  public function serve_bookings(Request $request)
  {
    $query = DB::table('bookings')
      ->join('time_slots', 'time_slots.id', '=', 'time_slot_id')
      ->join('movies', 'movies.id', '=', 'movie_id')
      // ->select(['bookings.*', 'customer_id', 'time_slot_id']);
      ->select([
        'bookings.id',
        'bookings.price',
        'bookings.created_at AS booking_time',
        DB::raw('DATE_FORMAT(time_slots.start_time, "%d-%m-%Y %H:%i") AS movie_time'),
        'movies.title AS movie_title',
      ]);

    if ($request->has('cid')) {
      $bookings = $query->where('customer_id', '=', $request->cid)
        ->get();
      return response()->json($bookings);
    } elseif ($request->has('tsid')) {
    } else
      return response(status: 400);
  }
}
