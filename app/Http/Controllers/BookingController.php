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

  public function browse_by_time_slot()
  {
    return view('booking.browse_by_time_slot', [
      'branches' => Branch::select(['id', 'name'])->get(),
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
    return redirect('/');
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
      $bookings = $query->where('time_slot_id', '=', $request->tsid)
        ->get();
      return response()->json($bookings);
    } else
      return response(status: 400);
  }


  public function sales_by_branch()
  {
    $sql = <<<SQL
      SELECT    branches.id AS branch_id,
                branches.name AS branch_name,
                COUNT(*) AS bookings_count,
                SUM(price) AS total_profit
      FROM      `bookings`
        JOIN    `time_slots`
        ON      time_slot_id = time_slots.id
        JOIN    `halls`
        ON      hall_id = halls.id
        JOIN    `branches`
        ON      branch_id = branches.id
      WHERE     bookings.created_at > ?
      GROUP BY  branches.id, branches.name
    SQL;

    $data = DB::select(
      $sql,
      [now()->subDays(30)]
    );
    $data = collect($data);
    $data->each(function ($item) {
      $item->total_profit = (float) $item->total_profit;
    });
    // dd($data);
    return view('booking.sales_by_branch', [
      'branches' => $data,
    ]);
  }


  private function list_bookings_query()
  {
    return session('customer')->bookings()
      ->join('time_slots', 'time_slot_id', '=', 'time_slots.id')
      ->join('movies', 'movie_id', '=', 'movies.id')
      ->withCasts(['start_time' => 'datetime'])
      ->select(['bookings.id', 'movies.title AS movie_title', 'start_time']);
  }

  public function current(Request $request)
  {
    $bookings = $this->list_bookings_query()
      ->where('start_time', '>', now())
      ->get();

    return view('booking.current', [
      'bookings' => $bookings,
    ]);
  }


  public function history()
  {
    $bookings = $this->list_bookings_query()
      ->get();

    return view('booking.history', [
      'bookings' => $bookings,
    ]);
  }


  public function details(Request $request)
  {
    $request->validate([
      'id' => 'required|exists:bookings,id',
    ]);

    $booking = Booking::find($request->id);

    if (
      session()->has('customer') &&
      !$booking->customer->is(session('customer'))
    )
      throw ValidationException::withMessages(['You are not allowed to view that booking']);

    $seats = $booking->seats
      ->map(fn ($item) => SeatController::convertSeat($item));
    return view('booking.details', [
      'booking' => $booking,
      'seats' => $seats,
    ]);
  }
}
