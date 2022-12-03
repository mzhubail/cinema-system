<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
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
}
