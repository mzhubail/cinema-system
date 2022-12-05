<?php

namespace App\Http\Controllers;

use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeatController extends Controller
{
    public function check_has_conflict(Request $request)
    {
        SeatController::has_conflict(
            TimeSlot::find($request->ts),
            $request->row,
            $request->column
        );
    }

    public static function has_conflict(TimeSlot $time_slot, $row, $column)
    {
        $query = <<<'SQL'
            SELECT  time_slots.id AS time_slot_id,
                    bookings.id AS booking_id,
                    `row`, `column`
            FROM    `time_slots`, `bookings`, `seats`
            WHERE   time_slots.id = ?
            AND     time_slots.id = bookings.time_slot_id
            AND     bookings.id = seats.booking_id
            AND     seats.row = ?
            AND     seats.column = ?
        SQL;

        dd(
            DB::select($query, [$time_slot->id, $row, $column])
        );
    }
}
