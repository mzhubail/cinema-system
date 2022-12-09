<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Movie, Branch, TimeSlot, Hall};
use Date;
use DateInterval;
use DateTime;
use DateTimeImmutable;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Time;

class TimeSlotController extends Controller
{
  /**
   * Check whether the given parameters for a new time slot would conflict with
   * existing time slots
   */
  public static function has_conflict(Hall $hall, DateTimeImmutable $start_time, $duration)
  {
    $endTime = $start_time
      ->add(new DateInterval("PT{$duration}M"));

    $query = $hall->time_slots()
      ->join('movies', 'movies.id', '=', 'time_slots.movie_id')
      ->where('start_time', '<=', $endTime)
      // TODO: maybe use `whereRaw`
      ->where(
        DB::raw('ADDTIME(start_time, SEC_TO_TIME(duration * 60))'),
        '>=',
        $start_time
      )
      ->select([
        '*',
        DB::raw('ADDTIME(start_time, SEC_TO_TIME(duration * 60)) as endTime'),
      ]);

    return $query->count() !== 0;
  }



  /**
   * Show the form for adding a new time slot
   */
  public function show_add()
  {
    return view(
      'time_slot.add',
      [
        'movies' => Movie::get(),
        'branches' => Branch::get(),
      ]
    );
  }



  /**
   * Add a new time slot to the system
   */
  public function store(Request $request)
  {
    $datetime = $request->date . " " . $request->time;

    if (self::has_conflict(
      Hall::find($request->hid),
      new DateTimeImmutable($datetime),
      Movie::find($request->mid)->duration,
    )) {
      session()->flash('message', ["Conflict!", "error"]);
      return redirect()->refresh();
    }
    return;

    $time_slot = new TimeSlot();
    $time_slot->start_time = new DateTimeImmutable($request->date . " " . $request->time);
    $time_slot->movie_id = $request->mid;      // TODO: do not assign movie_id directly
    $hall = Hall::find($request->hid);
    $hall->time_slots()->save($time_slot);
    session()->flash('message', ["Time slot added succefully", "info"]);
    return redirect()->refresh();
  }



  /**
   * Show a page for listing the time slots depending on the movie selected
   */
  public function browse(Request $request)
  {
    return view(
      'time_slot.browse',
      [
        'movies' => Movie::get(),
        'movie_id' => $request->mid,
      ]
    );
  }

  /**
   * Serve time slots information for the given movie or hall
   */
  public function serve_time_slots(Request $request)
  {
    // TODO: perhaps add duration and/or end time
    if ($request->has('mid')) {
      // TODO: update queries to use cast, and format date in view
      $query = DB::table('time_slots')
        ->join('halls', 'halls.id', '=', 'time_slots.hall_id')
        ->join('branches', 'branches.id', '=', 'halls.branch_id')
        ->select([
          "halls.letter   as hall_letter",
          "branches.name  as branch_name",
          "time_slots.id  as id",
          // "time           as datetime",
          DB::raw('DATE_FORMAT(`start_time`, "%d-%m-%Y")  as date'),
          DB::raw('DATE_FORMAT(`start_time`, "%H:%i")     as time'),
        ])
        ->where("time_slots.movie_id", "=", $request->mid);

      return response()->json(
        $query->get()
      );

    // Serve time slot information by hall id, used when admin is selecting a seat
    } elseif ($request->has('hid')) {
      return response()->json(
        Hall::find($request->hid)
          ->time_slots()
          ->get(['id', 'start_time'])
      );
    }
  }



  /**
   * This query is used to look for time slots that are in the same hall and
   * have conflicting times
   */
  private static $conflict_query = <<<'SQL'
    SELECT  tsA.id AS id_a,
            tsB.id AS id_b,
            tsA.hall_id AS hall_id,
            mA.title AS title_a,
            mB.title AS title_b,
            mA.duration AS duration_a,
            mB.duration AS duration_b,
            tsA.start_time AS start_time_a,
            tsB.start_time AS start_time_b,
            ADDTIME(tsA.start_time, SEC_TO_TIME(mA.duration*60)) AS end_time_a,
            ADDTIME(tsB.start_time, SEC_TO_TIME(mB.duration*60)) AS end_time_b
    FROM    `time_slots` tsA, `time_slots` tsB,
            `movies` mA, `movies` mB

            -- Self join condition
    WHERE   tsA.id < tsB.id
            -- Join with movie
    AND     tsA.movie_id = mA.id
    AND     tsB.movie_id = mB.id
            -- Same hall condition
    AND     tsA.movie_id = mA.id
    AND     tsA.hall_id = tsB.hall_id
            -- Check for time conflict
    AND     tsA.start_time < ADDTIME(tsB.start_time, SEC_TO_TIME(mB.duration*60))
    AND     ADDTIME(tsA.start_time, SEC_TO_TIME(mA.duration*60)) > tsB.start_time
    ORDER BY tsA.hall_id, tsA.start_time
  SQL;



  /**
   * Show a page containing time slot conflicts
   */
  public function show_conflicts()
  {
    $conflicts = DB::select(self::$conflict_query);
    return view(
      'time_slot.show_conflict',
      ['conflicts' => $conflicts]
    );
  }
}
