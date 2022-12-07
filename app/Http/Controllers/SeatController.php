<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeatController extends Controller
{
  public function check_has_conflict(Request $request)
  {
    dd(
      SeatController::has_conflict(
        TimeSlot::find($request->ts),
        $request->row,
        $request->column
      )
    );
  }

  public static function has_conflict(TimeSlot $time_slot, $row, $column)
  {
    $query = <<<'SQL'
        -- SELECT  time_slots.id AS time_slot_id,
        --         bookings.id AS booking_id,
        --         `row`, `column`
        SELECT  COUNT(*) AS c
        FROM    `time_slots`, `bookings`, `seats`
        WHERE   time_slots.id = ?
        AND     time_slots.id = bookings.time_slot_id
        AND     bookings.id = seats.booking_id
        AND     seats.row = ?
        AND     seats.column = ?
    SQL;

    $count = DB::select($query, [$time_slot->id, $row, $column])[0]->c;
    return $count !== 0;
  }

  private static $conflict_query = <<<'SQL'
    select  time_slots.id as time_slot_id,
            ba.id as booking_id_a,
            sa.id as seat_id_a,
            sa.row as row_a,
            sa.column as column_a,
            bb.id as booking_id_b,
            sb.id as seat_id_b,
            sb.row as row_b,
            sb.column as column_b
    from    time_slots,
            bookings ba, bookings bb,
            seats sa, seats sb
    where   time_slots.id = ba.time_slot_id
    and     time_slots.id = bb.time_slot_id
    and     ba.id < bb.id

    and     sa.booking_id = ba.id
    and     sb.booking_id = bb.id

    and     sa.row = sb.row AND sa.column = sb.column
    order by time_slots.id

  SQL;

  public function show_conflicts()
  {
    $conflicts = DB::select(self::$conflict_query);
    return view('seat.conflict_table', ['conflicts' => $conflicts]);
  }



  public function seats_picker_admin(Request $request)
  {
    return view(
      'seat.choose_seats',
      [
        'branches' => Branch::get(),
      ]
    );
  }

  public function serve_seats(Request $request)
  {
    if (!$request->has('tsid')) return;

    $seats = self::getSeats($request->tsid);

    return response()->json(
      $seats
    );
  }

  public static function getSeats($time_slot_id)
  {
    $seatsRaw = TimeSlot::find($time_slot_id)
      ->seats()
      ->get(['row', 'column']);
    $seatsCoded = $seatsRaw->map(fn($raw) => self::convertSeat($raw));
    return $seatsCoded;
  }

  /** Converts seat from array into a code format, like 'E01' */
  public static function convertSeat($raw)
  {
    ['row' => $r, 'column' => $c] = $raw;
    $code = chr(ord('A') + $r);
    $code .= sprintf('%02d', $c + 1);
    return $code;
  }

  public function recieve_seats(Request $request)
  {
    dd($request->all());
  }
}
