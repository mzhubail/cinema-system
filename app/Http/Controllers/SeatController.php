<?php

namespace App\Http\Controllers;

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

  public function serve_seats(Request $request)
  {
    if (!$request->has('tsid')) return;

    $seatsRaw =
      TimeSlot::find($request->tsid)
      // fake()->randomElement(TimeSlot::get())
      ->seats()
      ->get(['row', 'column']);

    // Convert seats from array into a code format, like 'E01'
    // TODO: move into separate function
    $seatsCode = $seatsRaw->map(function ($item) {
      ['row' => $r, 'column' => $c] = $item;
      $code = chr(ord('A') + $r);
      $code .= sprintf('%02d', $c + 1);
      return $code;
    });
    return response()->json(
      $seatsCode
    );
  }
}
