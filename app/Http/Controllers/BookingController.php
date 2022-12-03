<?php

namespace App\Http\Controllers;

use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
  public function show_add()
  {
    return view('booking.add');
  }

  public function store(Request $request)
  {
    // dd($request->all());
    self::has_conflict(
      TimeSlot::find($request->time_slot_id),
      $request->customer_id,
      $request->row,
      $request->seats_start,
      $request->seats_end,
    );
  }

  public function browse()
  {
  }

  public function show_bookings()
  {
  }



  private static $conflict_query = <<<'SQL'
    SELECT  a.row AS `row`,
            a.time_slot_id AS time_slot_id,
            a.id AS id_a,
            a.customer_id AS customer_a,
            a.seats_start AS seats_start_a,
            a.seats_end AS seats_end_a,
            b.id AS id_b,
            b.customer_id AS customer_b,
            b.seats_start AS seats_start_b,
            b.seats_end AS seats_end_b
    FROM    bookings a, bookings b
    WHERE   a.id < b.id

    AND     a.time_slot_id = b.time_slot_id
    AND     a.row = b.row

    AND     a.seats_start <= b.seats_end
    AND     a.seats_end >= b.seats_start
    ORDER BY  a.time_slot_id
  SQL;

  public function show_conflicts()
  {
    $conflicts = DB::select(self::$conflict_query);
    // dd($conflicts);
    return view('booking.conflict_table', ['conflicts' => $conflicts]);
  }

  public static function has_conflict(TimeSlot $time_slot, $customer_id, $row, $seats_start, $seats_end)
  {
    $query = $time_slot->bookings()
      ->where('row', '=', $row)
      ->whereRaw('seats_start <= ?', [$seats_end])
      ->whereRaw('seats_end >= ?', [$seats_start]);
    // dd(
    //   $query,
    //   $query->toSql(),
    //   $query->get()->map(function ($item) {
    //     return $item->attributesToArray();
    //   }),
    // );
    // dd($query->count() !== 0);
    return $query->count() !== 0;
  }
}
