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

  public function seats_picker_admin(Request $request)
  {
    return view(
      'booking.choose_seats',
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
    // Convert seats from array into a code format, like 'E01'
    // TODO: move into separate function
    $seatsCoded = $seatsRaw->map(function ($raw) {
      ['row' => $r, 'column' => $c] = $raw;
      $code = chr(ord('A') + $r);
      $code .= sprintf('%02d', $c + 1);
      return $code;
    });
    return $seatsCoded;
  }

  public function recieve_seats(Request $request)
  {
    dd($request->all());
  }
}
